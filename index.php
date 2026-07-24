<?php
session_start();
$_SESSION['login'] = false;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem Manajemen Data Siswa</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="login-page">
    <div class="login-wrapper">
        <div class="login-side">
            <div class="icon-badge"><i class="fa-solid fa-graduation-cap"></i></div>
            <h1>Sistem Manajemen<br>Data Siswa</h1>
            <p>Kelola data siswa dan program studi SMKS PGRI 3 Malang dengan mudah, cepat, dan rapi dalam satu dashboard.</p>
        </div>
        <div class="login-form-side">
            <h2>Selamat Datang</h2>
            <p class="subtitle">Masuk ke akun Anda untuk melanjutkan</p>

            <?php if (isset($_GET['p'])) { ?>
                <div class="login-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <?php echo htmlspecialchars($_GET['p']); ?>
                </div>
            <?php } ?>

            <form action="cek_login.php" method="POST">
                <div class="field-group">
                    <label class="field-label" for="user">Username</label>
                    <div class="input-icon-wrap">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" id="user" name="user" placeholder="Masukan username" required>
                    </div>
                </div>
                <div class="field-group">
                    <label class="field-label" for="pass">Password</label>
                    <div class="input-icon-wrap">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="pass" name="pass" placeholder="Masukan password" required>
                    </div>
                </div>
                <button type="submit" class="submit submit-full">
                    <i class="fa-solid fa-right-to-bracket"></i> LOGIN
                </button>
            </form>
        </div>
    </div>
</body>
</html>
