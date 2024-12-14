<?php
include("../db/users.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование Профиля</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/editer-styles.css">

</head>
<body>
    <?php
    include("../header.php")
    ?>
    <script>
        function toggleDropdown(element) {
            const dropdown = element.nextElementSibling;
            dropdown.classList.toggle("show");
        }
    </script>


<ul class="menu">
        <li id="item1"><a href="http://localhost/web4/profile/accaunt.php">Профиль</a></li>
        <li id="item2"><a href="http://localhost/web4/posts/posts.php">Новости</a></li>
        <li id="item3"><a href="http://localhost/web4/chat/chat.php">Сообщения</a></li>
        <?php
        // Проверяем, является ли пользователь администратором 
        if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1) { 
            echo '<li id="item4" class="admin-menu">'; // Добавили класс admin-menu
            echo '<a href="#">Админ</a>'; // Убрали href из admin-menu
            echo '<ul class="admin-dropdown">'; // Изменили класс на admin-dropdown
            echo '<li><a href="http://localhost/web4/AdminTools/allusers.php">Пользователи</a></li>';
            echo '<li><a href="http://localhost/web4/AdminTools/allposts.php">Посты</a></li>';
            echo '<li><a href="http://localhost/web4/AdminTools/allcomments.php">Комментарии</a></li>';
            echo '</ul>';
            echo '</li>';
        }?>
    </ul>
    
    <section id="edit-profile-form">
        <form action="editer_profile.php" method="post">
            <label for="name">ФИО:</label><br>
            <input type="text" id="user-name" name="user-name" value="<?php echo isset($_SESSION['us_name']) ? $_SESSION['us_name'] : ''; ?>"><br>
            <label for="age">Возраст:</label><br>
            <input type="text" id="user-age" name="user-age" value="<?php echo isset($_SESSION['age']) ? $_SESSION['age'] : ''; ?>"><br>
            <label for="email">Email:</label><br>
            <input type="email" id="user-email" name="user-email"><br>
            <label for="info">О себе:</label><br>
            <textarea id="user-info" name="user-info"></textarea><br>
            <label for="password">Пароль:</label><br>
            <input type="password" name="pass-first"><br>
            <label for="confirm_password">Повторите пароль:</label><br>
            <input type="password" name="pass-second"><br>
            <div class = "button-container">
                <button name="button-upd" type="submit">Отправить</button>
            </div>
            
        </form>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const adminMenu = document.querySelector('.admin-menu');
        const adminDropdown = document.querySelector('.admin-dropdown');

        adminMenu.addEventListener('click', function(event) {
            event.stopPropagation();
            adminDropdown.style.display = 'block';
        });

        adminMenu.addEventListener('mouseleave', function(event) {
            const menuRect = adminMenu.getBoundingClientRect();
            const mouseX = event.clientX;
            const mouseY = event.clientY;

            const distanceX = Math.abs(mouseX - (menuRect.left + menuRect.width / 2));
            const distanceY = Math.abs(mouseY - (menuRect.top + menuRect.height / 2));

            const distance = Math.sqrt(distanceX * distanceX + distanceY * distanceY);

            if (distance > 50) {
                adminDropdown.style.display = 'none';
            }
        });
        });
    </script>

    <script src="../js/profile.js" defer></script>
</body>
</html>

