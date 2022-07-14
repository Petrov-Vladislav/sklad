<?php
//Товары
    session_start();
    if (!isset($_SESSION['login'])) {
        header("Location: index.php");
    }
    include "database.php";
    include "sum_product.php";

    $query = "SELECT * FROM `products`";
    $result = $pdo->query($query);
    $row = $result->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Товары</title>
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
    <link rel="stylesheet" href="css/product_style.css">

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
                            <li class="nav-item active">
                                <a href="product.php" class="nav-link"><span class="fa fa-align-left fa-fw"></span> Товары</a>
                            </li>
                            <li class="nav-item">
                                <a href="supply.php" class="nav-link"><span class="fa fa-truck fa-fw"></span> Поставки</a>
                            </li>
                            <li class="nav-item">
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
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-info">Товары</h3>
                        <h5 class="mt-4">На складе <?php echo "<b>$count</b> $str" ?> товара. Общее количество товаров - <b><?=$sum?></b> шт.</h5>
                        <div class="mt-4">
                            <button type="button" class="btn btn-primary mr-3" data-toggle="collapse" data-target="#table_prod">Показать товары</button>
                            <button type="button" class="btn btn-primary mr-3" data-toggle="collapse" data-target="#new_prod">Добавить товар</button>
                            <button type="button" class="btn btn-primary mr-3" data-toggle="collapse" data-target="#edit_product">Редактировать товар</button>
                            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#delete_product">Удалить товар</button>
                        </div>
                    </div>
                </div>

                <!-- Таблица товаров -->
                <div class="row col-md-12 mt-4 collapse" name="table_prod" id="table_prod">
                    <div class="row col-md-12 mt-4">
                        <p>Выберите по какому столбцу выполнить сортировку: </p>
                        <form class="ml-3" name="sort" action="product.php" method="post">
                            <select name="sorttable">
                                <option value="sort_name">Наименование</option>
                                <option value="sort_code">Артикул</option>
                                <option value="sort_sum">Количество</option>
                                <option value="sort_price">Цена</option>
                            </select>
                            <input type="submit" class="btn btn-outline-success btn-sm ml-2" value="Сортировать">
                        </form>
                    </div>
                    <table class="mt-4 table table-striped text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Наименование</th>
                                <th scope="col">Артикул</th>
                                <th scope="col">Количество</th>
                                <th scope="col">Ед. измер.</th>
                                <th scope="col">Цена</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if (!isset($_POST['sorttable'])) {
                                    for ($i = 0; $i < count($row); $i++) {
                                        echo "<tr><td>".$row[$i]['name']."</td>";
                                        echo "<td>".$row[$i]['code']."</td>";
                                        echo "<td>".$row[$i]['sum']."</td>";
                                        echo "<td>".$row[$i]['measure']."</td>";
                                        echo "<td>".$row[$i]['price']."</td></tr>";
                                    }
                                }

                                if ($_POST['sorttable'] == 'sort_name') {
                                    $query_sort = "SELECT * FROM `products` ORDER BY `name`";
                                    $result_sort = $pdo->query($query_sort);
                                    $row_sort = $result_sort->fetchAll(PDO::FETCH_ASSOC);
                                    for ($i = 0; $i < count($row_sort); $i++) {
                                        echo "<tr><td>".$row_sort[$i]['name']."</td>";
                                        echo "<td>".$row_sort[$i]['code']."</td>";
                                        echo "<td>".$row_sort[$i]['sum']."</td>";
                                        echo "<td>".$row_sort[$i]['measure']."</td>";
                                        echo "<td>".$row_sort[$i]['price']."</td></tr>";
                                    }
                                }

                                if ($_POST['sorttable'] == 'sort_code') {
                                    $query_sort = "SELECT * FROM `products` ORDER BY `code`";
                                    $result_sort = $pdo->query($query_sort);
                                    $row_sort = $result_sort->fetchAll(PDO::FETCH_ASSOC);
                                    for ($i = 0; $i < count($row_sort); $i++) {
                                        echo "<tr><td>".$row_sort[$i]['name']."</td>";
                                        echo "<td>".$row_sort[$i]['code']."</td>";
                                        echo "<td>".$row_sort[$i]['sum']."</td>";
                                        echo "<td>".$row_sort[$i]['measure']."</td>";
                                        echo "<td>".$row_sort[$i]['price']."</td></tr>";
                                    }
                                }

                                if ($_POST['sorttable'] == 'sort_sum') {
                                    $query_sort = "SELECT * FROM `products` ORDER BY `sum`";
                                    $result_sort= $pdo->query($query_sort);
                                    $row_sort = $result_sort->fetchAll(PDO::FETCH_ASSOC);
                                    for ($i = 0; $i < count($row_sort); $i++) {
                                        echo "<tr><td>".$row_sort[$i]['name']."</td>";
                                        echo "<td>".$row_sort[$i]['code']."</td>";
                                        echo "<td>".$row_sort[$i]['sum']."</td>";
                                        echo "<td>".$row_sort[$i]['measure']."</td>";
                                        echo "<td>".$row_sort[$i]['price']."</td></tr>";
                                    }
                                }

                                if ($_POST['sorttable'] == 'sort_price') {
                                    $query_sort = "SELECT * FROM `products` ORDER BY `price`";
                                    $result_sort = $pdo->query($query_sort);
                                    $row_sort = $result_sort->fetchAll(PDO::FETCH_ASSOC);
                                    for ($i = 0; $i < count($row_sort); $i++) {
                                        echo "<tr><td>".$row_sort[$i]['name']."</td>";
                                        echo "<td>".$row_sort[$i]['code']."</td>";
                                        echo "<td>".$row_sort[$i]['sum']."</td>";
                                        echo "<td>".$row_sort[$i]['measure']."</td>";
                                        echo "<td>".$row_sort[$i]['price']."</td></tr>";
                                    }
                                }

                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Блок с добавлением товара -->
                <div class="row col-md-12 mt-4 collapse" id="new_prod">
                    <div class="container">
                        <form name="add_prod" method="post" action="add_product.php">
                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label">Наименование товара</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Введите название товара" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="code" class="col-md-3 col-form-label">Артикул товара</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="code" id="code" placeholder="Введите артикул товара" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sum" class="col-md-3 col-form-label">Количество товара</label>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="sum" id="sum" placeholder="Введите кол-во товара" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="measure" class="col-md-3 col-form-label">Единица измерения товара</label>
                                <div class="col-md-3">
                                    <select class="form-control" name="measure" id="measure">
                                        <option value="шт.">шт.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="price" class="col-md-3 col-form-label">Цена товара</label>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="price" id="price" placeholder="Введите цену товара" required>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="submit" name="add_prod" class="btn btn-success" value="Добавить товар">
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Блок редактирования товара -->
                <div class="row col-md-12 mt-4 collapse" id="edit_product">
                    <div class="container">
                        <p class="h4">Выберите то, что хотите редактировать</p>
                        <div class="col-md-12">
                            <br>
                            <h5>
                                <a href="#collapse_name" class="text-primary mr-3" data-toggle="collapse">Наименование</a>
                                <a href="#collapse_code" class="text-primary mr-3" data-toggle="collapse">Артикул</a>
                                <a href="#collapse_sum" class="text-primary mr-3" data-toggle="collapse">Количество</a>
                                <a href="#collapse_measure" class="text-primary mr-3" data-toggle="collapse">Единица измерения</a>
                                <a href="#collapse_price" class="text-primary" data-toggle="collapse">Цена</a>
                            </h5>
                        </div>
                    </div>

                    <div class="row col-md-12 mt-4 collapse" id="collapse_name">
                        <div class="container">
                            <form name="edit_product_name" method="post" action="edit_product_name.php">
                                <div class="form-group row">
                                    <label for="name" class="col-md-12">Наименование товара, который хотите редактировать</label>
                                    <div class="col-md-5">
                                        <select name="name" class="form-control">
                                            <?php
                                                for ($i = 0; $i < count($row); $i++) {
                                                ?>  <option value="<?=$row[$i]['name'];?>"><?=$row[$i]['name'];?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="collapse_name" class="col-md-12">Наименование товара</label>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="collapse_name" placeholder="Введите наименование товара">
                                    </div>
                                </div>
                                    <br>
                                    <div class="form-group row">
                                        <input type="submit" name="edit_product_name" class="btn btn-success" value="Изменить товар">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row col-md-12 mt-4 collapse" id="collapse_code">
                            <div class="container">
                                <form name="edit_product_code" method="post" action="edit_product_code.php">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-12">Наименование товара, который хотите редактировать</label>
                                        <div class="col-md-5">
                                            <select name="name" class="form-control">
                                                <?php
                                                    for ($i = 0; $i < count($row); $i++) {
                                                    ?>  <option value="<?=$row[$i]['name'];?>"><?=$row[$i]['name'];?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="collapse_code" class="col-md-12">Артикул товара</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="collapse_code" placeholder="Введите артикул товара">
                                        </div>
                                    </div>
                                        <br>
                                        <div class="form-group row">
                                            <input type="submit" name="edit_product_code" class="btn btn-success" value="Изменить товар">
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row col-md-12 mt-4 collapse" id="collapse_sum">
                                <div class="container">
                                    <form name="edit_product_sum" method="post" action="edit_product_sum.php">
                                        <div class="form-group row">
                                            <label for="name" class="col-md-12">Наименование товара, который хотите редактировать</label>
                                            <div class="col-md-5">
                                                <select name="name" class="form-control">
                                                    <?php
                                                        for ($i = 0; $i < count($row); $i++) {
                                                        ?>  <option value="<?=$row[$i]['name'];?>"><?=$row[$i]['name'];?></option>
                                                        <?php }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <label for="collapse_sum" class="col-md-12">Количество товара</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="collapse_sum" placeholder="Введите кол-во товара">
                                            </div>
                                        </div>
                                            <br>
                                            <div class="form-group row">
                                                <input type="submit" name="edit_product_sum" class="btn btn-success" value="Изменить товар">
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="row col-md-12 mt-4 collapse" id="collapse_measure">
                                    <div class="container">
                                        <form name="edit_product_measure" method="post" action="edit_product_measure.php">
                                            <div class="form-group row">
                                                <label for="name" class="col-md-12">Наименование товара, который хотите редактировать</label>
                                                <div class="col-md-5">
                                                    <select name="name" class="form-control">
                                                        <?php
                                                            for ($i = 0; $i < count($row); $i++) {
                                                            ?>  <option value="<?=$row[$i]['name'];?>"><?=$row[$i]['name'];?></option>
                                                            <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group row">
                                                <label for="collapse_measure" class="col-md-12">Единица измерения товара</label>
                                                <div class="col-md-3">
                                                    <select class="form-control" name="collapse_measure">
                                                        <option value="шт.">шт.</option>
                                                    </select>
                                                </div>
                                            </div>
                                                <br>
                                                <div class="form-group row">
                                                    <input type="submit" name="edit_product_sum" class="btn btn-success" value="Изменить товар">
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="row col-md-12 mt-4 collapse" id="collapse_price">
                                        <div class="container">
                                            <form name="edit_product_price" method="post" action="edit_product_price.php">
                                                <div class="form-group row">
                                                    <label for="name" class="col-md-12">Наименование товара, который хотите редактировать</label>
                                                    <div class="col-md-5">
                                                        <select name="name" class="form-control">
                                                            <?php
                                                                for ($i = 0; $i < count($row); $i++) {
                                                                ?>  <option value="<?=$row[$i]['name'];?>"><?=$row[$i]['name'];?></option>
                                                                <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group row">
                                                    <label for="collapse_name" class="col-md-12">Цена товара</label>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" name="collapse_price" placeholder="Введите цену товара">
                                                    </div>
                                                </div>
                                                    <br>
                                                    <div class="form-group row">
                                                        <input type="submit" name="edit_product_price" class="btn btn-success" value="Изменить товар">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>

                <!-- Блок удаления товара -->
                <div class="row col-md-12 mt-4 collapse" id="delete_product">
                    <div class="container">
                        <form name="delete_product" method="post" action="delete_product.php">
                            <div class="form-group row">
                                <label for="name" class="col-md-12">Наименование товара, который хотите удалить</label>
                                <div class="col-md-5">
                                    <select name="name" class="form-control">
                                        <?php
                                            for ($i = 0; $i < count($row); $i++) {
                                            ?>  <option value="<?=$row[$i]['name'];?>"><?=$row[$i]['name'];?></option>
                                            <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <input type="submit" name="delete_product" class="btn btn-success" value="Удалить товар">
                            </div>
                        </form>
                    </div>
                </div>

    </body>
</html>
