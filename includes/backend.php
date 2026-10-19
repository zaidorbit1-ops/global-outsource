<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

function backend_session_start(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');
    ini_set('session.cookie_httponly', '1');
    ini_set('session.cookie_samesite', 'Strict');
    session_name('global_outsource_admin');
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
    session_start();
}

function backend_escape(string|int|null $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function backend_length(string $value): int
{
    return function_exists('mb_strlen') ? mb_strlen($value, 'UTF-8') : strlen($value);
}

function backend_input_string(array $source, string $key): string
{
    $value = $source[$key] ?? '';
    return is_string($value) ? $value : '';
}

function backend_is_ajax_request(): bool
{
    return ($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest';
}

function backend_json_response(array $payload, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-store, max-age=0');
    echo json_encode($payload, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    exit;
}

function backend_csrf_token(): string
{
    backend_session_start();

    if (!isset($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function backend_verify_csrf(): void
{
    backend_session_start();
    $token = $_POST['csrf_token'] ?? '';

    if (!is_string($token) || !isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
        if (backend_is_ajax_request()) {
            backend_json_response(['success' => false, 'message' => 'Your form session expired. Refresh this page and try again.'], 403);
        }

        http_response_code(403);
        exit('The form session expired. Please go back, refresh the page, and try again.');
    }
}

function backend_flash(string $type, string $message): void
{
    backend_session_start();
    $_SESSION['flash_message'] = ['type' => $type, 'message' => $message];
}

function backend_take_flash(): ?array
{
    backend_session_start();
    $message = $_SESSION['flash_message'] ?? null;
    unset($_SESSION['flash_message']);

    return is_array($message) ? $message : null;
}

function backend_redirect(string $location): never
{
    header('Location: ' . $location, true, 303);
    exit;
}

function backend_require_admin(): array
{
    backend_session_start();
    $adminId = $_SESSION['admin_id'] ?? null;

    if (!is_int($adminId) && !ctype_digit((string) $adminId)) {
        backend_redirect('login');
    }

    try {
        $statement = app_database()->prepare('SELECT id, email, created_at FROM admins WHERE id = :id AND is_active = 1 LIMIT 1');
        $statement->execute(['id' => (int) $adminId]);
        $admin = $statement->fetch();
    } catch (Throwable $exception) {
        error_log('Admin session validation failed: ' . $exception->getMessage());
        http_response_code(503);
        exit('The dashboard is temporarily unavailable because the database could not be reached.');
    }

    if (!is_array($admin)) {
        $_SESSION = [];
        session_regenerate_id(true);
        backend_redirect('login');
    }

    header('Cache-Control: private, no-store, max-age=0');
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header('Referrer-Policy: strict-origin-when-cross-origin');

    return $admin;
}

function backend_log_admin_attempt(PDO $database, string $ipHash, bool $success): void
{
    $statement = $database->prepare('INSERT INTO admin_login_attempts (ip_hash, succeeded, attempted_at) VALUES (:ip_hash, :succeeded, UTC_TIMESTAMP())');
    $statement->execute(['ip_hash' => $ipHash, 'succeeded' => $success ? 1 : 0]);
}

function backend_admin_ip_hash(): string
{
    $remoteAddress = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $key = backend_application_key();
    return hash_hmac('sha256', $remoteAddress, $key);
}

function backend_application_key(): string
{
    $key = app_config('app_key', 'GO_APP_KEY');

    if ($key !== null && strlen($key) >= 32 && !str_starts_with($key, 'REPLACE_')) {
        return $key;
    }

    $keyPath = dirname(__DIR__) . '/config/app.key';
    $keyFile = @fopen($keyPath, 'x');

    if (is_resource($keyFile)) {
        try {
            $generatedKey = bin2hex(random_bytes(32));

            if (fwrite($keyFile, $generatedKey) !== strlen($generatedKey)) {
                throw new RuntimeException('Could not save the automatically generated application key in config/app.key.');
            }

            fflush($keyFile);
            @chmod($keyPath, 0600);
            return $generatedKey;
        } finally {
            fclose($keyFile);
        }
    }

    if (!is_file($keyPath) || !is_readable($keyPath)) {
        throw new RuntimeException('Could not create or read the automatically generated application key in config/app.key.');
    }

    $storedKey = trim((string) file_get_contents($keyPath));

    if (!preg_match('/\A[a-f0-9]{64}\z/', $storedKey)) {
        throw new RuntimeException('The automatically generated application key in config/app.key is invalid.');
    }

    return $storedKey;
}

function backend_record_public_submission(PDO $database, string $formType): void
{
    if (!in_array($formType, ['contact', 'application'], true)) {
        throw new RuntimeException('Invalid submission type.');
    }

    $key = backend_application_key();
    $remoteAddress = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $ipHash = hash_hmac('sha256', $remoteAddress, $key);
    $database->beginTransaction();

    try {
        $count = $database->prepare('SELECT id FROM public_submission_limits WHERE ip_hash = :ip_hash AND form_type = :form_type AND submitted_at >= UTC_TIMESTAMP() - INTERVAL 15 MINUTE ORDER BY submitted_at DESC LIMIT 5 FOR UPDATE');
        $count->execute(['ip_hash' => $ipHash, 'form_type' => $formType]);

        if (count($count->fetchAll(PDO::FETCH_COLUMN)) >= 5) {
            throw new RuntimeException('Too many submissions. Please wait a while before trying again.');
        }

        $insert = $database->prepare('INSERT INTO public_submission_limits (ip_hash, form_type, submitted_at) VALUES (:ip_hash, :form_type, UTC_TIMESTAMP())');
        $insert->execute(['ip_hash' => $ipHash, 'form_type' => $formType]);
        $database->commit();
    } catch (Throwable $exception) {
        if ($database->inTransaction()) {
            $database->rollBack();
        }

        throw $exception;
    }
}

function backend_layout_start(string $title, array $admin, string $activeSection): void
{
    header("Content-Security-Policy: default-src 'self'; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data:; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none'");

    $sections = [
        'overview' => ['Dashboard', './'],
        'jobs' => ['Job postings', './?section=jobs'],
        'applications' => ['Applications', './?section=applications'],
        'messages' => ['Contact messages', './?section=messages'],
        'settings' => ['Settings', './?section=settings'],
        'users' => ['Users', './?section=users'],
    ];
    $email = backend_escape($admin['email'] ?? '');
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">
        <meta name="theme-color" content="#17191d">
        <title><?= backend_escape($title) ?> | Global Outsource Admin</title>
        <link rel="icon" href="../assets/favicon/favicon.ico" sizes="any">
        <link rel="icon" href="../assets/favicon/favicon.svg" type="image/svg+xml">
        <link rel="icon" href="../assets/favicon/favicon-96x96.png" type="image/png" sizes="96x96">
        <link rel="apple-touch-icon" href="../assets/favicon/apple-touch-icon.png">
        <link rel="manifest" href="../assets/favicon/site.webmanifest">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/admin.css">
        <script src="../assets/js/admin.js" defer></script>
    </head>
    <body class="admin-body">
        <div class="admin-shell">
            <aside class="admin-sidebar">
                <a class="admin-brand" href="index" aria-label="Global Outsource dashboard">
                    <img class="admin-brand-logo" src="../logo.png" alt="Global Outsource">
                    <span class="admin-brand-console">ADMIN CONSOLE</span>
                </a>
                <span class="admin-nav-label">WORKSPACE</span>
                <nav class="admin-nav" aria-label="Dashboard navigation">
                    <?php foreach ($sections as $key => [$label, $href]): ?>
                        <a class="<?= $activeSection === $key ? 'is-active' : '' ?>" href="<?= backend_escape($href) ?>"<?= $activeSection === $key ? ' aria-current="page"' : '' ?>>
                            <span class="admin-nav-icon" aria-hidden="true"><?= match ($key) { 'overview' => '⌂', 'jobs' => '▤', 'applications' => '♙', 'messages' => '✉', 'settings' => '⚙', default => '♧' } ?></span><?= backend_escape($label) ?>
                        </a>
                    <?php endforeach; ?>
                </nav>
                <div class="admin-sidebar-bottom">
                    <a class="admin-view-site" href="../index" target="_blank" rel="noopener">View website <span aria-hidden="true">↗</span></a>
                    <div class="admin-sidebar-user"><span class="admin-avatar"><?= backend_escape(strtoupper(substr((string) ($admin['email'] ?? 'A'), 0, 1))) ?></span><span><b><?= $email ?></b><small>Administrator</small></span></div>
                    <form action="logout" method="post">
                        <input type="hidden" name="csrf_token" value="<?= backend_escape(backend_csrf_token()) ?>">
                        <button class="admin-logout" type="submit">Sign out <span aria-hidden="true">↗</span></button>
                    </form>
                </div>
            </aside>
            <div class="admin-main">
                <header class="admin-topbar">
                    <a class="admin-mobile-brand" href="index" aria-label="Global Outsource dashboard"><img src="../logo.png" alt="Global Outsource"><span>ADMIN</span></a>
                    <span class="admin-topbar-context">Website management <i></i> <b><?= backend_escape($title) ?></b></span>
                    <a class="admin-topbar-site" href="../index" target="_blank" rel="noopener">View site <span aria-hidden="true">↗</span></a>
                </header>
                <main class="admin-content">
    <?php
}

function backend_layout_end(): void
{
    ?>
                </main>
                <footer class="admin-footer"><span>Global Outsource Admin</span><span>Secure workspace</span></footer>
            </div>
        </div>
    </body>
    </html>
    <?php
}
