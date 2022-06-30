
<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "sdn_cwr_akademik";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$id_mapel           = "";
$kode_mapel         = "";
$nama_mapel         = "";
$nama_guru          = "";
$kd_kelas           = "";
$jam                = "";
$sukses             = "";
$error              = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id_mapel   = $_GET['id_mapel'];
    $sql1       = "delete from mata_pelajaran where id_mapel = '$id_mapel'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id_mapel        = $_GET['id_mapel'];
    $sql1       = "select * from mata_pelajaran where id_mapel = '$id_mapel'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $id_mapel        = $r1['id_mapel'];
    $kode_mapel      = $r1['kode_mapel'];
    $nama_mapel      = $r1['nama_mapel'];
    $nama_guru       = $r1['nama_guru'];
    $kd_kelas        = $r1['kd_kelas'];
    $jam             = $r1['jam'];
    

    if ($id_mapel == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $id_mapel        = $_POST['id_mapel'];
    $kode_mapel      = $_POST['kode_mapel'];
    $nama_mapel      = $_POST['nama_mapel'];
    $nama_guru       = $_POST['nama_guru'];
    $kd_kelas        = $_POST['kd_kelas'];
    $jam             = $_POST['jam'];
    
    
    
    
    if ($id_mapel && $kode_mapel && $nama_mapel && $nama_guru && $kd_kelas && $jam) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update mata_pelajaran set id_mapel = '$id_mapel',kode_mapel='$kode_mapel',nama_mapel='$nama_mapel',nama_guru='$nama_guru',kd_kelas='$kd_kelas',jam='$jam' where id_mapel = '$id_mapel'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into mata_pelajaran (id_mapel,kode_mapel,nama_mapel,nama_guru,kd_kelas,jam) values ('$id_mapel','$kode_mapel','$nama_mapel','$nama_guru','$kd_kelas','$jam')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Mata Pelajaran</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="id_mapel" class="col-sm-2 col-form-label">ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_mapel" name="id_mapel" value="<?php echo $id_mapel ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="kode_mapel" class="col-sm-2 col-form-label">Kode Mata Pelajaran</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kode_mapel" name="kode_mapel" value="<?php echo $kode_mapel ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_mapel" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" value="<?php echo $nama_mapel  ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_guru" class="col-sm-2 col-form-label">Pengajar</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_guru" name="nama_guru" value="<?php echo $nama_guru ?>">
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="kd_kelas" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kd_kelas" name="kd_kelas" value="<?php echo $kd_kelas ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jam" class="col-sm-2 col-form-label">Hari/Jam</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jam" name="jam" value="<?php echo $jam ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Mata Pelajaran
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Id</th>
                            <th scope="col">Kode Mata Pelajaran</th>
                            <th scope="col">Nama Mata Pelajaran</th>
                            <th scope="col">Pengajar</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Hari/Jam</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from mata_pelajaran order by id_mapel desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id_mapel        = $r2['id_mapel'];
                            $kode_mapel      = $r2['kode_mapel'];
                            $nama_mapel      = $r2['nama_mapel'];
                            $nama_guru       = $r2['nama_guru'];
                            $kd_kelas        = $r2['kd_kelas'];
                            $jam             = $r2['jam'];
                            
                            

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $id_mapel ?></td>
                                <td scope="row"><?php echo $kode_mapel ?></td>
                                <td scope="row"><?php echo $nama_mapel?></td>
                                <td scope="row"><?php echo $nama_guru ?></td>
                                <td scope="row"><?php echo $kd_kelas ?></td>
                                <td scope="row"><?php echo $jam ?></td>
                                <td scope="row">
                                    <a href="mata_pelajaran.php?op=edit&id_mapel=<?php echo $id_mapel ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="mata_pelajaran.php?op=delete&id_mapel=<?php echo $id_mapel?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</body>

</html>