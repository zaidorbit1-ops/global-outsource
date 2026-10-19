<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/backend.php';
backend_session_start();
header('Cache-Control: private, no-store, max-age=0');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: strict-origin-when-cross-origin');
header("Content-Security-Policy: default-src 'self'; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data:; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none'");

if (isset($_SESSION['admin_id'])) {
    backend_redirect('index');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    backend_verify_csrf();
    $email = strtolower(trim((string) ($_POST['email'] ?? '')));
    $password = (string) ($_POST['password'] ?? '');

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false || strlen($email) > 254 || $password === '' || strlen($password) > 200) {
        $error = 'Email or password is incorrect.';
    } else {
        try {
            $database = app_database();
            $ipHash = backend_admin_ip_hash();
            $throttle = $database->prepare("SELECT COUNT(*) FROM admin_login_attempts WHERE ip_hash = :ip_hash AND succeeded = 0 AND attempted_at >= UTC_TIMESTAMP() - INTERVAL 15 MINUTE");
            $throttle->execute(['ip_hash' => $ipHash]);

            if ((int) $throttle->fetchColumn() >= 5) {
                $error = 'Too many sign-in attempts. Please wait 15 minutes before trying again.';
            } else {
                $statement = $database->prepare('SELECT id, email, password_hash FROM admins WHERE email = :email AND is_active = 1 LIMIT 1');
                $statement->execute(['email' => $email]);
                $admin = $statement->fetch();
                $authenticated = is_array($admin) && password_verify($password, $admin['password_hash']);
                backend_log_admin_attempt($database, $ipHash, $authenticated);

                if ($authenticated) {
                    if (password_needs_rehash($admin['password_hash'], PASSWORD_DEFAULT)) {
                        $rehash = $database->prepare('UPDATE admins SET password_hash = :password_hash WHERE id = :id');
                        $rehash->execute([
                            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                            'id' => $admin['id'],
                        ]);
                    }

                    session_regenerate_id(true);
                    $_SESSION = [];
                    $_SESSION['admin_id'] = (int) $admin['id'];
                    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                    $cleanup = $database->prepare('DELETE FROM admin_login_attempts WHERE ip_hash = :ip_hash');
                    $cleanup->execute(['ip_hash' => $ipHash]);
                    backend_redirect('index');
                }

                $error = 'Email or password is incorrect.';
            }
        } catch (Throwable $exception) {
            error_log('Admin login failed: ' . $exception->getMessage());
            $error = $exception instanceof RuntimeException && str_contains($exception->getMessage(), 'Could not connect to MySQL')
                ? 'Could not connect to the configured database. Verify the Hostinger credentials and database-user access, then check that the database tables have been imported.'
                : 'The sign-in service is temporarily unavailable. Check the database connection and try again.';
        }
    }
}

$csrfToken = backend_csrf_token();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#17191d">
    <title>Admin Sign In | Global Outsource</title>
    <link rel="icon" href="../assets/favicon/favicon.ico" sizes="any">
    <link rel="icon" href="../assets/favicon/favicon.svg" type="image/svg+xml">
    <link rel="icon" href="../assets/favicon/favicon-96x96.png" type="image/png" sizes="96x96">
    <link rel="apple-touch-icon" href="../assets/favicon/apple-touch-icon.png">
    <link rel="manifest" href="../assets/favicon/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body class="admin-login-body">
    <main class="admin-login-wrap">
        <a class="admin-login-back" href="../index"><span aria-hidden="true">←</span> Back to website</a>
        <section class="admin-login-card" aria-labelledby="admin-login-title">
            <a class="admin-brand admin-login-brand" href="../index">
                <img class="admin-brand-logo admin-login-logo" src="../logo.png" alt="Global Outsource">
                <span class="admin-brand-console">ADMIN CONSOLE</span>
            </a>
            <p class="admin-login-kicker"><span></span>Private workspace</p>
            <h1 id="admin-login-title">Welcome <span>back.</span></h1>
            <p class="admin-login-intro">Sign in to manage jobs, applications and contact enquiries.</p>
            <?php if ($error !== ''): ?>
                <p class="admin-alert admin-alert-error" role="alert"><?= backend_escape($error) ?></p>
            <?php endif; ?>
            <form class="admin-login-form" method="post" action="login">
                <input type="hidden" name="csrf_token" value="<?= backend_escape($csrfToken) ?>">
                <label for="admin-email">Admin email</label>
                <input id="admin-email" name="email" type="email" autocomplete="username" maxlength="254" required autofocus>
                <label for="admin-password">Password</label>
                <input id="admin-password" name="password" type="password" autocomplete="current-password" maxlength="200" required>
                <button class="admin-button admin-button-primary" type="submit">Sign in to dashboard <span aria-hidden="true">→</span></button>
            </form>
            <p class="admin-login-footnote"><span aria-hidden="true">▣</span> Protected administrator access</p>
        </section>
        <p class="admin-login-copyright">© <?= date('Y') ?> Global Outsource Pvt Ltd</p>
    </main>
</body>
</html>
