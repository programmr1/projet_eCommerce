<?php
$dsn = 'mysql:host=localhost;dbname=shop';
$user = 'root';
$pass = 'mysqlsamawi';
$option = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];

try {
    $con = new PDO($dsn, $user, $pass, $option);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Connected successfully"; // يفضل إخفاؤها في مشروعك الفعلي
} catch (PDOException $e) {
    echo 'فشل الاتصال  ' . $e->getMessage();
}