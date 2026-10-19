<?php
declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

require_once __DIR__ . '/../config/database.php';

function prompt(string $message): string
{
    fwrite(STDOUT, $message);
    $input = fgets(STDIN);
    return $input === false ? '' : trim($input);
}

function prompt_password(string $message): string
{
    fwrite(STDOUT, $message);

    if (PHP_OS_FAMILY === 'Windows') {
        $command = 'powershell -NoProfile -Command "$p = Read-Host -AsSecureString; $b = [Runtime.InteropServices.Marshal]::SecureStringToBSTR($p); try { [Runtime.InteropServices.Marshal]::PtrToStringBSTR($b) } finally { [Runtime.InteropServices.Marshal]::ZeroFreeBSTR($b) }"';
        $password = shell_exec($command);
        return is_string($password) ? trim($password) : '';
    }

    $tty = @fopen('/dev/tty', 'r+');

    if ($tty === false) {
        fwrite(STDOUT, PHP_EOL . 'Password input must be entered from an interactive terminal.' . PHP_EOL);
        return '';
    }

    exec('stty -echo < /dev/tty');
    $password = fgets($tty);
    exec('stty echo < /dev/tty');
    fwrite(STDOUT, PHP_EOL);
    fclose($tty);

    return $password === false ? '' : trim($password);
}

try {
    $database = app_database();
    $email = strtolower(prompt('Administrator email: '));

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false || strlen($email) > 254) {
        throw new RuntimeException('Enter a valid email address (maximum 254 characters).');
    }

    $password = prompt_password('Password: ');

    if ($password === '' || strlen($password) > 200) {
        throw new RuntimeException('Enter a password of 1 to 200 characters.');
    }

    $confirmation = prompt_password('Confirm password: ');

    if (!hash_equals($password, $confirmation)) {
        throw new RuntimeException('The passwords do not match.');
    }

    $statement = $database->prepare('INSERT INTO admins (email, password_hash) VALUES (:email, :password_hash)');
    $statement->execute([
        'email' => $email,
        'password_hash' => password_hash($password, PASSWORD_DEFAULT),
    ]);

    fwrite(STDOUT, 'Administrator account created for ' . $email . PHP_EOL);
} catch (Throwable $exception) {
    fwrite(STDERR, 'Could not create administrator: ' . $exception->getMessage() . PHP_EOL);
    exit(1);
}
