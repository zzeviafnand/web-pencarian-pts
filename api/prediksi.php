<?php

// Database connection
include '../koneksi/koneksi.php';

// Fungsi untuk menghitung jarak Euclidean antara preferensi pengguna dan data KNN
function calculateEuclideanDistance($userPreferences, $rowKNN)
{
    $distance = 0;

    // Hitung perbedaan kuadrat untuk setiap atribut
    foreach ($userPreferences as $attribute => $userValue) {
        if (!isset($rowKNN[$attribute])) {
            continue; // Lewati nilai yang tidak ditentukan
        }

        $knnValue = $rowKNN[$attribute];
        $difference = $userValue - $knnValue;
        $distance += $difference * $difference;
    }

    // Ambil akar kuadrat dari jumlah perbedaan kuadrat
    return sqrt($distance);
}


// Fungsi untuk mengonversi nilai ENUM ke skala
function convertToScale($enumValue)
{
    // Ubah ke huruf kecil dan hapus garis bawah
    $formattedEnum = str_replace('_', ' ', strtolower($enumValue));

    // Panduan skala untuk setiap field ENUM
    $scaleGuides = [
        'ilmu komputer' => 1,
        'bisnis dan manajemen' => 2,
        'teknik' => 3,
        'kesehatan' => 4,
        'seni dan humaniora' => 5,
        'a (sangat baik)' => 1,
        'b (baik)' => 2,
        'c (cukup)' => 3,
        'd (kurang baik)' => 4,
        'tidak terakreditasi' => 5,
        'sangat lengkap' => 1,
        'lengkap' => 2,
        'memadai' => 3,
        'terbatas' => 4,
        'sangat terbatas' => 5,
        'sangat mahal' => 1,
        'mahal' => 2,
        'sedang' => 3,
        'terjangkau' => 4,
        'sangat terjangkau' => 5,
        'sangat tinggi' => 1,
        'tinggi' => 2,
        'rendah' => 4,
        'tidak ada' => 5,
        'aktif dan kuat' => 1,
        'aktif' => 2,
        'sedang aktif' => 3,
        'kurang aktif' => 4,
        'tidak aktif atau tidak terorganisir' => 5,
    ];

    // Kembalikan nilai skala atau 0 untuk nilai yang tidak ditentukan
    return isset($scaleGuides[$formattedEnum]) ? $scaleGuides[$formattedEnum] : 0;
}




// Fungsi untuk memprediksi perguruan tinggi
function predictUniversities($userPreferences, $k = 3)
{
    global $koneksi;

    // Ambil data KNN dari database menggunakan prepared statements untuk mencegah SQL injection
    $queryKNN = "SELECT * FROM data_knn";
    $stmt = mysqli_prepare($koneksi, $queryKNN);
    mysqli_stmt_execute($stmt);
    $resultKNN = mysqli_stmt_get_result($stmt);

    $predictions = [];
    $uniqueIds = [];

    // Koordinat lokasi pengguna
    $userLocation = explode(", ", $_POST['lokasi']);
    $userLatitude = $userLocation[0];
    $userLongitude = $userLocation[1];

    // Iterasi melalui dataset KNN
    while ($rowKNN = mysqli_fetch_assoc($resultKNN)) {
        // Konversi nilai ENUM ke skala
        $rowKNN['jurusan'] = convertToScale($rowKNN['jurusan']);
        $rowKNN['akreditasi'] = convertToScale($rowKNN['akreditasi']);
        $rowKNN['fasilitas'] = convertToScale($rowKNN['fasilitas']);
        $rowKNN['biaya_kuliah'] = convertToScale($rowKNN['biaya_kuliah']);
        $rowKNN['jenjang_beasiswa'] = convertToScale($rowKNN['jenjang_beasiswa']);
        $rowKNN['ikatan_alumni'] = convertToScale($rowKNN['ikatan_alumni']);

         // Hitung jarak Euclidean
        $distance = calculateEuclideanDistance($userPreferences, $rowKNN);

        // Hitung jarak antara lokasi pengguna dan lokasi perguruan tinggi
        $queryUniversityLocation = "SELECT koordinat FROM perguruan_tinggi WHERE id = " . $rowKNN['id_pt'];
        $resultUniversityLocation = mysqli_query($koneksi, $queryUniversityLocation);

        if ($resultUniversityLocation && $rowUniversityLocation = mysqli_fetch_assoc($resultUniversityLocation)) {
            $universityLocation = explode(", ", $rowUniversityLocation['koordinat']);
            $universityLatitude = $universityLocation[0];
            $universityLongitude = $universityLocation[1];
            $distanceToUniversity = haversineDistance($userLatitude, $userLongitude, $universityLatitude, $universityLongitude);
        } else {
            // Tangani kasus ketika lokasi perguruan tinggi tidak dapat diambil
            $distanceToUniversity = false;
        };

        // Jarak gabungan (Euclidean + Lokasi)
        $combinedDistance = $distance + $distanceToUniversity;

        // Lewati prediksi dengan jarak yang tidak ditentukan
        if ($combinedDistance !== false) { 
            // Periksa apakah id_pt unik
            if (!in_array($rowKNN['id_pt'], $uniqueIds)) {
                // Tambahkan perguruan tinggi ke array prediksi
                $predictions[] = [
                    'id_pt' => $rowKNN['id_pt'],
                    'nama' => getNamaPerguruanTinggi($rowKNN['id_pt']),
                    'euclidian_distance' => $distance,
                    'university_distance' => $distanceToUniversity,
                    'distance' => $combinedDistance,
                ];

                // Tambahkan id_pt ke array idsUnik
                $uniqueIds[] = $rowKNN['id_pt'];
            }
        }
    }

    // Urutkan prediksi berdasarkan jarak (urutan naik)
    usort($predictions, function ($a, $b) {
        return $a['distance'] <=> $b['distance'];
    });

    // Dapatkan prediksi teratas K
    $topPredictions = array_slice($predictions, 0, $k);

     // Masukkan kriteria pengguna dan nilai yang diprediksi ke database
    logPrediction($userPreferences, $topPredictions);

    return $topPredictions;
}

