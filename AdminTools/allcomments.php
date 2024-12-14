<?php 
session_start(); 
require_once("../db/db.php"); 
$sql = "SELECT comments.id, comments.content, comments.post_id, posts.title AS 
post_title, author_name, comments.created_at 
        FROM comments 
        JOIN users ON author_name = users.id 
        JOIN posts ON comments.post_id = posts.id"; 
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
    <title>Все комментарии</title> 
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
    <div class="tables">
        <h1>Все комментарии</h1> 
        <table> 
            <tr> 
                <th>ID</th> 
                <th>Комментарий</th> 
                <th>Пост</th>  <!-- Столбец для названия поста --> 
                <th>Пользователь</th> 
                <th>Дата создания</th> 
                <th>Действия</th> 
            </tr> 
            <?php while($row = $result->fetch_assoc()): ?> 
                <tr> 
                    <td><?php echo $row['id']; ?></td> 
                    <td><?php echo htmlspecialchars($row['content']); ?></td> 
                    <!-- Изменен вывод: теперь показывается название поста --> 
                    <td><a href="http://localhost/final/posts/post.php?id=<?php echo $row['post_id']; ?>"><?php echo htmlspecialchars($row['post_title']); ?></a></td> 
                    <td><?php echo htmlspecialchars($row['author_name']); ?></td> 
                    <td><?php echo $row['created_at']; ?></td> 
                    <td><a id="delete" href="delete_comment.php?id=<?php echo $row['id']; ?>">Удалить</a></td> 
                </tr> 
            <?php endwhile; ?> 
        </table>
    </div>
<?php else: ?> 
    <div class="tables"> 
        <p>Комментариев нет.</p>
    </div>
<?php endif; ?> 

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