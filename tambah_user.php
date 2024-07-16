<?php
include 'header.php';
include 'koneksi/koneksi.php';
?>

<div class="content-wrapper">
    <!-- Header Konten (Header halaman) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Tambah User</li>
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
                        <form id="quickForm" action="create_user.php" method="post" role="form" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="InputNamaLengkap">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control" id="InputNamaLengkap" placeholder="Masukkan Nama Lengkap" required>
                                </div>
                                <div class="form-group">
                                    <label for="InputUsername">Username</label>
                                    <input type="text" name="username" class="form-control" id="InputUsername" placeholder="Masukkan Username" required>
                                </div>
                                <div class="form-group">
                                    <label for="InputPassword">Password</label>
                                    <input type="password" name="password" class="form-control" id="InputPassword" placeholder="Masukkan Password" required>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1" required>
                                        <label class="custom-control-label" for="exampleCheck1">Saya Telah Setuju</label>
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
