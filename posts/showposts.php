<?php 
include_once '../db/db.php'; 
// SQL запрос на выборку всех постов 
$sql = "SELECT id, title, content, image_url FROM posts ORDER BY created_at DESC"; 
$result = $conn->query($sql); 
if ($result->num_rows > 0) { 
    // Вывод данных каждой строки 
    while($row = $result->fetch_assoc()) { 
        echo '<a href="post.php?id=' . $row["id"] . '" style="color: black; text-decoration: none;"><div class="post">'; 
        echo '<div class="post-img-container">'; 
        if (!empty($row["image_url"])) { 
            echo '<img src="' . htmlspecialchars($row["image_url"]) . '" 
alt="Post Image">'; 
        } 
        echo '</div>'; 
        echo '<div class="post-content">'; 
        echo '<h2>' . htmlspecialchars($row["title"]) . '</h2>'; 
        echo '<p>' . nl2br(htmlspecialchars(substr($row["content"], 0, 200))) . 
'...</p>'; 
        echo '</div>'; 
        echo '</div></a>'; 
    } 
} else { 
    echo "Постов пока нет."; 
} 
$conn->close(); 
?>