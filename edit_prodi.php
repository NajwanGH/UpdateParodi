<?php
session_start();
include "koneksi.php";
if (!isset($_SESSION['login'])) {
    header("location:index.php");
    exit();
}
$id_prodi = $_GET['id_prodi'];
$query = mysqli_query($koneksi, "SELECT * FROM prodi WHERE id_prodi='$id_prodi'");
$data = mysqli_fetch_assoc($query);

$error = "";
if (isset($_POST['update'])) {
    $kd_prodi = $_POST['kd_prodi'];
    $nama_prodi = $_POST['nama_prodi'];
    
    $update = mysqli_query($koneksi, "UPDATE prodi
    SET kd_prodi='$kd_prodi', nama_prodi='$nama_prodi'
    WHERE id_prodi='$id_prodi'");
    
    if ($update) {
        header("location: prodi.php?pesan=Data Berhasil di Edit");
        exit();
    } else {
        header("location: prodi.php?pesan=Gagal mengedit data");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Prodi</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="script.js"></script>
</head>
<body>
    <?php include "navigasi.php"; ?>
    <div id="main">
        <div class="container">
            <h2><i class="fa-solid fa-layer-group"></i> Edit Prodi</h2>
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
                        <input type="text" name="kd_prodi" value="<?php echo $data['kd_prodi']; ?>" required>
                    </div>
                    <div class="form-row">
                        <label>Nama Prodi</label>
                        <input type="text" name="nama_prodi" value="<?php echo $data['nama_prodi']; ?>" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" name="update" class="submit"><i class="fa-solid fa-floppy-disk"></i> UPDATE</button>
                        <a href="prodi.php" class="batal"><i class="fa-solid fa-xmark"></i> BATAL</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
