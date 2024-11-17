<?php

// Load environment variables from .env
$env = [];
if (file_exists('.env')) {
    $lines = file('.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($key, $value) = explode('=', $line, 2);
        $env[trim($key)] = trim(trim($value), '"');
    }
}

$host = $env['db_host'];
$db   = $env['db_name'];
$port = $env['db_port'];
$user = $env['db_user'];
$pass = $env['db_password'];

// Override with environment variables if available
$host = getenv('db_host') ?: $host;
$db   = getenv('db_name') ?: $db;
$port = getenv('db_port') ?: $port;
$user = getenv('db_user') ?: $user;
$pass = getenv('db_password') ?: $pass;

$dsn = "pgsql:host=$host;port=$port;dbname=$db;";
try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
