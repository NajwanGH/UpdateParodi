<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
    header("location: index.php?p=Silakan login terlebih dahulu!");
    exit();
}
include "koneksi.php";

$cari = "";
$where = "";
if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $cari  = $_GET['cari'];
    $where = "WHERE s.nama LIKE '%$cari%' OR s.nis LIKE '%$cari%'";
}

$data = mysqli_query($koneksi, "
    SELECT s.*, p.nama_prodi
    FROM siswa s
    JOIN prodi p ON s.kd_prodi = p.kd_prodi
    $where
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="script.js"></script>
</head>
<body>
    <?php include "navigasi.php"; ?>
    <div id="main">
        <div class="container">
            <h2><i class="fa-solid fa-user-graduate"></i> Data Siswa</h2>
            <hr>

            <?php if (isset($_GET['p'])) { ?>
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check"></i> <?php echo htmlspecialchars($_GET['p']); ?>
                </div>
            <?php } ?>

            <?php if (isset($_SESSION['pesan'])) { ?>
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <?php
                    echo htmlspecialchars($_SESSION['pesan']);
                    unset($_SESSION['pesan']);
                    ?>
                </div>
            <?php } ?>

            <?php if (isset($_GET['pesan'])) { ?>
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check"></i> <?php echo htmlspecialchars($_GET['pesan']); ?>
                </div>
            <?php } ?>

            <a href="tambah_siswa.php" class="tambah"><i class="fa-solid fa-plus"></i> TAMBAH DATA SISWA</a>

            <form method="GET" class="search-bar">
                <input type="text" name="cari" placeholder="Cari nama / NIS..."
                    value="<?php echo htmlspecialchars($cari); ?>">
                <button type="submit" class="submit"><i class="fa-solid fa-magnifying-glass"></i> CARI</button>
                <?php if ($cari != "") { ?>
                    <a href="siswa.php" class="batal"><i class="fa-solid fa-rotate-left"></i> Reset</a>
                <?php } ?>
            </form>

            <div class="table-wrap">
            <table>
                <tr>
                    <th>Foto</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Tahun Ajaran</th>
                    <th>Prodi</th>
                    <th>JK</th>
                    <th>Aksi</th>
                </tr>
                <?php if (mysqli_num_rows($data) == 0) { ?>
                <tr class="empty-row">
                    <td colspan="8"><i class="fa-regular fa-folder-open"></i> Belum ada data siswa.</td>
                </tr>
                <?php } ?>
                <?php while ($row = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td class="avatar-cell">
                        <img src="foto_siswa/<?php echo $row['foto']; ?>"
                             onerror="this.src='foto_siswa/default.jpg'">
                    </td>
                    <td><?php echo $row['nis']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['kelas']; ?></td>
                    <td><?php echo $row['tahun_ajaran']; ?></td>
                    <td><?php echo $row['nama_prodi']; ?></td>
                    <td>
                        <?php if ($row['jenis_kelamin'] == 'L') { ?>
                            <span class="badge badge-l">Laki-Laki</span>
                        <?php } else { ?>
                            <span class="badge badge-p">Perempuan</span>
                        <?php } ?>
                    </td>
                    <td>
                        <div class="action-group">
                            <a href="edit_siswa.php?id=<?php echo $row['id']; ?>" class="icon-btn edit" title="Edit"><i class="fa-solid fa-pen"></i></a>
                            <a href="hapus_siswa.php?id=<?php echo $row['id']; ?>" class="icon-btn delete" title="Hapus"
                               onclick="return confirm('Yakin ingin hapus?')"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </table>
            </div>
        </div>
    </div>
</body>
</html>
