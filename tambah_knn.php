<?php
// Include header and database connection
include 'header.php';
include 'koneksi/koneksi.php';

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
function createOptions($result, $selectedValue = null)
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

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tambah Data KNN</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Tambah Data KNN</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Silahkan Masukkan Data</h3>
            </div>
            <form id="quickForm" action="create_knn.php" method="post">
              <div class="card-body">
                <div class="form-group">
                  <label for="id_pt">Perguruan Tinggi</label>
                  <select name="id_pt" class="form-control" id="id_pt" required>
                    <?php
                    echo createOptions($resultPerguruanTinggi);
                    ?>
                  </select>
                </div>

                <!-- Lokasi -->
                <div class="form-group">
                  <label for="lokasi">Lokasi</label>
                  <select name="lokasi" class="form-control" id="lokasi" required>
                    <?php
                    $lokasiOptions = createEnumOptions(['Sangat dekat pusat kota', 'Dekat pusat kota', 'Di pinggiran kota', 'Luar kota', 'Sangat luar kota']);
                    echo $lokasiOptions;
                    ?>
                  </select>
                </div>

                <!-- Jurusan -->
                <div class="form-group">
                  <label for="jurusan">Jurusan</label>
                  <select name="jurusan" class="form-control" id="jurusan" required>
                    <?php
                    $jurusanOptions = createEnumOptions(['Ilmu Komputer', 'Bisnis dan Manajemen', 'Teknik', 'Kesehatan', 'Seni dan Humaniora']);
                    echo $jurusanOptions;
                    ?>
                  </select>
                </div>

                <!-- Akreditasi -->
                <div class="form-group">
                  <label for="akreditasi">Akreditasi</label>
                  <select name="akreditasi" class="form-control" id="akreditasi" required>
                    <?php
                    $akreditasiOptions = createEnumOptions(['A (Sangat Baik)', 'B (Baik)', 'C (Cukup)', 'D (Kurang Baik)', 'Tidak Terakreditasi']);
                    echo $akreditasiOptions;
                    ?>
                  </select>
                </div>

                <!-- Fasilitas -->
                <div class="form-group">
                  <label for="fasilitas">Fasilitas</label>
                  <select name="fasilitas" class="form-control" id="fasilitas" required>
                    <?php
                    $fasilitasOptions = createEnumOptions(['Sangat lengkap', 'Lengkap', 'Memadai', 'Terbatas', 'Sangat terbatas']);
                    echo $fasilitasOptions;
                    ?>
                  </select>
                </div>

                <!-- Biaya Kuliah -->
                <div class="form-group">
                  <label for="biaya_kuliah">Biaya Kuliah</label>
                  <select name="biaya_kuliah" class="form-control" id="biaya_kuliah" required>
                    <?php
                    $biayaKuliahOptions = createEnumOptions(['Sangat mahal', 'Mahal', 'Sedang', 'Terjangkau', 'Sangat terjangkau']);
                    echo $biayaKuliahOptions;
                    ?>
                  </select>
                </div>

                <!-- Jenjang Beasiswa -->
                <div class="form-group">
                  <label for="jenjang_beasiswa">Jenjang Beasiswa</label>
                  <select name="jenjang_beasiswa" class="form-control" id="jenjang_beasiswa" required>
                    <?php
                    $jenjangBeasiswaOptions = createEnumOptions(['Sangat tinggi', 'Tinggi', 'Sedang', 'Rendah', 'Tidak Ada']);
                    echo $jenjangBeasiswaOptions;
                    ?>
                  </select>
                </div>

                <!-- Ikatan Alumni -->
                <div class="form-group">
                  <label for="ikatan_alumni">Ikatan Alumni</label>
                  <select name="ikatan_alumni" class="form-control" id="ikatan_alumni" required>
                    <?php
                    $ikatanAlumniOptions = createEnumOptions(['Aktif dan Kuat', 'Aktif', 'Sedang aktif', 'Kurang aktif', 'Tidak aktif atau tidak terorganisir']);
                    echo $ikatanAlumniOptions;
                    ?>
                  </select>
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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