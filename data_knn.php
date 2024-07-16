<?php
// Include header and database connection
include 'header.php';
include 'koneksi/koneksi.php';

$query = "SELECT data_knn.*, perguruan_tinggi.nama AS perguruan_tinggi_nama 
          FROM data_knn
          JOIN perguruan_tinggi ON data_knn.id_pt = perguruan_tinggi.id";

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data KNN</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Data KNN</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="card">
        <div class="card-header"></div>
        <!-- /.card-header -->
        <div class="card-body">
            <a href="tambah_knn.php" class="btn btn-info">Tambah Data KNN</a>
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>                       
                        <th scope="col">Perguruan Tinggi</th>                       
                        <th scope="col">Lokasi</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Akreditasi</th>
                        <th scope="col">Fasilitas</th>
                        <th scope="col">Biaya Kuliah</th>
                        <th scope="col">Jenjang Beasiswa</th>
                        <th scope="col">Ikatan Alumni</th>
                        <th scope="col" colspan="2">Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $data = mysqli_query($koneksi, $query);
                    while ($d = mysqli_fetch_array($data)) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>                           
                            <td><?php echo $d['perguruan_tinggi_nama']; ?></td>
                            <td><?php echo $d['lokasi']; ?></td>
                            <td><?php echo $d['jurusan']; ?></td>
                            <td><?php echo $d['akreditasi']; ?></td>
                            <td><?php echo $d['fasilitas']; ?></td>
                            <td><?php echo $d['biaya_kuliah']; ?></td>
                            <td><?php echo $d['jenjang_beasiswa']; ?></td>
                            <td><?php echo $d['ikatan_alumni']; ?></td>
                            <td><a href="edit_knn.php?id=<?php echo $d['id']; ?>" class="btn btn-primary">Update</a></td>
                            <td><a href="delete_knn.php?id=<?php echo $d['id']; ?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?php
include 'footer.php';
?>
</div>
</div>
