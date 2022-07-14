<?php
//Товар принят
include "database.php";

$product = $_POST['product'];
$product_code = $_POST['product_code'];
$product_sum = $_POST['product_sum'];
$price = $_POST['price'];

$query_name = "SELECT `sum` FROM `products` WHERE `name` = '$product'";
$result_name = $pdo->query($query_name);
$row_name = $result_name->fetch(PDO::FETCH_ASSOC);

if ($row_name) {
	$total_sum = ($row_name['sum'] + $product_sum);
    $query = "UPDATE `products` SET `sum`='$total_sum', `price`='$price' WHERE `name` = '$product'";
    $result = $pdo->exec($query);
}
else {
    $query = "INSERT INTO `products`(`name`, `code`, `sum`, `measure`, `price`) VALUES ('$product', '$product_code', '$product_sum', 'шт.', '$price')";
    $result = $pdo->exec($query);
}

$query_del = "DELETE FROM `supply` WHERE `product`='$product'";
$result_del = $pdo->exec($query_del);

header("Location: supply.php");

?>
