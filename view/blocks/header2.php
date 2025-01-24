<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {
    // Если роль не 'admin', перенаправляем на страницу доступа запрещено
    header('Location: /view/user');
    exit();
} ?>
<header class="container">
    <span class="logo">Companies Admin</span>
    <nav>
        <ul>
            <li class="active"><a href="/view/admin/admin.php">Главная</a></li>
            <li class="btn"><a href="/view/admin/users.php">Список пользователей</a></li>
            <li class="btn"><a href="/view/admin/rev.php">Список комментарий</a></li>
            <li class="btn"><a href="/view/admin/addcomp.php">Новая компания</a></li>
            <li><?php echo htmlspecialchars($_SESSION['name']); ?></li>
            <li class="btn"><a href="../blocks/out.php">Выход</a></li>
        </ul>
    </nav>
</header>