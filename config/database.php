<?php
declare(strict_types=1);

$localConfigPath = __DIR__ . '/database.local.php';
$localConfig = is_file($localConfigPath) ? require $localConfigPath : [];
$databaseSettings = [
    'db_host' => 'localhost',
    'db_name' => 'u717775154_global',
    'db_user' => 'u717775154_global',
    'db_password' => 'Fordomain112',
    'db_port' => '3306',
    'db_charset' => 'utf8mb4',
];

if (!is_array($localConfig)) {
    throw new RuntimeException('The local database config must return an array.');
}

function app_config(string $key, ?string $environmentName = null): ?string
{
    global $localConfig;
    global $databaseSettings;
    $value = getenv($environmentName ?? $key);

    if ($value !== false && $value !== '') {
        return $value;
    }

    $configured = $localConfig[$key] ?? $databaseSettings[$key] ?? null;
    return is_string($configured) && $configured !== '' ? $configured : null;
}

function database_is_configured(): bool
{
    return app_config('db_name', 'GO_DB_NAME') !== null
        && app_config('db_user', 'GO_DB_USER') !== null
        && app_config('db_password', 'GO_DB_PASSWORD') !== null;
}

function app_database(): PDO
{
    static $connection;

    if ($connection instanceof PDO) {
        return $connection;
    }

    $host = app_config('db_host', 'GO_DB_HOST') ?? 'srv864.hstgr.io';
    $name = app_config('db_name', 'GO_DB_NAME');
    $user = app_config('db_user', 'GO_DB_USER');
    $password = app_config('db_password', 'GO_DB_PASSWORD');
    $port = app_config('db_port', 'GO_DB_PORT') ?? '3306';
    $charset = app_config('db_charset', 'GO_DB_CHARSET') ?? 'utf8mb4';

    if ($name === null || $user === null || $password === null) {
        throw new RuntimeException('Set db_name, db_user, and db_password in config/database.local.php or the GO_DB_NAME, GO_DB_USER, and GO_DB_PASSWORD environment variables.');
    }

    $applicationNameIsSafe = preg_match('/\A[A-Za-z0-9_$-]+\z/', (string) $name) === 1;
    $hostIsSafe = preg_match('/\A[A-Za-z0-9._:-]+\z/', (string) $host) === 1;

    if (!ctype_digit($port) || (int) $port < 1 || (int) $port > 65535) {
        throw new RuntimeException('GO_DB_PORT must be a valid TCP port.');
    }

    if (!$applicationNameIsSafe || !$hostIsSafe) {
        throw new RuntimeException('The MySQL host or database name contains unsupported characters.');
    }

    if ($charset !== 'utf8mb4') {
        throw new RuntimeException('The database character set must be utf8mb4.');
    }

    $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=%s', $host, $port, $name, $charset);

    try {
        $connection = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci',
        ]);
    } catch (PDOException $exception) {
        error_log('Global Outsource database connection failed: ' . $exception->getMessage());
        throw new RuntimeException('Could not connect to MySQL. Confirm the configured host, database name, username, and password, and verify that database/schema.sql has been imported.', 0, $exception);
    }

    return $connection;
}
