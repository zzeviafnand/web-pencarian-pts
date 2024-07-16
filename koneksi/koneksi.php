<?php

try {
    // konfigurasi database
    $host       ="localhost";
    $username   ="root";
    $password   ="";
    $database   ="db_pencarian_pts";

    $koneksi = mysqli_connect($host, $username, $password, $database);
    
    if (!$koneksi){
        throw new Exception("Gagal terhubung ke database");
    }

} catch (Exception $e) {

    echo 'Message: ' . $e->getMessage();
    exit;
}
    