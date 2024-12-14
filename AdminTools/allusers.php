<?php 
session_start(); 
require_once("../db/db.php"); 
$sql = "SELECT * FROM users WHERE id != 0"; 
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
    <title>Все пользователи</title> 
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
        <h1>Все пользователи</h1>
        <table> 
            <tr> 
                <th>ID</th> 
                <th>Имя пользователя</th> 
                <th>Email</th> 
                <th>Возраст</th> 
                <th>Аккаунт создан</th> 
                <th>Действия</th> 
            </tr> 
            <?php while($row = $result->fetch_assoc()): ?> 
                <tr> 
                    <td><?php echo $row['id']; ?></td> 
                    <td><?php echo htmlspecialchars($row['us_name']); ?></td> 
                    <td><?php echo htmlspecialchars($row['email']); ?></td> 
                    <td><?php echo htmlspecialchars($row['age']); ?></td> 
                    <td><?php echo htmlspecialchars($row['created']); ?></td> 
                    <td><a id="delete" href="delete_user.php?id=<?php echo $row['id']; ?>">Удалить</a></td> 
                </tr> 
            <?php endwhile; ?> 
        </table>
    </div> 
<?php else: ?> 
    <p>Пользователей нет.</p> 
<?php endif; ?> 
</body> 
</html>