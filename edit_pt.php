<?php
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

// Fetch data for the selected Perguruan Tinggi
$id = $_GET['id'];
$query = "SELECT * FROM perguruan_tinggi WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

// Check if data is found
if ($result && mysqli_num_rows($result) > 0) {
  $data = mysqli_fetch_assoc($result);
} else {
  echo "Data not found.";
  exit;
}
?>

<div class="content-wrapper">
  <!-- Header Konten (Header halaman) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Perguruan Tinggi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Edit Perguruan Tinggi</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- jquery validation -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Data Perguruan Tinggi</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="quickForm" action="update_pt.php" method="post" role="form" enctype="multipart/form-data">
              <div class="card-body">

                <div class="form-group">
                  <label for="InputNama">Nama</label>
                  <input type="text" name="nama" class="form-control" id="InputNama" placeholder="Masukkan Nama" value="<?php echo $data['nama']; ?>" required>
                </div>

                <div class="form-group">
                  <label for="InputDeskripsi">Deskripsi</label>
                  <textarea name="deskripsi" class="form-control" id="InputDeskripsi" placeholder="Masukkan Deskripsi"><?php echo $data['deskripsi']; ?></textarea>
                </div>

                <div class="form-group">
                  <label for="InputLokasi">Lokasi</label>
                  <input type="text" name="lokasi" class="form-control" id="InputLokasi" placeholder="Masukkan Lokasi" value="<?php echo $data['lokasi']; ?>" required>
                </div>

                <div class="form-group">
                  <label for="InputAkreditasi">Akreditasi</label>
                  <select name="akreditasi" class="form-control" id="InputAkreditasi" required>
                    <?php
                    $akreditasiOptions = createEnumOptions(['A (Sangat Baik)', 'B (Baik)', 'C (Cukup)', 'D (Kurang Baik)', 'Tidak Terakreditasi'], $data['akreditasi']);
                    echo $akreditasiOptions;
                    ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="InputPhoto">Photo</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="InputPhoto" name="photo" accept="image/*">
                    <label class="custom-file-label" for="InputPhoto">Choose file</label>
                  </div>
                </div>
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6"></div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<?php
include 'footer.php';
?>
</div>
</div>
