<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "sdn_cwr_akademik";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$id_guru       = "";
$nama_guru     = "";
$agama         = "";
$ttg_guru      = "";
$jk_guru       = "";
$alamat_guru   = "";
$pend_guru     = "";
$sukses        = "";
$error         = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id_guru         = $_GET['id_guru'];
    $sql1       = "delete from guru where id_guru = '$id_guru'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id_guru        = $_GET['id_guru'];
    $sql1       = "select * from guru where id_guru = '$id_guru'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $id_guru       = $r1['id_guru'];
    $nama_guru     = $r1['nama_guru'];
    $agama         = $r1['agama'];
    $ttg_guru      = $r1['ttg_guru'];
    $jk_guru       = $r1['jk_guru'];
    $alamat_guru   = $r1['alamat_guru'];
    $pend_guru     = $r1['pend_guru'];


    if ($id_guru == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $id_guru       = $_POST['id_guru'];
    $nama_guru     = $_POST['nama_guru'];
    $agama         = $_POST['agama'];
    $ttg_guru      = $_POST['ttg_guru'];
    $jk_guru       = $_POST['jk_guru'];
    $alamat_guru   = $_POST['alamat_guru'];
    $pend_guru     = $_POST['pend_guru'];


    if ($id_guru && $nama_guru && $agama && $ttg_guru && $jk_guru && $alamat_guru && $pend_guru) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update guru set id_guru = '$id_guru',nama_guru='$nama_guru',agama='$agama',ttg_guru='$ttg_guru',jk_guru='$jk_guru',alamat_guru='$alamat_guru',pend_guru='$pend_guru' where id_guru = '$id_guru'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into guru(id_guru,nama_guru,agama,ttg_guru,jk_guru,alamat_guru,Pend_guru) values ('$id_guru', '$nama_guru','$agama', '$ttg_guru', '$jk_guru', '$alamat_guru' ,'$pend_guru')";
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
            <a class="navbar-brand" href="#">Data Guru</a>
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
    <title>Data Guru</title>
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
                        <label for="id_guru" class="col-sm-2 col-form-label">Id Guru</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_guru" name="id_guru" value="<?php echo $id_guru ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_guru" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_guru" name="nama_guru" value="<?php echo $nama_guru ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="agama" name="agama" value="<?php echo $agama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ttg" class="col-sm-2 col-form-label">Tempat/Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ttg_guru" name="ttg_guru" value="<?php echo $ttg_guru ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jk_guru" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jk_guru" name="jk_guru" value="<?php echo $jk_guru ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat_guru" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat_guru" name="alamat_guru" value="<?php echo $alamat_guru ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="pend_guru" class="col-sm-2 col-form-label">Pendidikan Terakhir</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pend_guru" name="pend_guru" value="<?php echo $pend_guru ?>">
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
                Data Guru
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Id Guru</th>
                            <th scope="col">Nama Guru</th>
                            <th scope="col">Agama</th>
                            <th scope="col">Tempat/Tanggal Lahir</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Pendidikan Terakhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from guru order by id_guru desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id_guru       = $r2['id_guru'];
                            $nama_guru     = $r2['nama_guru'];
                            $agama         = $r2['agama'];
                            $ttg_guru      = $r2['ttg_guru'];
                            $jk_guru       = $r2['jk_guru'];
                            $alamat_guru   = $r2['alamat_guru'];
                            $pend_guru     = $r2['pend_guru'];
                            

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $id_guru ?></td>
                                <td scope="row"><?php echo $nama_guru ?></td>
                                <td scope="row"><?php echo $agama ?></td>
                                <td scope="row"><?php echo $ttg_guru ?></td>
                                <td scope="row"><?php echo $jk_guru ?></td>
                                <td scope="row"><?php echo $alamat_guru ?></td>
                                <td scope="row"><?php echo $pend_guru ?></td>
                                <td scope="row">
                                    <a href="guru.php?op=edit&id_guru=<?php echo $id_guru ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="guru.php?op=delete&id_guru=<?php echo $id_guru?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
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