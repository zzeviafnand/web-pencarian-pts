<?php

// Enable CORS (Cross-Origin Resource Sharing)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include '../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $sql = "SELECT photo FROM `perguruan_tinggi`";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $data = array();

        while ($row = $result->fetch_assoc()) {
            $data[] = "http://192.168.100.73:8080/web-pencarian-pts/foto_pt/" . $row['photo'];
        }

        echo json_encode(['success' => true, 'data' => $data]);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Gambar Tidak Ada']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>