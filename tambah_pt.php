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

?>

<div class="content-wrapper">
  <!-- Header Konten (Header halaman) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tambah Perguruan Tinggi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Tambah Perguruan Tinggi</li>
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
              <h3 class="card-title">Silahkan Masukkan Data</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="quickForm" action="create_pt.php" method="post" role="form" enctype="multipart/form-data">
              <div class="card-body">

                <div class="form-group">
                  <label for="InputNama">Nama</label>
                  <input type="text" name="nama" class="form-control" id="InputNama" placeholder="Masukkan Nama" required>
                </div>

                <div class="form-group">
                  <label for="InputDeskripsi">Deskripsi</label>
                  <textarea name="deskripsi" class="form-control" id="InputDeskripsi" placeholder="Masukkan Deskripsi"></textarea>
                </div>

                <div class="form-group">
                  <label for="InputLokasi">Lokasi</label>
                  <input type="text" name="lokasi" class="form-control" id="InputLokasi" placeholder="Masukkan Lokasi" required>
                </div>

                <div class="form-group">
                  <label for="InputAkreditasi">Akreditasi</label>
                  <select name="akreditasi" class="form-control" id="InputAkreditasi" required>
                    <?php
                    $akreditasiOptions = createEnumOptions(['A (Sangat Baik)', 'B (Baik)', 'C (Cukup)', 'D (Kurang Baik)', 'Tidak Terakreditasi']);
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
