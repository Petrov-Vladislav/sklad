<?php
//Запись данных в базу с помощью цикла
    include "database.php";

if (isset($_POST['collapse_sum']) && isset($_POST['name'])) {
    $name = $_POST['name'];
    $collapse_sum = $_POST['collapse_sum'];
    $query_sel = "SELECT `name`, `code` FROM `products` WHERE `name`='$name' OR `code`='$name'";
    $result_sel = $pdo->query($query_sel);
    $row = $result_sel->fetch(PDO::FETCH_ASSOC);
    print_r($row);

    if (($row['code'] != $name) && ($row['name'] != $name)) {
        echo "<h3>Ошибка при изменении товара: не правильно введен товар</h3>";
    } else {
        $query = "UPDATE `products` SET `sum`= '$collapse_sum' WHERE `name`='$name' OR `code`='$name'";
        $result = $pdo->exec($query);
        header("Location: product.php");
    }
}
?>
