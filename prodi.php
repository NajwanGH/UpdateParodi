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
    $where = "WHERE nama_prodi LIKE '%$cari%' OR kd_prodi LIKE '%$cari%'";
}
$data = mysqli_query($koneksi, "SELECT * FROM prodi $where");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Prodi</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="script.js"></script>
</head>

<body>
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.pathname);
    }
    </script>
    <?php include "navigasi.php"; ?>
    <div id="main">
        <div class="container">
            <h2><i class="fa-solid fa-layer-group"></i> Data Prodi</h2>
            <hr>

            <?php if (isset($_GET['p'])) {
                $pesan = $_GET['p'];
                $gagal = (strpos($pesan, 'tidak') !== false || strpos($pesan, 'Gagal') !== false);
            ?>
                <div class="alert <?php echo $gagal ? 'alert-danger' : 'alert-success'; ?>">
                    <i class="fa-solid <?php echo $gagal ? 'fa-circle-exclamation' : 'fa-circle-check'; ?>"></i>
                    <?php echo htmlspecialchars($pesan); ?>
                </div>
            <?php } ?>

            <?php if (isset($_GET['pesan'])) {
                $pesan2 = $_GET['pesan'];
                $gagal2 = (strpos($pesan2, 'tidak') !== false || strpos($pesan2, 'Gagal') !== false);
            ?>
                <div class="alert <?php echo $gagal2 ? 'alert-danger' : 'alert-success'; ?>">
                    <i class="fa-solid <?php echo $gagal2 ? 'fa-circle-exclamation' : 'fa-circle-check'; ?>"></i>
                    <?php echo htmlspecialchars($pesan2); ?>
                </div>
            <?php } ?>

            <a href="tambah_prodi.php" class="tambah"><i class="fa-solid fa-plus"></i> TAMBAH DATA PRODI</a>

            <form method="GET" class="search-bar">
                <input type="text" name="cari" placeholder="Cari kode / nama prodi..."
                    value="<?php echo htmlspecialchars($cari); ?>">
                <button type="submit" class="submit"><i class="fa-solid fa-magnifying-glass"></i> CARI</button>
                <?php if ($cari != "") { ?>
                    <a href="prodi.php" class="batal"><i class="fa-solid fa-rotate-left"></i> Reset</a>
                <?php } ?>
            </form>

            <div class="table-wrap">
            <table>
                <tr>
                    <th>Kode Prodi</th>
                    <th>Nama Prodi</th>
                    <th>Aksi</th>
                </tr>
                <?php if (mysqli_num_rows($data) == 0) { ?>
                <tr class="empty-row">
                    <td colspan="3"><i class="fa-regular fa-folder-open"></i> Belum ada data prodi.</td>
                </tr>
                <?php } ?>
                <?php while ($row = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td><?php echo $row['kd_prodi']; ?></td>
                    <td><?php echo $row['nama_prodi']; ?></td>
                    <td>
                        <div class="action-group">
                            <a href="edit_prodi.php?id_prodi=<?php echo $row['id_prodi']; ?>" class="icon-btn edit" title="Edit"><i class="fa-solid fa-pen"></i></a>
                            <a href="hapus_prodi.php?id_prodi=<?php echo $row['id_prodi']; ?>" class="icon-btn delete" title="Hapus"
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
