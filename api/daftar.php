<?php

// Enable CORS (Cross-Origin Resource Sharing)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include '../koneksi/koneksi.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from URL parameters
    $nama_lengkap = isset($_POST['nama_lengkap']) ? $_POST['nama_lengkap'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validate input
    if (empty($nama_lengkap) || empty($username) || empty($password)) {
        http_response_code(400);
        echo json_encode(['error' => 'Semua kolom harus diisi']);
        exit;
    }

    // Check if username already exists
    $check_username_sql = "SELECT * FROM user WHERE username = '$username'";
    $check_username_result = $koneksi->query($check_username_sql);

    if ($check_username_result->num_rows > 0) {
        http_response_code(400);
        echo json_encode(['error' => 'Username sudah terdaftar']);
        exit;
    }

    // Insert user into the database
    $insert_sql = "INSERT INTO user (nama_lengkap, username, password) VALUES ('$nama_lengkap', '$username', '$password')";

    if ($koneksi->query($insert_sql) === TRUE) {
        // Retrieve the inserted user's data
        $new_user_id = $koneksi->insert_id;
        $new_user_sql = "SELECT * FROM user WHERE id = '$new_user_id'";
        $new_user_result = $koneksi->query($new_user_sql);
        $new_user = $new_user_result->fetch_assoc();

        // Response with user data and success message
        echo json_encode(['success' => true, 'user' => $new_user]);
    } else {
        // Error occurred while inserting the user
        http_response_code(500);
        echo json_encode(['error' => 'Terjadi kesalahan saat menyimpan data']);
    }
} else {
    // Handle other request methods
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
