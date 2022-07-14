<?php
//Заказ отправлен
include "database.php";

$product = $_POST['product'];
$product_sum = $_POST['product_sum'];

$query_name = "SELECT `sum` FROM `products` WHERE `name` = '$product'";
$result_name = $pdo->query($query_name);
$row_name = $result_name->fetch(PDO::FETCH_ASSOC);

if ($row_name) {
	$total_sum = ($row_name['sum'] - $product_sum);
    $query = "UPDATE `products` SET `sum`='$total_sum' WHERE `name` = '$product'";
    $result = $pdo->exec($query);
}
if ($total_sum < 1) {
    $query = "DELETE FROM `products` WHERE `name`='$product'";
    $result = $pdo->exec($query);
}

$query_del = "DELETE FROM `zakaz` WHERE `product`='$product'";
$result_del = $pdo->exec($query_del);

header("Location: order.php");

?>
