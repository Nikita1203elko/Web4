<?php
include("db/users.php");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="css/auth.css">
</head>
<body>
    <div class="sign">
        <img src="images/logo.png" alt="Логотип">
        <h2>Регистрация</h2>
        <form class="reg" method="post" action="reg.php">
            <div class ="input-wrapper">
                <input name="login" type="text" class="form-control" id="formGroupExampleInput" placeholder="Введите ваше ФИ">
            </div>
    
            <div class="input-wrapper">
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder = "Почта">
            </div>

            <div class ="input-wrapper">
                <input name="age" type="text" class="form-control" id="formGroupExampleInput" placeholder = "Возвраст">
            </div>

            <div class="input-wrapper">
                <input name="pass-first" type="password" class="form-control" id="exampleInputPassword1" placeholder="Пароль">
                
            </div>
            <div class="input-wrapper">
                <input name="pass-second" type="password" class="form-control" id="exampleInputPassword2" placeholder="Пароль повторно">
            </div>



            <div class = "button-container">
                <button name="button-reg" type="submit" class="btn btn-primary">Зарегестрироваться</button>   
            </div>
            <li><a href = "auth.php">Войти<a></li>
        </form>

        
        
    </div>
</body>
</html>
