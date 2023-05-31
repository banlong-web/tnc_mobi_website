<?php
// Error Reporting Turn On
ini_set('error_reporting', E_ALL);

// Set timezone
date_default_timezone_set('Asia/Ho_Chi_Minh');

$dbhost = 'localhost';
$dbuser = 'root';
$dbname = 'tnc_mobi_db';
$dbpassword = '';

// define('BASE_URL', '');

// define('ADMIN_URL', BASE_URL.'admin'. '/');

try {
    $pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    echo "Connection error:" .$exception->getMessage();
}