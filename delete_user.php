<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include 'koneksi/koneksi.php';

// mendapatkan id dari URL
$id = $_GET['id'];

// menghapus data user dari database
$query = "DELETE FROM user WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

// periksa query apakah ada error
if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
} else {
    // tampil alert dan akan redirect ke halaman data_user.php
    echo "<script>alert('Data berhasil dihapus.');window.location='data_user.php';</script>";
}
?>

