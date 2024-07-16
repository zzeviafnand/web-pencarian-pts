<?php
// Include database connection
include 'koneksi/koneksi.php';

// Get the ID from the URL
$id = $_GET['id'];

// Delete Perguruan Tinggi data from the database
$query = "DELETE FROM data_knn WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

// Check for errors
if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
} else {
    // Redirect to the data_pt.php page
    echo "<script>alert('Data berhasil dihapus.');window.location='data_knn.php';</script>";
}
?>
