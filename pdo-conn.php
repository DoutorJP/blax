<?php
$dbname = "balx";
$dbuser = "root";
$dbpass = "";
$dbhost = "localhost";

try {
    $pdo = new PDO("mysql:host=".$dbhost . ";dbname=".
    $dbname, $dbuser, $dbpass);
}catch(PDOException $e) {
    echo $e->getMessage();
    exit();
}
?>