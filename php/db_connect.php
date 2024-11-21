<?php
$host = 'localhost';
$dbname = 'invoice_app';
$username = 'root';  // default WAMP username
$password = 'root';      // default WAMP password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>