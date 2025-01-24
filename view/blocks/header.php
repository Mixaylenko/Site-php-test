<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>
<header class="container">
    <span class="logo">Companies</span>
    <nav>
        <ul>
            <li class="active"><a href="/view/user">Главная</a></li>
            <?php if ($_SESSION['role'] == null || $_SESSION['role'] == 'guest') { 
                $_SESSION['role']='guest'; ?>
                <li class="btn"><a href="/view/user/login.php">Вход</a></li>
            <?php } else { ?>
                <li><?php echo htmlspecialchars($_SESSION['name']); ?></li>
                <li class="btn"><a href="../blocks/out.php">Выход</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>