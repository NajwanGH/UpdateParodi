<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "jwan_penilaian";

$koneksi = mysqli_connect($host, $username, $password);

if ($koneksi) {
    $pilih_db = mysqli_select_db($koneksi, $database);
    if ($pilih_db) {
    }
} else {
    echo "Koneksi Gagal, di periksa lagi";
}
?>