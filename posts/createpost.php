<?php 
include("create.php"); 
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Создать пост</title> 
    <link rel="stylesheet" href="../css/header.css"> 
    <link rel="stylesheet" href="../css/postcreate.css"> 
</head> 
<body> 
    <?php 
     include("../header.php");  
    ?> 
    <ul class="menu">
        <li id="item1"><a href="http://localhost/web4/profile/accaunt.php">Профиль</a></li>
        <li id="item2"><a href="http://localhost/web4/posts/posts.php">Новости</a></li>
        <li id="item3"><a href="http://localhost/web4/chat/chat.php">Сообщения</a></li>
    </ul>

    <section class="create-post">
        <header class = "post-tt">
            <a href = "http://localhost/web4/posts/posts.php">⭠ Назад</a>
            <h1>Создать новый пост</h1>
        </header> 
        <main> 
            <form action="createpost.php" method="post" enctype="multipart/form-data"> 
                <label id="title" for="title">Заголовок:</label> 
                <input type="text" id="title" name="title" required>
                <label for="content">Содержание:</label> 
                <textarea id="content" name="content" rows="6" required></textarea><br></br>
                <label for="image" class="file-upload-label">
                    Выберите файл (Нажав на эту рамку)<br>
                    <span id="selectedFileName"></span> <!-- Добавлено для отображения имени файла -->
                    <input type="file" id="image" name="image">
                </label>
                <button type="submit">Создать пост</button> 
            </form> 
        </main> 
    </section>



    <script>
        const fileInput = document.getElementById('image');
        const fileNameDisplay = document.getElementById('selectedFileName');

        fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            fileNameDisplay.textContent = this.files[0].name;
        } else {
            fileNameDisplay.textContent = ''; // Очищаем, если файл не выбран
        }
        });
    </script>
</body> 
</html>