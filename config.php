<?php
$db_name = 'test';
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
try {
    $pdo = new PDO("mysql:dbname=$db_name;host=$db_host", $db_user, $db_password); // Conectando com Banco de dados
} catch (\Throwable $th) {
    throw $th;
}
