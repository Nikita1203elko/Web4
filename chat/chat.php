<?php 
session_start();  
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Чат</title> 
    <link rel="stylesheet" href="../css/header.css"> 
    <link rel="stylesheet" href="../css/chat-styles.css"> 
</head> 
<body> 
    <?php 
    include("../header.php"); 
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

    <div id="chat-container" class = "scroll"> 
        <div id="user-list"> 
            <h3>Пользователи</h3> 
            <ul id="all-users"> 
                <!-- Здесь будут отображаться все пользователи --> 
                <!-- Пример: <li class="selected">Пользователь 1</li> --> 
            </ul> 
        </div>
        <div class = "page">
        <div  class = "sub" id="chat-messages"> 
        <h3>Выберите пользователя</h3>  
        <!-- Здесь будут отображаться сообщения чата --> 
        <?php 
        if (isset($_SESSION['user_id'])) { 
            echo '<script>selectedUserId = ' . $_SESSION['user_id'] . ';</script>'; 
            include 'getMessages.php'; 
        } 
        ?>
        </div>
        </div>
        <div id="message-input"> 
            <input type="text" id="message" contenteditable="true" placeholder="Напишите сообщение...">  
            <button id="send-button"  onclick="sendMessage()">Отправить</button> 
        </div> 
    </div>

    <script src="../js/chat.js"></script>
    <script>
        const messageInput = document.getElementById('message');

        messageInput.addEventListener("keydown", function(event){
            if (event.key == "Enter"){
                sendMessage();
            }
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