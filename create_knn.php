<?php
    // Include database connection
    include 'koneksi/koneksi.php';

    $id_pt = $_POST['id_pt'];
    $lokasi = $_POST['lokasi'];
    $jurusan = $_POST['jurusan'];
    $akreditasi = $_POST['akreditasi'];
    $fasilitas = $_POST['fasilitas'];
    $biaya_kuliah = $_POST['biaya_kuliah'];
    $jenjang_beasiswa = $_POST['jenjang_beasiswa'];
    $ikatan_alumni = $_POST['ikatan_alumni'];

    // Insert data into the database
    $query = "INSERT INTO data_knn (id_pt, lokasi, jurusan, akreditasi, fasilitas, biaya_kuliah, jenjang_beasiswa, ikatan_alumni) 
    VALUES ('$id_pt', '$lokasi', '$jurusan', '$akreditasi', '$fasilitas', '$biaya_kuliah', '$jenjang_beasiswa', '$ikatan_alumni')";

    $result = mysqli_query($koneksi, $query);

    // Check for errors
    if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    } else {
    // Redirect to the data_knn.php page or any other appropriate page
    echo "<script>alert('Data berhasil ditambah.');window.location='data_knn.php';</script>";
    }
?>
