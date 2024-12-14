<?php
include("db/users.php");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="css/auth.css">
</head>
<body>
    <div class="sign">
        <img src="images/logo.png" alt="Логотип">
        <h2>Авторизация</h2>
        <form class="reg" method="post" action="auth.php">
            <div class="input-wrapper">
                <input name='email' type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder = "Почта">
            </div>
            <div class="input-wrapper">
                <input name='password' type="password" class="form-control"
                id="exampleInputPassword1" placeholder="Пароль">
            </div>

            <div class = "button-container">
                <button name="button-log" type="submit" class="btn btn-primary">Войти</button>   
            </div>
            <li><a href = "reg.php">Зарегестрироваться<a></li>
        </form>

        
        
    </div>
</body>
</html>
