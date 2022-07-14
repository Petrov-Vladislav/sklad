<?php
// Новый заказ поставки
    include "database.php";

    $name = $_POST['name'];
    $date = $_POST['date'];
    $product = $_POST['product'];
    $product_code = $_POST['product_code'];
    $product_sum = $_POST['product_sum'];
    $price = $_POST['price'];
    $total = ($price * $product_sum);

    $query = "INSERT INTO `supply`(`name`, `date`, `product`, `product_code`, `product_sum`, `price`, `total`) VALUES ('$name', '$date', '$product', '$product_code', '$product_sum', '$price', '$total')";
    $result = $pdo->exec($query);

    header("Location: supply.php");
?>
