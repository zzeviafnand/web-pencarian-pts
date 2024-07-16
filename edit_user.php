<?php
include 'header.php';
include 'koneksi/koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "select * from user where id='$id'");
while ($d = mysqli_fetch_array($data)) {
    ?>

    <div class="content-wrapper">
        <!-- Header Konten (Header halaman) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Update Data User</li>
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
                            <form id="quickForm" action="update_user.php" method="post" role="form" enctype="multipart/form-data">
                                <input type="hidden" name="id" class="form-control" value="<?php echo $d['id']; ?>">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="InputNamaLengkap">Nama Lengkap</label>
                                        <input type="text" name="nama_lengkap" class="form-control" id="InputNamaLengkap" value="<?php echo $d['nama_lengkap']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="InputUsername">Username</label>
                                        <input type="text" name="username" class="form-control" id="InputUsername" value="<?php echo $d['username']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="InputPassword">Password</label>
                                        <input type="password" name="password" class="form-control" id="InputPassword" placeholder="Masukkan Password Baru">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="data_user.php" class="btn btn-primary">Kembali</a>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <?php
            }
            ?>
            <!-- right column -->
            <div class="col-md-6">

            </div>
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
