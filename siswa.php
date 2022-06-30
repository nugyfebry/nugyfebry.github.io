<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "sdn_cwr_akademik";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$nis           = "";
$nama_siswa    = "";
$ttg_siswa     = "";
$jk_siswa      = "";
$agama_siswa   = "";
$kd_kelas      = "";
$nm_wali       = "";
$sukses        = "";
$error         = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $nis         = $_GET['nis'];
    $sql1       = "delete from siswa where nis = '$nis'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $nis        = $_GET['nis'];
    $sql1       = "select * from siswa where nis = '$nis'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nis             = $r1['nis'];
    $nama_siswa      = $r1['nama_siswa'];
    $ttg_siswa       = $r1['ttg_siswa'];
    $jk_siswa        = $r1['jk_siswa'];
    $agama_siswa     = $r1['agama_siswa'];
    $kd_kelas        = $r1['kd_kelas'];
    $nm_wali         = $r1['nm_wali'];


    if ($nis == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $nis             = $_POST['nis'];
    $nama_siswa      = $_POST['nama_siswa'];
    $ttg_siswa       = $_POST['ttg_siswa'];
    $jk_siswa        = $_POST['jk_siswa'];
    $agama_siswa     = $_POST['agama_siswa'];
    $kd_kelas        = $_POST['kd_kelas'];
    $nm_wali         = $_POST['nm_wali'];
    
    
    if ($nis && $nama_siswa && $ttg_siswa && $jk_siswa && $agama_siswa && $kd_kelas && $nm_wali) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update siswa set nis = '$nis',nama_siswa='$nama_siswa',ttg_siswa='$ttg_siswa',jk_siswa='$jk_siswa',agama_siswa='$agama_siswa',kd_kelas='$kd_kelas',nm_wali='$nm_wali' where nis = '$nis'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into siswa (nis,nama_siswa,ttg_siswa,jk_siswa,agama_siswa,kd_kelas,nm_wali) values ('$nis','$nama_siswa','$ttg_siswa','$jk_siswa','$agama_siswa','$kd_kelas','$nm_wali')";
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
            <a class="navbar-brand" href="#">Data Siswa</a>
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
            
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nis" name="nis" value="<?php echo $nis ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_siswa" class="col-sm-2 col-form-label">Nama Siswa</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?php echo $nama_siswa ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ttg_siswa" class="col-sm-2 col-form-label">Tempat/Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ttg_siswa" name="ttg_siswa" value="<?php echo $ttg_siswa ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jk_siswa" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jk_siswa" name="jk_siswa" value="<?php echo $jk_siswa ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="agama_siswa" class="col-sm-2 col-form-label">Agama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="agama_siswa" name="agama_siswa" value="<?php echo $agama_siswa ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="kd_kelas" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kd_kelas" name="kd_kelas" value="<?php echo $kd_kelas ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nm_wali" class="col-sm-2 col-form-label">Nama Orang Tua/Wali</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nm_wali" name="nm_wali" value="<?php echo $nm_wali ?>">
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
                Data Siswa
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Tempat/Tanggal Lahir</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Agama</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Nama Orang Tua/Wali</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from siswa order by nis desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $nis             = $r2['nis'];
                            $nama_siswa      = $r2['nama_siswa'];
                            $ttg_siswa       = $r2['ttg_siswa'];
                            $jk_siswa        = $r2['jk_siswa'];
                            $agama_siswa     = $r2['agama_siswa'];
                            $kd_kelas        = $r2['kd_kelas'];
                            $nm_wali         = $r2['nm_wali'];
                            
                            

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nis ?></td>
                                <td scope="row"><?php echo $nama_siswa ?></td>
                                <td scope="row"><?php echo $ttg_siswa ?></td>
                                <td scope="row"><?php echo $jk_siswa ?></td>
                                <td scope="row"><?php echo $agama_siswa ?></td>
                                <td scope="row"><?php echo $kd_kelas ?></td>
                                <td scope="row"><?php echo $nm_wali ?></td>
                                <td scope="row">
                                    <a href="siswa.php?op=edit&nis=<?php echo $nis ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="siswa.php?op=delete&nis=<?php echo $nis?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
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