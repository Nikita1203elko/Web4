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
    <div id="chat-container"> 
        <?php 
        // Проверяем, есть ли параметр сессии "admin" и равен ли он 1 
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) { 
            // Если да, то отображаем список пользователей 
            echo '<div id="user-list">'; 
            echo '<h3>Пользователи</h3>'; 
            echo '<ul id="all-users">'; 
            echo '</ul>'; 
            echo '</div>'; 
        } 
        ?> 
        <div id="chat-messages"> 
            <!-- Здесь будут отображаться сообщения чата --> 
            <?php 
            if (isset($_SESSION['user_id'])) { 
                echo '<script>selectedUserId = ' . $_SESSION['user_id'] . ';</script>'; 
                include 'getMessages.php'; 
            } 
            ?> 
        </div>
        <div id="message-input"> 
            <input type="text" id="message" contenteditable="true" placeholder="Напишите сообщение...">  
            <button id="send-button" onclick="sendMessage()">Отправить</button> 
        </div> 
    </div> 


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
    <script src="../js/chat-admin.js"></script> 
</body> 
</html>