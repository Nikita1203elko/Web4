<?php 
session_start();  
// Получение ID пользователя из сессии 
$user_id = $_SESSION['id']; 
ob_start(); // Начало буферизации вывода 
include("upload-posts.php"); 
$output = ob_get_clean(); // Получение содержимого буфера и его очистка 
// Теперь переменная $output содержит всё, что было выведено скриптом upload-posts.php 
// И вы можете использовать эту переменную в нужном месте вашего HTML

// Проверка сессии
if (!isset($_SESSION['id'])) {
    header("Location: ../auth.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($_SESSION['us_name']) ? $_SESSION['us_name'] : ''; ?></title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/profile-styles.css">
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
    
    <section class="profile">
        <div id="profile-picture-container">
            <img id="profile-picture" src="avatars/placeholder.png" >
        </div>

        <!-- Вставляем имя пользователя из сессии -->
        <p>ФИО: <span class="info" id="user-name"><?php echo isset($_SESSION['us_name']) ? $_SESSION['us_name'] : ''; ?></span></p>
        <!-- Вставляем возраст пользователя из сессии -->
        <p>Возраст: <span class="info" id="user-age"><?php echo isset($_SESSION['age']) ? $_SESSION['age'] : ''; ?></span></p>

        <p>Дата создания аккаунта: <span class="info" id="account-creationdate"></span></p>
        <p>Email: <span class="info" id="user-email"></span></p>
        <p>О себе: <span class="info" id="user-info"></span></p>
        <h3>Панель управления</h3>
    <button id="edit-profile" onclick="document.location='editer_profile.php'">Редактировать Профиль</button>
    <button onclick="document.location='http://localhost/web4/AdminChat/AdminChat.php'" id="admin-chat">Написать администратору</button>
    <!-- Кнопка обновления картинки -->
    <button id="update-picture">Обновить картинку</button>
    <!-- Кнопка удаления картинки -->
    <button id="delete-picture">Удалить картинку</button>
    <!-- Элемент для загрузки новой картинки -->
    <input type="file" id="file-input" accept="image/*" style="display: none">
    </section>

    <section id="user-posts"> 
        <h2>Мои посты</h2> 
        <?php echo $output; ?> 
    </section> 
    <script> 
    document.addEventListener("DOMContentLoaded", function() { 
        // Получаем все посты по классу 
        var posts = document.querySelectorAll('.post-block'); 
    
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


    <script src="../js/profile.js" defer></script>
    <script src="../js/picture.js" defer></script>
</body>
</html>

