<?php

// Enable CORS (Cross-Origin Resource Sharing)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include '../koneksi/koneksi.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from URL parameters
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validate input
    if (empty($username) || empty($password)) {
        http_response_code(400);
        echo json_encode(['error' => 'Username atau Password harus diisi']);
        exit;
    }

    // Query to check if the username and hashed password match
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc();

        // Response with user data and success message
        echo json_encode(['success' => true, 'user' => $user]);
    } else {
        // No matching user found
        http_response_code(401);
        echo json_encode(['error' => 'Username atau Password salah!']);
    }
} else {
    // Handle other request methods
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}

