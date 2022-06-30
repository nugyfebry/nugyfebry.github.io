<?php
//koneksi ke database mysql, isi parameter sesuai web server masing-masing
$koneksi = mysqli_connect("localhost","root","","sdn_cwr_akademik");

//cek jika koneksi ke mysql gagal, maka akan tampil pesan error
if (mysqli_connect_errno()){
    echo "Gagal melakukan koneksi ke MySQL: " . mysqli_connect_error();
}
?>
