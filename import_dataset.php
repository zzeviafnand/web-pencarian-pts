<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_pencarian_pts";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Path to the CSV file
$csvFilePath = 'dataset.csv';

// Open the CSV file
if (($handle = fopen($csvFilePath, "r")) !== FALSE) {
    // Skip the first line (header)
    fgetcsv($handle, 1000, ";");

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO data_knn (id_pt, lokasi, jurusan, akreditasi, fasilitas, biaya_kuliah, jenjang_beasiswa, ikatan_alumni) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssss", $id_pt, $lokasi, $jurusan, $akreditasi, $fasilitas, $biaya_kuliah, $jenjang_beasiswa, $ikatan_alumni);

    // Loop through the CSV file and insert data into the database
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        // Ensure the row has the correct number of columns
        if (count($data) == 8) {
            $id_pt = $data[0];
            $lokasi = $data[1];
            $jurusan = $data[2];
            $akreditasi = $data[3];
            $fasilitas = $data[4];
            $biaya_kuliah = $data[5];
            $jenjang_beasiswa = $data[6];
            $ikatan_alumni = $data[7];
            $stmt->execute();
        } else {
            // Log or handle rows with unexpected column count
            error_log("Skipping row with unexpected column count: " . implode("; ", $data));
        }
    }

    // Close the file
    fclose($handle);

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();

echo "Data inserted successfully";
?>
