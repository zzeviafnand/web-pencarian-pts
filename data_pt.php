<?php
// Include header and database connection
include 'header.php';
include 'koneksi/koneksi.php';


// Initialize variables for filters
$namaFilter = '';
$lokasiFilter = '';
$akreditasiFilter = '';

// Check if the search form is submitted
if(isset($_GET['cari'])) {
    $namaFilter = $_GET['cari'];
}

// Check if the filters are submitted
if(isset($_GET['lokasi'])) {
    $lokasiFilter = $_GET['lokasi'];
}

if(isset($_GET['akreditasi'])) {
    $akreditasiFilter = $_GET['akreditasi'];
}

// Modify the SQL query to include WHERE clauses for both Nama and Lokasi & Akreditasi
$query = "SELECT * FROM perguruan_tinggi WHERE nama LIKE '%$namaFilter%'";

// Append the "Lokasi" filter to the query if it's set
if(!empty($lokasiFilter)) {
    $query .= " AND lokasi LIKE '%$lokasiFilter%'";
}

// Append the "Akreditasi" filter to the query if it's set
if(!empty($akreditasiFilter)) {
    $query .= " AND akreditasi = '$akreditasiFilter'";
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Perguruan Tinggi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Data Perguruan Tinggi</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="card">
        <div class="card-header"></div>
        <!-- /.card-header -->
        <div class="card-body">
            <a href="tambah_pt.php" class="btn btn-info">Tambah Perguruan Tinggi</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Akreditasi</th>
                        <th scope="col">Photo</th>
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
                            <td><?php echo $d['nama']; ?></td>
                            <td><?php echo $d['deskripsi']; ?></td>
                            <td><?php echo $d['lokasi']; ?></td>
                            <td><?php echo $d['akreditasi']; ?></td>
                            <td>
                                <img src="foto_pt/<?php echo $d['photo']; ?>" style="width: 200px;">
                            </td>
                            <td><a href="edit_pt.php?id=<?php echo $d['id']; ?>" class="btn btn-primary">Update</a></td>
                            <td><a href="delete_pt.php?id=<?php echo $d['id']; ?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</div>
</div>
