<?php
include 'header.php';
include 'koneksi/koneksi.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php
                $data_pt = mysqli_query($koneksi,"SELECT * FROM perguruan_tinggi");
                // menghitung data Perguruan Tinggi
                $jumlah_pt = mysqli_num_rows($data_pt);
                ?>
                <h3><?php echo $jumlah_pt; ?></h3>
                <p>Jumlah Perguruan Tinggi</p>
              </div>
              <div class="icon">
                <i class="fa fa-university"></i>
              </div>
              <a href="data_pt.php" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php
                $data_user = mysqli_query($koneksi,"SELECT * FROM user");
                // menghitung data User
                $jumlah_user = mysqli_num_rows($data_user);
                ?>
                <h3><?php echo $jumlah_user; ?></h3>
                <p>Jumlah User</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="data_user.php" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
    </section>
  </div>

  <?php
  include 'footer.php';
  ?>
