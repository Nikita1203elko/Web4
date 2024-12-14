<?php 
session_start(); 
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Новости</title> 
    <link rel="stylesheet" href="../css/header.css"> 
    <link rel="stylesheet" href="../css/main-posts.css"> 
</head>  
<body> 
    <?php 
     include("../header.php");  
    ?> 
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

    <div class="container-post">
        <div class="container-text"> 
            <h1>Посты</h1> 
        </div>
        <?php 
            // Проверяем, авторизован ли пользователь 
            if (isset($_SESSION['id'])) { 
                // Если да, отображаем кнопку для создания поста 
                echo '<a href="createpost.php" class="create-post-button">Создать пост</a>'; 
            } 
        ?> 
        <div class="posts"> 
            <!-- Здесь будет выводиться содержимое файла с постами --> 
            <?php include("showposts.php"); ?> 
        </div> 
    </div> 
    <script> 
        document.addEventListener("DOMContentLoaded", function() { 
        // Получаем все посты по классу 
        var posts = document.querySelectorAll('.post'); 
        posts.forEach(function(post) { 
            // Добавляем обработчик события при наведении мыши 
            post.addEventListener('mouseenter', function() { 
                this.style.backgroundColor = '#eee'; // Светлее при наведении 
            }); 
            // Добавляем обработчик события при уходе мыши 
            post.addEventListener('mouseleave', function() { 
                this.style.backgroundColor = ''; // Возвращаем исходный цвет 
            }); 
            }); 
        }); 
    </script>
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
</body> 
</html>