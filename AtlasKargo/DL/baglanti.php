<?php

$host = "localhost";
$dbname = "kargotaban";
$username = "root";
$password = "123456";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$dbname;charset = $charset";
$secenekler = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $db = new PDO($dsn,$username,$password,$secenekler);

}catch(PDOException $e){
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}

?>