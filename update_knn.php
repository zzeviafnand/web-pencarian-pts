<?php
include 'koneksi/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $id = $_POST['id'];
    $id_pt = $_POST['id_pt'];
    $lokasi = $_POST['lokasi'];
    $jurusan = $_POST['jurusan'];
    $akreditasi = $_POST['akreditasi'];
    $fasilitas = $_POST['fasilitas'];
    $biaya_kuliah = $_POST['biaya_kuliah'];
    $jenjang_beasiswa = $_POST['jenjang_beasiswa'];
    $ikatan_alumni = $_POST['ikatan_alumni'];

    // Update the KNN data in the database
    $query = "UPDATE data_knn SET
                id_pt = '$id_pt',
                lokasi = '$lokasi',
                jurusan = '$jurusan',
                akreditasi = '$akreditasi',
                fasilitas = '$fasilitas',
                biaya_kuliah = '$biaya_kuliah',
                jenjang_beasiswa = '$jenjang_beasiswa',
                ikatan_alumni = '$ikatan_alumni'
            WHERE id = '$id'";

    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($koneksi));
    } else {
        echo "<script>alert('Data berhasil diubah.');window.location='data_knn.php';</script>";
    }
} else {
    // If the form is not submitted via POST, redirect or handle accordingly
    echo "<script>alert('Invalid request.'); window.location='data_knn.php';</script>";
}
