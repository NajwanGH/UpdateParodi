<nav class="navbar">
    <div class="menu-icon">
        <a href="#" onclick="openSlideMenu(); return false;"><i class="fa-solid fa-bars"></i> Menu</a>
    </div>
    <ul class="navbar-nav">
        <li><a href="home.php"><i class="fa-solid fa-house"></i> Home</a></li>
        <li><a href="siswa.php"><i class="fa-solid fa-user-graduate"></i> Siswa</a></li>
        <li><a href="prodi.php"><i class="fa-solid fa-layer-group"></i> Prodi</a></li>
        <li class="logout">
            <a href="logout.php">
                <i class="fa-solid fa-right-from-bracket"></i> Logout (<?php echo htmlspecialchars($_SESSION['user']); ?>)
            </a>
        </li>
    </ul>
</nav>

<div id="side-menu" class="side-nav">
    <a href="#" class="btn-close" onclick="closeSlideMenu(); return false;">&times;</a>
    <a href="home.php"><i class="fa-solid fa-house"></i> Home</a>
    <a href="siswa.php"><i class="fa-solid fa-user-graduate"></i> Siswa</a>
    <a href="prodi.php"><i class="fa-solid fa-layer-group"></i> Prodi</a>
    <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
</div>
