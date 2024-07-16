<?php
// Include header and database connection
include 'header.php';
include 'koneksi/koneksi.php';

// Initialize variables for filters
$namaLengkapFilter = '';
$usernameFilter = '';

// Check if the search form is submitted
if (isset($_GET['cari'])) {
    $namaLengkapFilter = $_GET['cari'];
}

// Check if the filter for "Username" is submitted
if (isset($_GET['username'])) {
    $usernameFilter = $_GET['username'];
}

// Modify the SQL query to include WHERE clauses for both "Nama Lengkap" and "Username"
$query = "SELECT * FROM user WHERE nama_lengkap LIKE '%$namaLengkapFilter%'";

// Append the "Username" filter to the query if it's set
if (!empty($usernameFilter)) {
    $query .= " AND username LIKE '%$usernameFilter%'";
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Data User</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="card">
        <div class="card-header"></div>
        <!-- /.card-header -->
        <div class="card-body">
            <a href="tambah_user.php" class="btn btn-info">Tambah User</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">ID</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Username</th>
                        <th scope="col" colspan="2">Aksi</th>
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
                            <td><?php echo $d['id']; ?></td>
                            <td><?php echo $d['nama_lengkap']; ?></td>
                            <td><?php echo $d['username']; ?></td>
                            <td><a href="edit_user.php?id=<?php echo $d['id']; ?>" class="btn btn-primary">Update</a></td>
                            <td><a href="delete_user.php?id=<?php echo $d['id']; ?>" class="btn btn-danger">Delete</a></td>
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
