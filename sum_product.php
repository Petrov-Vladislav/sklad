<!-- Выводит количество товара на складе -->
<?php
    include "database.php";

    $query_count = "SELECT COUNT(`id`) as `count` FROM `products`";
    $result_count = $pdo->query($query_count);
    $row_count = $result_count->fetch(PDO::FETCH_ASSOC);
    $count = $row_count['count'];

    $query_sum = "SELECT SUM(`sum`) as `sum` FROM `products`";
    $result_sum = $pdo->query($query_sum);
    $row_sum = $result_sum->fetch(PDO::FETCH_ASSOC);
    $sum = $row_sum['sum'];

    $count_len = strlen($count);
    $count_zn = substr($count, ($count_len-1));

    if (($count_zn == 0) || (($count_zn >= 5) && ($count_zn <= 9))) {
        $str = "видов";
    }

    if ($count_zn == 1) {
        $str = "вид";
    }

    if (($count_zn == 2) || ($count_zn == 3) || ($count_zn == 4)) {
        $str = "вида";
    }

?>
