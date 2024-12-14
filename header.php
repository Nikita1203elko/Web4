<?php
include("db/db.php");
?>

<header id="fixed-header">
    <div class="container">
        <img src="logo.png" alt="Логотип компании" class="logo">
        <h1>nekitnet</h1>
        <div class="user-section">
            <div class="user-logout">
                <a href="#" class="user-link">
                    <span class="arrow">▼</span>
                </a>
                <ul class="dropdown">
                    <li><a href="logout.php">Выход</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>




<script>
    document.addEventListener('DOMContentLoaded', function() {  
        const userLink = document.querySelector('.user-link');
        const dropdown = document.querySelector('.dropdown');

        userLink.addEventListener('click', function(event) {
            event.preventDefault(); // Предотвращаем переход по ссылке
            dropdown.classList.toggle('show');
        });
    });
</script>