<?php 
session_start(); 
require_once("../db/db.php"); 
$sql = "SELECT posts.id, posts.title, users.us_name, posts.created_at FROM 
posts JOIN users ON posts.user_id = users.id"; 
$result = $conn->query($sql); 
 
if (!$result) { 
    // Если запрос не выполнен, выводим сообщение об ошибке 
    die("Ошибка выполнения запроса: " . $conn->error); 
} 
?> 
<!DOCTYPE html> 
<html lang="ru"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Все посты</title> 
    <link rel="stylesheet" href="../css/header.css"> 
    <link rel="stylesheet" href="../css/tools.css"> 
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





<?php if ($result->num_rows > 0): ?>
    <div class = "tables">
        <h1>Все посты</h1>
        <table>  
            <tr> 
                <th>ID</th> 
                <th>Заголовок</th> 
                <th>Автор</th> 
                <th>Дата создания</th> 
                <th>Действия</th> 
            </tr> 
            <?php while($row = $result->fetch_assoc()): ?> 
                <tr> 
                    <td><?php echo $row['id']; ?></td> 
                    <td><?php echo htmlspecialchars($row['title']); ?></td> 
                    <td><?php echo htmlspecialchars($row['us_name']); ?></td> 
                    <td><?php echo $row['created_at']; ?></td> 
                    <td> 
                        <a id = "search"href="http://localhost/posts/post.php?id=<?php echo $row['id']; ?>">Просмотреть</a>  
                        <a id="delete" href="delete_post.php?id=<?php echo $row['id']; ?>">Удалить</a> 
                    </td> 
                </tr> 
            <?php endwhile; ?> 
        </table>
    </div>
<?php else: ?> 
    <div class = "tables">
        <p>Постов нет.</p>
    </div>
<?php endif; ?> 



<script>
        document.addEventListener('DOMContentLoaded', function() {
        const adminMenu = document.querySelector('.admin-menu');
        const adminDropdown = document.querySelector('.admin-dropdown');

        adminMenu.addEventListener('click', function(event) {
            event.stopPropagation();
            dropdown.classList.toggle('show');
            adminDropdown.style.display = 'block';
        });

        adminMenu.addEventListener('mouseleave', function(event) {
            dropdown.classList.toggle('show');
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