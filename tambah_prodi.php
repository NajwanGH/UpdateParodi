<?php
session_start();
include "koneksi.php";
$error = "";
$sukses = "";

if (isset($_POST['simpan'])) {
    $kd_prodi = trim($_POST['kd_prodi']);
    $nama_prodi = trim($_POST['nama_prodi']);

    if (empty($kd_prodi) || empty($nama_prodi)) {
        $error = "Semua wajib diisi!";
    } else {
        $cek = mysqli_query($koneksi, "SELECT * FROM prodi WHERE kd_prodi='$kd_prodi'");
        if (mysqli_num_rows($cek) > 0) {
            $error = "Prodi sudah digunakan!";
        } else {
            mysqli_query($koneksi, "INSERT INTO prodi VALUES(NULL, '$kd_prodi','$nama_prodi')");
            header("location: prodi.php?pesan=Prodi berhasil ditambahkan!");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Prodi</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="script.js"></script>
</head>
<body>
    <?php include "navigasi.php"; ?>
    <div id="main">
        <div class="container">
            <h2><i class="fa-solid fa-layer-group"></i> Tambah Prodi</h2>
            <hr>
            <?php if ($error != "") { ?>
                <div class="alert alert-danger">
                    <i class="fa-solid fa-circle-exclamation"></i> <?php echo $error; ?>
                </div>
            <?php } ?>
            <form method="POST">
                <div class="form-grid">
                    <div class="form-row">
                        <label>Kode Prodi</label>
                        <input type="text" name="kd_prodi" placeholder="Contoh: RPL" required>
                    </div>
                    <div class="form-row">
                        <label>Nama Prodi</label>
                        <input type="text" name="nama_prodi" placeholder="Contoh: Rekayasa Perangkat Lunak" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" name="simpan" class="submit"><i class="fa-solid fa-floppy-disk"></i> SIMPAN</button>
                        <a href="prodi.php" class="batal"><i class="fa-solid fa-xmark"></i> BATAL</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
