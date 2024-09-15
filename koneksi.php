<?php
$server = "localhost";
$user = "root";
$password = "";
$nama_database = "besiswa_serkom";
$conn = mysqli_connect($server, $user, $password, $nama_database);

if( !$conn ){
die("Gagal terhubung dengan database: " . mysqli_connect_error());
}
?>
