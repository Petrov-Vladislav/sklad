<?php
//Подключение к базе данных
    define(DB_HOST, 'localhost');
    define(DB_USER, 'root');
    define(DB_PASSWORD, '');
    define(DB_NAME, 'sklad');

    try {
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    } catch (PDOException $e) {
        echo 'Ошибка при подключении к базе данных!';
    }
	$pdo->query("SET NAMES 'utf8'");
?>
