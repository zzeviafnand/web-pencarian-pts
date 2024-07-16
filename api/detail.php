<?php

// Enable CORS (Cross-Origin Resource Sharing)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include '../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id_pt'])) {
        $id_pt = $_GET['id_pt'];

        // Using prepared statement to prevent SQL injection
        $stmt = $koneksi->prepare("SELECT * FROM `perguruan_tinggi` WHERE id = ?");
        $stmt->bind_param("s", $id_pt);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();

            echo json_encode(['success' => true, 'data' => $data]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Data Tidak Ditemukan']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Missing id_pt parameter']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
