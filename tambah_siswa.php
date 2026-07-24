<?php
session_start();
include "koneksi.php";
if (!isset($_SESSION['login'])) {
    header("location:index.php");
    exit();
}

$error = "";

if (isset($_POST['simpan'])) {
    $nis          = trim($_POST['nis']);
    $nama         = trim($_POST['nama']);
    $kelas        = trim($_POST['kelas']);
    $tahun_ajaran = trim($_POST['tahun_ajaran']);
    $kd_prodi     = $_POST['kd_prodi'];
    $jk           = $_POST['jenis_kelamin'];

    if (empty($nis) || empty($nama) || empty($kelas) || empty($tahun_ajaran)) {
        $error = "Semua wajib diisi!";
    } else {
        $foto = "default.jpg";
        
        if (!empty($_FILES['foto']['name'])) {
            $ekstensi_boleh = ['jpg', 'jpeg', 'png'];
            $ekstensi_foto  = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

            if (!in_array($ekstensi_foto, $ekstensi_boleh)) {
                $error = "Foto profil harus JPG atau PNG -_-";
            } else {
                $nama_foto = time() . "_" . $_FILES['foto']['name'];
                
                move_uploaded_file($_FILES['foto']['tmp_name'], "foto_siswa/" . $nama_foto);
                $foto = $nama_foto;
            }
        }

        if ($error == "") {
            $insert = mysqli_query($koneksi, "INSERT INTO siswa 
            (nis, nama, kelas, tahun_ajaran, kd_prodi, jenis_kelamin, foto) 
            VALUES ('$nis', '$nama', '$kelas', '$tahun_ajaran', '$kd_prodi', '$jk', '$foto')");
            
            if ($insert) {
                $_SESSION['pesan'] = "Siswa berhasil ditambahkan!";
            } else {
                $_SESSION['pesan'] = "Gagal menambahkan data siswa.";
            }
            
            header("location: siswa.php");
            exit();
        }
    }
}

$prodi = mysqli_query($koneksi, "SELECT * FROM prodi");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="script.js"></script>
</head>
<body>
    <?php include "navigasi.php"; ?>
    
    <div id="main">
        <div class="container">
            <h2><i class="fa-solid fa-user-plus"></i> Tambah Data Siswa</h2>
            <hr>
            
            <?php if ($error != "") { ?>
                <div class="alert alert-danger">
                    <i class="fa-solid fa-circle-exclamation"></i> <?php echo $error; ?>
                </div>
            <?php } ?>

            <form method="POST" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="form-row">
                        <label>NIS</label>
                        <input type="text" name="nis" placeholder="Contoh: 2526001" required>
                    </div>
                    <div class="form-row">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" placeholder="Nama siswa" required>
                    </div>
                    <div class="form-row">
                        <label>Kelas</label>
                        <input type="text" name="kelas" placeholder="Contoh: XII RPL 1" required>
                    </div>
                    <div class="form-row">
                        <label>Tahun Ajaran</label>
                        <input type="text" name="tahun_ajaran" placeholder="Contoh: 2025/2026" required>
                    </div>
                    <div class="form-row">
                        <label>Program Studi</label>
                        <select name="kd_prodi" required>
                            <option value="">-- Pilih Prodi --</option>
                            <?php while ($p = mysqli_fetch_assoc($prodi)) { ?>
                            <option value="<?php echo $p['kd_prodi']; ?>">
                                <?php echo $p['nama_prodi']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-row">
                        <label>Jenis Kelamin</label>
                        <div class="radio-group">
                            <label><input type="radio" name="jenis_kelamin" value="L" required> Laki-Laki</label>
                            <label><input type="radio" name="jenis_kelamin" value="P"> Perempuan</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <label>Foto Profil</label>
                        <div class="photo-upload">
                            <img id="fotoPreview" class="photo-preview" src="foto_siswa/default.jpg" alt="preview">
                            <div>
                                <input type="file" name="foto" accept="image/*" onchange="previewFoto(this)">
                                <small class="file-hint">Format JPG/PNG. Kosongkan jika tidak ada.</small>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" name="simpan" class="submit"><i class="fa-solid fa-floppy-disk"></i> SIMPAN</button>
                        <a href="siswa.php" class="batal"><i class="fa-solid fa-xmark"></i> BATAL</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
