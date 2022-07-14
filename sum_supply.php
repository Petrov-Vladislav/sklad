<!-- Выводит количество поставок -->
<?php
    include "database.php";

    $date = new DateTime();
    $date = $date->format('Y-m-d');

    $query_count = "SELECT COUNT(`id`) as `count` FROM `supply`";
    $result_count = $pdo->query($query_count);
    $row_count = $result_count->fetch(PDO::FETCH_ASSOC);
    $count = $row_count['count'];

    $query_date = "SELECT COUNT(`date`) as `count` FROM `supply` WHERE `date`='$date'";
    $result_date = $pdo->query($query_date);
    $row_date = $result_date->fetch(PDO::FETCH_ASSOC);
    $count_date = $row_date['count'];

    $count_len = strlen($count_date);
    $count_zn = substr($count_date, ($count_len-1));

    if (($count_zn == 0) || (($count_zn >= 5) && ($count_zn <= 9)) || ($count_zn == 11)) {
        $str = "поставок";
    }

    if ($count_zn == 1) {
        $str = "поставка";
    }

    if (($count_zn == 2) || ($count_zn == 3) || ($count_zn == 4)) {
        $str = "поставки";
    }

?>
