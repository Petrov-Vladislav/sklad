<?php
// Новый заказ клиента
    include "database.php";

    $client = $_POST['client'];
    $date = $_POST['date'];
    $product = $_POST['product'];
    $product_sum = $_POST['product_sum'];

    $query_prod = "SELECT `price` FROM `products` WHERE `name`='$product'";
    $result_prod = $pdo->query($query_prod);
    $row_prod = $result_prod->fetch(PDO::FETCH_ASSOC);

    $total = ($row_prod['price'] * $product_sum);

    $query = "INSERT INTO `zakaz`(`client`, `date`, `product`, `product_sum`, `price`, `total`) VALUES ('$client', '$date', '$product', '$product_sum', '$row_prod[price]', '$total')";
    $result = $pdo->exec($query);

    header("Location: order.php");
?>
