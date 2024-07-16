<?php 
// koneksi database
include 'koneksi/koneksi.php';
 
// menangkap data yang di kirim dari form
$nama_lengkap = $_POST['nama_lengkap'];
$username = $_POST['username'];
$password = $_POST['password'];

// cek apakah username sudah ada
$query_check_username = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");

if ($query_check_username->num_rows > 0) {
    echo "<script>alert('Username sudah digunakan, silahkan gunakan username lain.');window.location='tambah_user.php';</script>";
} else {
    // jalankan query INSERT untuk menambah data ke database
    $query = "INSERT INTO user (nama_lengkap, username, password) VALUES ('$nama_lengkap', '$username', '$password')";
    $result = mysqli_query($koneksi, $query);

    // periksa query apakah ada error
    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    } else {
        // tampil alert dan akan redirect ke halaman data_user.php
        echo "<script>alert('Data berhasil ditambah.');window.location='data_user.php';</script>";
    }
}
?>
