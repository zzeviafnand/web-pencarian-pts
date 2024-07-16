<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include 'koneksi/koneksi.php';

// membuat variabel untuk menampung data dari form
$id = $_POST['id'];
$nama_lengkap = $_POST['nama_lengkap'];
$username = $_POST['username'];
$password = $_POST['password'];

$query  = "UPDATE user SET nama_lengkap = '$nama_lengkap', username = '$username', password = '$password'";
$query .= " WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

// periksa query apakah ada error
if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
} else {
    // tampil alert dan akan redirect ke halaman data_user.php
    echo "<script>alert('Data berhasil diubah.');window.location='data_user.php';</script>";
}
?>
