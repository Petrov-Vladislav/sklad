<?php
//Заказы
    session_start();
    if (!isset($_SESSION['login'])) {
        header("Location: index.php");
    }
    include "database.php";
    include "sum_order.php";

    $query = "SELECT * FROM `zakaz` ORDER BY `date`";
    $result = $pdo->query($query);
    $row = $result->fetchAll(PDO::FETCH_ASSOC);

    $query_prod = "SELECT `name` FROM `products`";
    $result_prod = $pdo->query($query_prod);
    $row_prod = $result_prod->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Заказы</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
	integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
	integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
	integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link href="/your-path-to-fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/supply_style.css">
</head>
    <body>
        <div id = "wrapper">
            <nav class="navbar navbar-expand-md navbar-light sticky-top">
                <div class="container-fluid">
                    <a href="product.php" class="navbar-brad"><img src="img/logo.gif"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="product.php" class="nav-link"><span class="fa fa-align-left fa-fw"></span> Товары</a>
                            </li>
                            <li class="nav-item">
                                <a href="supply.php" class="nav-link"><span class="fa fa-truck fa-fw"></span> Поставки</a>
                            </li>
                            <li class="nav-item active">
                                <a href="order.php" class="nav-link"><span class="fa fa-ruble-sign fa-fw"></span> Заказы</a>
                            </li>
                        </ul>
                    </div>
                    <span class="navbar-text">
                        <span class="fa fa-user"></span>
                        <?php echo "Пользователь ".$_SESSION['login']; ?>
                    </span>
                </div>
            </nav>
			<div class="container mt-4">
                <h3 class="text-info">Заказы</h3>
                <h5 class="mt-4">Сегодня <?php echo "<b>$count_date</b> $str" ?>. Общее количество заказов - <b><?=$count?></b></h5>
			</div>
            <div class="mt-4 container">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_order">Создать новый заказ</button>
            </div>
            <div class="container-fluid mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Клиент</th>
                                    <th scope="col">Дата</th>
                                    <th scope="col">Товар</th>
                                    <th scope="col">Количество</th>
                                    <th scope="col">Цена</th>
                                    <th scope="col">Итого</th>
                                    <th scope="col"><span class="fa fa-check fa-fw"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <form id="order_sent" action="order_sent.php" method="post">
                                <?php
                                    for ($i = 0; $i < count($row); $i++) {
                                        echo "<tr><td>".$row[$i]['client']."</td>";
                                        echo "<td>".$row[$i]['date']."</td>";
                                        echo "<td>".$row[$i]['product']."</td>";
                                        echo "<input type='text' name='product' value='".$row[$i]['product']."' hidden>";
                                        echo "<td>".$row[$i]['product_sum']."</td>";
                                        echo "<input type='text' name='product_sum' value='".$row[$i]['product_sum']."' hidden>";
                                        echo "<td>".$row[$i]['price']."</td>";
                                        // echo "<input type='text' name='price' value='".$row[$i]['price']."' hidden>";
                                        echo "<td>".$row[$i]['total']."</td>";
                                        echo "<td><button type='submit' form='order_sent' class='btn btn-warning btn-sm'>Заказ отправлен</button></td></tr>";
                                    }
                                ?>
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Модальное окно с новым заказом -->
            <div class="modal fade" id="add_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Новый заказ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="new_order" action="new_order.php" method="post">
                                <div class="form-group">
                                  <label for="name" class="col-form-label">
                                      Клиент
                                  </label>
                                  <input type="text" class="form-control" id="client" name="client" required>
                                </div>
                                <div class="form-group">
                                    <label for="date" class="col-form-label">
                                        Дата
                                    </label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>
                                <div class="form-group">
                                    <label for="product" class="col-form-label">
                                        Продукт
                                    </label>
                                    <input type='search' list='search' class="form-control" id="product" name="product" required>
                                    <datalist id='search'>
                                    <?php
                                        for ($i = 0; $i < count($row_prod); $i++) {
                                            ?> <option value="<?=$row_prod[$i]['name'];?>"></option>
                                        <?php }
                                    ?>
                                    </datalist>
                                </div>
                                <div class="form-group">
                                    <label for="product_sum" class="col-form-label">
                                        Количество
                                    </label>
                                    <input type="number" class="form-control" id="product_sum" name="product_sum" required>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="price" class="col-form-label">
                                        Цена
                                    </label>
                                    <input type="number" class="form-control" id="price" name="price">
                                </div> -->
                                <!-- <div class="form-group">
                                    <label for="total" class="col-form-label">
                                        Сумма
                                    </label>
                                    <input type="number" class="form-control" id="total" name="total">
                                </div> -->
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Отмена</button>
                            <button type="submit" form="new_order" class="btn btn-success">Сохранить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
