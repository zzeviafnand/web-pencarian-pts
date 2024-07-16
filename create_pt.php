<?php
// Include database connection
include 'koneksi/koneksi.php';

// Retrieve data from the form
$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];
$lokasi = $_POST['lokasi'];
$akreditasi = $_POST['akreditasi'];

// Check if photo is uploaded
if (isset($_FILES['photo']['name']) && !empty($_FILES['photo']['name'])) {
    $photo = $_FILES['photo']['name'];
    $target_directory = "foto_pt/";
    $target_file = $target_directory . basename($photo);

    // Check file size, type, and move the file to the upload directory
    // Add your validation logic here

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
        // File uploaded successfully, proceed with database insertion
        $query = "INSERT INTO perguruan_tinggi (nama, deskripsi, lokasi, akreditasi, photo) 
                  VALUES ('$nama', '$deskripsi', '$lokasi', '$akreditasi', '$photo')";
    } else {
        echo "<script>alert('Failed to upload photo.');window.location='tambah_pt.php';</script>";
        exit;
    }
} else {
    // If no photo is uploaded, set photo to NULL in the database
    $query = "INSERT INTO perguruan_tinggi (nama, deskripsi, lokasi, akreditasi, photo) 
              VALUES ('$nama', '$deskripsi', '$lokasi', '$akreditasi', NULL)";
}

// Execute the query
$result = mysqli_query($koneksi, $query);

// Check for errors
if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
} else {
    // Redirect to the data_pt.php page
    echo "<script>alert('Data berhasil ditambah.');window.location='data_pt.php';</script>";
}
?>
