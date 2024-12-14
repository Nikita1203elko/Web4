<?php
session_start();
include("db.php");

function setSession($id, $us_name, $admin, $age){
    $_SESSION['id'] = $id;
    $_SESSION['us_name'] = $us_name;
    $_SESSION['admin'] = $admin;
    $_SESSION['age'] = $age;
}

// Авторизация пользователя
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['button-log'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Подготавливаем и выполняем запрос на выборку данных пользователя из базы
    $stmt = $conn->prepare("SELECT id, us_name, admin, age, password FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Проверяем введенный пароль с хэшированным паролем в базе
        if (password_verify($password, $row['password'])) {
            setSession($row['id'], $row['us_name'], $row['admin'], $row['age']); 
 

            $error_message = "Успешно авторизированны";
            header("Location: main.php");
            exit(); // Обязательно exit() после header()
        } else {
            $error_message = "Неверный пароль."; // Сохраняем сообщение об ошибке в переменную
        }
    } else {
        $error_message = "Пользователь с таким адресом электронной почты не найден."; // Сохраняем сообщение об ошибке в переменную
    }
    $stmt->close();
}

//Выводим сообщение об ошибке, если оно есть.
if (isset($error_message)) {
    echo $error_message;
}

// Регистрация нового пользователя
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['button-reg'])) {

    // Получаем данные из формы
    $us_name = $_POST['login'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $pass_first = $_POST['pass-first'];
    $pass_second = $_POST['pass-second'];

    // Проверяем, совпадают ли пароли
    if ($pass_first !== $pass_second) {
        echo "Пароли не совпадают.";
    } else {
        // Хэшируем пароль
        $hashed_password = password_hash($pass_first, PASSWORD_DEFAULT);

        // Проверяем, существует ли пользователь с таким email
        $check_email_query = "SELECT * FROM users WHERE email = ?";
        $stmt_check = $conn->prepare($check_email_query); // Используем prepare для защиты от SQL-инъекций
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $check_email_result = $stmt_check->get_result();
        $stmt_check->close(); // Закрываем подготовленный запрос

        if ($check_email_result->num_rows > 0) {
            echo "Пользователь с таким адресом электронной почты уже существует.";
        } else {
            // Устанавливаем значение поля admin
            $admin = 0;

            // Подготавливаем и выполняем запрос на вставку данных в базу
            $stmt = $conn->prepare("INSERT INTO users (admin, us_name, email, age, password) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $admin, $us_name, $email, $age, $hashed_password);

            if ($stmt->execute()) {
                echo "Регистрация успешна.";
                setSession($conn->insert_id, $us_name, 0, $age); // Предполагается, что функция setSession уже определена
                header("Location: main.php");
                exit();
            } else {
                echo "Ошибка при регистрации: " . $conn->error;
            }
            $stmt->close();
        }
    }
}

// Редактирование профиля пользователя
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['button-upd'])) {
    // Получаем данные из формы
    $id = $_SESSION['id'];
    $us_name = $_POST['user-name'];
    $email = $_POST['user-email'];
    $age = $_POST['user-age'];
    $info = $_POST['user-info'];
    $pass_first = $_POST['pass-first'];
    $pass_second = $_POST['pass-second'];
    // Проверяем, совпадают ли пароли
    if ($pass_first !== $pass_second) {
        echo "Пароли не совпадают.";
    } else {
        // Проверяем, был ли введен новый пароль, если да, то хешируем и помещаем в кусочек запроса,
        // иначе в запросе новый пароль не указываем
        if (!empty($pass_first)) {
            // Хэшируем новый пароль
            $hashed_password = password_hash($pass_first, PASSWORD_DEFAULT);
            $password_update = ", password = '$hashed_password'";
        } else {
            // Если пароль не введен, то оставляем прежний пароль
            $password_update = "";
        }
        // Проверяем, существует ли пользователь с таким email, исключая текущего пользователя
        $check_email_query = "SELECT * FROM users WHERE email='$email' AND id != $id";
        $check_email_result = $conn->query($check_email_query);
        if ($check_email_result && $check_email_result->num_rows > 0) {
            echo "Пользователь с таким адресом электронной почты уже существует.";
        } else {
            // Подготавливаем и выполняем запрос на обновление данных в базе
            $info_escaped = mysqli_real_escape_string($conn, $info);
            $update_query = "UPDATE users SET us_name = '$us_name', email =
            '$email', age = $age $password_update, info = '$info_escaped' WHERE id = $id";
            if ($conn->query($update_query) === TRUE) {
                echo "Данные успешно изменены.";
                $_SESSION['us_name'] = $us_name;
                $_SESSION['age'] = $age;
                header("Location: http://localhost/web4/profile/accaunt.php");
                exit();
            } else {
                echo "Ошибка при обновлении данных: " . $conn->error;
            }
        }
    }
}


        









?>





