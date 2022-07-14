<?php
//Авторизация
    session_start();
    include "database.php";

    if (isset($_POST['auth'])) {
        $login = $_POST['login'];
        $password = md5($_POST['password']);
    }

    $query_login = "SELECT * FROM `users` WHERE `login`='$login' and `password`='$password' LIMIT 1";
    $result_login  = $pdo->query($query_login);
    $row_login  = $result_login ->fetch(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация</title>
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
    <link rel="stylesheet" href="css/main.css">
</head>
    <body>
        <div id="wrapper">
            <div class="text-center">
                <img src="img/logo.gif" alt="Логотип">
            </div>
            <div class="container text-center block-auth border border-primary">
                <div class="text-primary">
                    <h3>Авторизация</h3>
                </div>
                <form name="auth" method="post" action="index.php">
                    <div class="form-group">
                        <label for="login">Логин</label>
                        <input type="text" class="form-control" name="login" id="login" placeholder="Введите логин" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль" required>
                        <div class="auth-false">
                            <?php echo "<link rel='stylesheet' href='css/main.css'>";
                            if (isset($_POST['auth'])) {
                            if (!$row_login) {
                                echo "<h6>Логин или пароль не верны</h6>";
                            } else {
                                $_SESSION['login'] = $login;
                                $_SESSION['password'] = $password ?>
                                <script>
                                    window.location.href='product.php';
                                </script>
                            <?php } } ?>
                        </div>
                    </div>
					<br>
                    <input type="submit" name="auth" class="btn btn-success btn-block" value="Войти">
            </form>
            </div>
        </div>
    </body>
</html>
