<?php
    include "database.php";

    if (($_POST['collapse_price'] !== false) && ($_POST['name'] !== false)) {
        $collapse_price = $_POST['collapse_price'];
        $name = $_POST['name'];

        $query = "SELECT `name` FROM `products` WHERE `name`='$name'";
        $result = $pdo->query($query);
        $row = $result->fetch(PDO::FETCH_ASSOC);

        if ($row['name'] != $name) {
            echo "<h3>Ошибка при изменении товара: не правильно введен товар</h3>";
            echo "<h3><a href='product.php'>Ввести заново</a></h3>";
        }
        else {
            $query = "UPDATE `products` SET `price`='$collapse_price' WHERE `name`='$name'";
            $result = $pdo->exec($query);
            header ("Location: product.php");
        }
    }
?>