// Fungsi untuk menghitung jarak haversine
function haversineDistance($lat1, $lon1, $lat2, $lon2, $earthRadius = 6371)
{
    // Ubah latitude dan longitude dari derajat ke radian
    $lat1 = deg2rad($lat1);
    $lon1 = deg2rad($lon1);
    $lat2 = deg2rad($lat2);
    $lon2 = deg2rad($lon2);

    // Hitung perbedaan antara latitude dan longitude
    $dLat = $lat2 - $lat1;
    $dLon = $lon2 - $lon1;

    // Hitung jarak Haversine
    $a = sin($dLat / 2) * sin($dLat / 2) + cos($lat1) * cos($lat2) * sin($dLon / 2) * sin($dLon / 2);
    $c = 2 * asin(sqrt($a));
    $distance = $earthRadius * $c;

    return $distance;
}


// Fungsi untuk mendapatkan nama perguruan tinggi berdasarkan id_pt
function getNamaPerguruanTinggi($id_pt)
{
    global $koneksi;

    $queryNamaPT = "SELECT nama FROM perguruan_tinggi WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $queryNamaPT);
    mysqli_stmt_bind_param($stmt, "s", $id_pt);
    mysqli_stmt_execute($stmt);
    $resultNamaPT = mysqli_stmt_get_result($stmt);

    if ($resultNamaPT && $rowNamaPT = mysqli_fetch_assoc($resultNamaPT)) {
        return $rowNamaPT['nama'];
    }

    return 'Unknown';
}

// Fungsi untuk memasukkan kriteria pengguna dan nilai yang diprediksi ke database
function logPrediction($userPreferences, $predictions)
{
    global $koneksi;

    // Masukkan kriteria pengguna ke tabel kriteria_pencarian_user
    $queryCriteria = "INSERT INTO kriteria_pencarian_user (lokasi, jurusan, akreditasi, fasilitas, biaya_kuliah, jenjang_beasiswa, ikatan_alumni) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmtCriteria = $koneksi->prepare($queryCriteria);
    $stmtCriteria->bind_param("ssssdss", $_POST['lokasi'], $userPreferences['jurusan'], $userPreferences['akreditasi'], $userPreferences['fasilitas'], $userPreferences['biaya_kuliah'], $userPreferences['jenjang_beasiswa'], $userPreferences['ikatan_alumni']);
    $stmtCriteria->execute();

    // Dapatkan ID kriteria yang dimasukkan
    $id_kriteria = $stmtCriteria->insert_id;

    $id_list_hasil = getNextCariId();

    $stmtCriteria->close();

    foreach ($predictions as $prediction) {
        $id_pt = $prediction['id_pt'];
        $euclidean_distance = $prediction['distance'];

        // Insert predicted value into list_hasil table
        $queryPrediction = "INSERT INTO list_hasil (id_hasil, id_pt, euclidean_distance) VALUES (?, ?, ?)";
        $stmtPrediction = $koneksi->prepare($queryPrediction);
        $stmtPrediction->bind_param("iid", $id_list_hasil, $id_pt, $euclidean_distance); // Use 'iid' for three parameters: integer, integer, and double
        $stmtPrediction->execute();
        $stmtPrediction->close();
    }

    // Insert the connection between user criteria and predicted value into cari table
    $queryCari = "INSERT INTO cari (id_kriteria, id_list_hasil) VALUES (?, ?)";
    $stmtCari = $koneksi->prepare($queryCari);
    $stmtCari->bind_param("ii", $id_kriteria, $id_list_hasil);
    $stmtCari->execute();

    if ($stmtCari->affected_rows < 1) {
        echo "Error inserting into cari table: " . $koneksi->error; // Debugging
    }

    $stmtCari->close();
}

function getNextCariId()
{
    global $koneksi;

    // Query the maximum ID from the cari table
    $query = "SELECT MAX(id) as max_id FROM cari";
    $result = $koneksi->query($query);
    $row = $result->fetch_assoc();
    $maxId = $row['max_id'];

    // Increment the maximum ID by 1 to get the next available ID
    $nextId = $maxId + 1;

    return $nextId;
}




// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // User preferences from POST request
    $userPreferences = [
        'jurusan' => convertToScale($_POST['jurusan']),
        'akreditasi' => convertToScale($_POST['akreditasi']),
        'fasilitas' => convertToScale($_POST['fasilitas']),
        'biaya_kuliah' => convertToScale($_POST['biaya_kuliah']),
        'jenjang_beasiswa' => convertToScale($_POST['jenjang_beasiswa']),
        'ikatan_alumni' => convertToScale($_POST['ikatan_alumni']),
    ];

    // Number of neighbors to consider (K value)
    $k = 3;

    // Predict universities using KNN
    $predictions = predictUniversities($userPreferences, $k);

    // Prepare API response
    $response = [
        'success' => true,
        'message' => 'Universities predicted successfully.',
        'data' => $predictions,
    ];

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // If the request method is not POST, return an error response
    $response = [
        'success' => false,
        'message' => 'Invalid request method. Please use POST.',
    ];

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}
