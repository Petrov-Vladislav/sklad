<?php
    include "database.php";

    $name = $_POST['name'];
    $code = $_POST['code'];
    $sum = $_POST['sum'];
    $measure = $_POST['measure'];
    $price = $_POST['price'];

    $query = "INSERT INTO `products`(`name`, `code`, `sum`, `measure`, `price`) VALUES ('$name', '$code', '$sum', '$measure', '$price')";
    $result = $pdo->exec($query);

    header("Location: product.php");
?>
