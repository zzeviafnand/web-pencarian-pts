<?php
// Enable CORS (Cross-Origin Resource Sharing)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include '../koneksi/koneksi.php';

// API endpoint to get student data
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['endpoint']) && $_GET['endpoint'] === 'student') {
    $studentData = [
        'name' => 'John Doe',
        'grade' => '10th',
        'fees_due' => 500,
    ];

    echo json_encode($studentData);
} else {
    // Handle other endpoints or methods as needed
    http_response_code(404);
    echo json_encode(['error' => 'Endpoint not found']);
}


