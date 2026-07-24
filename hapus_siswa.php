<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("location:index.php");
    exit();
}

$id = $_GET['id'];
$cek = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id='$id'");
$data = mysqli_fetch_assoc($cek);

if (!$data) {
    $_SESSION['pesan'] = "Data tidak ditemukan!";
    header("location: siswa.php");
    exit();
}

$hapus = mysqli_query($koneksi, "DELETE FROM siswa WHERE id='$id'");

if ($hapus) {
    $_SESSION['pesan'] = "Data berhasil dihapus!";
    header("location: siswa.php");
    exit();
} else {
    $_SESSION['pesan'] = "Gagal menghapus data!";
    header("location: siswa.php");
    exit();
}
?>