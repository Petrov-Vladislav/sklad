<?php
    include "database.php";

    $name = $_POST['name'];
    $query = "SELECT `name`, `code` FROM `products` WHERE `name`='$name'";
    $result = $pdo->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if ($row['name'] != $name) {
        echo "<h3>Ошибка при удалении товара: данный товар не существует</h3>";
        echo "<h3><a href='product.php'>Ввести заново</a></h3>";
    } else {
        $query = "DELETE FROM `products` WHERE `name`='$name'";
        $result = $pdo->exec($query);
        header ("Location: product.php");
    }
?>
