<?php
session_start();
include "koneksi.php";
if (!isset($_SESSION['login'])) {
    header("location:index.php");
    exit();
}
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id='$id'");
$data = mysqli_fetch_assoc($query);
$prodi = mysqli_query($koneksi, "SELECT * FROM prodi");

if (isset($_POST['update'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $tahun_ajaran = $_POST['tahun_ajaran'];
    $kd_prodi = $_POST['kd_prodi'];
    $jk = $_POST['jenis_kelamin'];
    
    $update = mysqli_query($koneksi, "UPDATE siswa SET
        nis='$nis',
        nama='$nama',
        kelas='$kelas',
        tahun_ajaran='$tahun_ajaran',
        kd_prodi='$kd_prodi',
        jenis_kelamin='$jk'
        WHERE id='$id'
        ");
    
    if ($update) {
        $_SESSION['pesan'] = "Data Siswa berhasil di edit!";
    } else {
        $_SESSION['pesan'] = "Gagal mengedit data.";
    }
    
    header("location:siswa.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="script.js"></script>
</head>
<body>
    <?php include "navigasi.php"; ?>
    <div id="main">
        <div class="container">
            <h2><i class="fa-solid fa-user-pen"></i> Edit Data Siswa</h2>
            <hr>
            <form method="POST">
                <div class="form-grid">
                    <div class="form-row">
                        <label>NIS</label>
                        <input type="text" name="nis" value="<?php echo $data['nis']; ?>" required>
                    </div>
                    <div class="form-row">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required>
                    </div>
                    <div class="form-row">
                        <label>Kelas</label>
                        <input type="text" name="kelas" value="<?php echo $data['kelas']; ?>" required>
                    </div>
                    <div class="form-row">
                        <label>Tahun Ajaran</label>
                        <input type="text" name="tahun_ajaran" value="<?php echo $data['tahun_ajaran']; ?>" required>
                    </div>
                    <div class="form-row">
                        <label>Program Studi</label>
                        <select name="kd_prodi" required>
                            <option value="">-- Pilih Prodi --</option>
                            <?php
                            while ($p = mysqli_fetch_assoc($prodi)) {
                            ?>
                            <option value="<?php echo $p['kd_prodi']; ?>"
                                <?php if ($p['kd_prodi'] == $data['kd_prodi']) { echo "selected"; } ?>>
                                <?php echo $p['nama_prodi']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-row">
                        <label>Jenis Kelamin</label>
                        <div class="radio-group">
                            <label><input type="radio" name="jenis_kelamin" value="L" <?php if ($data['jenis_kelamin'] == 'L') { echo "checked"; } ?>> Laki-Laki</label>
                            <label><input type="radio" name="jenis_kelamin" value="P" <?php if ($data['jenis_kelamin'] == 'P') { echo "checked"; } ?>> Perempuan</label>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" name="update" class="submit"><i class="fa-solid fa-floppy-disk"></i> UPDATE</button>
                        <a href="siswa.php" class="batal"><i class="fa-solid fa-xmark"></i> BATAL</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
