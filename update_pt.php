<?php
// Include database connection
include 'koneksi/koneksi.php';

// Retrieve data from the form
$id = $_POST['id'];
$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];
$lokasi = $_POST['lokasi'];
$akreditasi = $_POST['akreditasi'];

// Check if photo is uploaded
if (isset($_FILES['photo']['name']) && !empty($_FILES['photo']['name'])) {
    $photo = $_FILES['photo']['name'];
    $target_directory = "/foto_pt";
    $target_file = $target_directory . basename($photo);

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
        // File uploaded successfully, proceed with database update
        $query = "UPDATE perguruan_tinggi SET nama = '$nama', deskripsi = '$deskripsi', lokasi = '$lokasi', akreditasi = '$akreditasi', photo = '$photo' WHERE id = '$id'";
    } else {
        echo "<script>alert('Failed to upload photo.');window.location='edit_pt.php?id=$id';</script>";
        exit;
    }
} else {
    // If no photo is uploaded, update data without changing the photo field
    $query = "UPDATE perguruan_tinggi SET nama = '$nama', deskripsi = '$deskripsi', lokasi = '$lokasi', akreditasi = '$akreditasi' WHERE id = '$id'";
}

// Execute the query
$result = mysqli_query($koneksi, $query);

// Check for errors
if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
} else {
    // Redirect to the data_pt.php page
    echo "<script>alert('Data berhasil diubah.');window.location='data_pt.php';</script>";
}
?>
