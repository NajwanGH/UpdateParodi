<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
    header("location: index.php?p=Silakan login terlebih dahulu!");
    exit();
}
include "koneksi.php";

$jam = date('H');
if ($jam >= 00 && $jam < 10 ) {
    $ucapan = "Selamat Pagi";
} elseif ($jam >= 11 && $jam < 15) {
    $ucapan = "Selamat Siang";
} elseif ($jam >= 15 && $jam < 18) {
    $ucapan = "Selamat Sore";
} else {
    $ucapan = "Selamat Malam";
}

$hari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
$bulan = ["","Januari","Februari","Maret","April","Mei","Juni",
          "Juli","Agustus","September","Oktober","November","Desember"];

$tanggal = $hari[date('w')] . ", " . date('d') . " " . $bulan[date('n')] . " " . date('Y');

// Statistik dashboard
$total_siswa = 0;
$total_prodi = 0;
$total_lk = 0;
$total_pr = 0;

$q1 = mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM siswa");
if ($q1) { $total_siswa = mysqli_fetch_assoc($q1)['jml']; }

$q2 = mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM prodi");
if ($q2) { $total_prodi = mysqli_fetch_assoc($q2)['jml']; }

$q3 = mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM siswa WHERE jenis_kelamin='L'");
if ($q3) { $total_lk = mysqli_fetch_assoc($q3)['jml']; }

$q4 = mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM siswa WHERE jenis_kelamin='P'");
if ($q4) { $total_pr = mysqli_fetch_assoc($q4)['jml']; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Sistem Manajemen Data Siswa</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="script.js"></script>
</head>
<body>
    <?php include "navigasi.php"; ?>
    <div id="main">
        <div class="welcome-card">
            <h2><?php echo $ucapan . ", " . htmlspecialchars($_SESSION['user']); ?> <i class="fa-solid fa-hand-sparkles"></i></h2>
            <div class="date-tag"><i class="fa-regular fa-calendar"></i> <?php echo $tanggal; ?></div>
            <p class="desc">Selamat datang di Aplikasi Manajemen Data Siswa SMKS PGRI 3 Malang. Pantau dan kelola data siswa serta program studi dari satu tempat.</p>
        </div>

        <div class="stat-grid">
            <div class="stat-card">
                <div class="stat-icon blue"><i class="fa-solid fa-user-graduate"></i></div>
                <div class="stat-info">
                    <div class="stat-value"><?php echo $total_siswa; ?></div>
                    <div class="stat-label">Total Siswa</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon gold"><i class="fa-solid fa-layer-group"></i></div>
                <div class="stat-info">
                    <div class="stat-value"><?php echo $total_prodi; ?></div>
                    <div class="stat-label">Program Studi</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green"><i class="fa-solid fa-mars"></i></div>
                <div class="stat-info">
                    <div class="stat-value"><?php echo $total_lk; ?></div>
                    <div class="stat-label">Siswa Laki-Laki</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:linear-gradient(135deg,#B23A6E,#D6608E);"><i class="fa-solid fa-venus"></i></div>
                <div class="stat-info">
                    <div class="stat-value"><?php echo $total_pr; ?></div>
                    <div class="stat-label">Siswa Perempuan</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
