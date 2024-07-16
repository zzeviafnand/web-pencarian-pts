<?php
include 'header.php';
include 'koneksi/koneksi.php';

// Check if ID is provided in the URL
if (!isset($_GET['id'])) {
    echo "Invalid request. Please provide an ID.";
    exit;
}

$id_knn = $_GET['id'];

// Fetch KNN data based on the provided ID
$queryKNN = "SELECT * FROM data_knn WHERE id = '$id_knn'";
$resultKNN = mysqli_query($koneksi, $queryKNN);

// Function to create dropdown options for ENUM fields
function createEnumOptions($enumValues, $selectedValue = null)
{
    $options = '';
    foreach ($enumValues as $value) {
        $selected = ($value == $selectedValue) ? 'selected' : '';
        $options .= "<option value='$value' $selected>$value</option>";
    }
    return $options;
}

// Fetch the list of perguruan tinggi names and ids
$queryPerguruanTinggi = "SELECT id, nama FROM perguruan_tinggi";
$resultPerguruanTinggi = mysqli_query($koneksi, $queryPerguruanTinggi);

// Function to create dropdown options
function createOptions($result, $selectedValue)
{
    $options = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $id_pt = $row['id'];
        $nama = $row['nama'];
        $selected = ($id_pt == $selectedValue) ? 'selected' : '';
        $options .= "<option value='$id_pt' $selected>$nama</option>";
    }
    return $options;
}

?>

<!-- HTML code for your form -->
<div class="content-wrapper">
    <section class="content-header">
        <!-- Add your content header HTML here -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit KNN Data</h3>
                        </div>
                        <form action="update_knn.php" method="post" role="form" method="post">
                            <?php
                            // Display the existing KNN data in the form
                            $rowKNN = mysqli_fetch_assoc($resultKNN);
                            ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="id_pt">Perguruan Tinggi</label>
                                    <select name="id_pt" class="form-control" required>
                                        <?php
                                        echo createOptions($resultPerguruanTinggi, $rowKNN['id_pt']);
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="lokasi">Lokasi</label>
                                    <select name="lokasi" class="form-control" required>
                                        <?php
                                        $lokasiOptions = createEnumOptions(['Sangat dekat pusat kota', 'Dekat pusat kota', 'Di pinggiran kota', 'Luar kota', 'Sangat luar kota'], $rowKNN['lokasi']);
                                        echo $lokasiOptions;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jurusan">Jurusan</label>
                                    <select name="jurusan" class="form-control" required>
                                        <?php
                                        $jurusanOptions = createEnumOptions(['Ilmu Komputer', 'Bisnis dan Manajemen', 'Teknik', 'Kesehatan', 'Seni dan Humaniora'], $rowKNN['jurusan']);
                                        echo $jurusanOptions;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="akreditasi">
                                        <label for="akreditasi">Akreditasi</label>
                                        <select name="akreditasi" class="form-control" required>
                                            <?php
                                            $akreditasiOptions = createEnumOptions(['A (Sangat Baik)', 'B (Baik)', 'C (Cukup)', 'D (Kurang Baik)', 'Tidak Terakreditasi'], $rowKNN['akreditasi']);
                                            echo $akreditasiOptions;
                                            ?>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="fasilitas">Fasilitas</label>
                                    <select name="fasilitas" class="form-control" required>
                                        <?php
                                        $fasilitasOptions = createEnumOptions(['Sangat lengkap', 'Lengkap', 'Memadai', 'Terbatas', 'Sangat terbatas'], $rowKNN['fasilitas']);
                                        echo $fasilitasOptions;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="biaya_kuliah">Biaya Kuliah</label>
                                    <select name="biaya_kuliah" class="form-control" required>
                                        <?php
                                        $biayaKuliahOptions = createEnumOptions(['Sangat mahal', 'Mahal', 'Sedang', 'Terjangkau', 'Sangat terjangkau'], $rowKNN['biaya_kuliah']);
                                        echo $biayaKuliahOptions;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jenjang_beasiswa">Jenjang Beasiswa</label>
                                    <select name="jenjang_beasiswa" class="form-control" required>
                                        <?php
                                        $jenjangBeasiswaOptions = createEnumOptions(['Sangat tinggi', 'Tinggi', 'Sedang', 'Rendah', 'Tidak Ada'], $rowKNN['jenjang_beasiswa']);
                                        echo $jenjangBeasiswaOptions;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ikatan_alumni">Ikatan Alumni</label>
                                    <select name="ikatan_alumni" class="form-control" required>
                                        <?php
                                        $ikatanAlumniOptions = createEnumOptions(['Aktif dan Kuat', 'Aktif', 'Sedang aktif', 'Kurang aktif', 'Tidak aktif atau tidak terorganisir'], $rowKNN['ikatan_alumni']);
                                        echo $ikatanAlumniOptions;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="id" value="<?php echo $id_knn; ?>">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="data_knn.php" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include 'footer.php';
?>