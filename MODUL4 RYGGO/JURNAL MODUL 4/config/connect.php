<!-- File ini berisi koneksi dengan database MySQL -->
<?php 

// (1) Buatlah variable untuk connect ke database yang telah di import ke phpMyAdmin
$host = "localhost:3306";
$user = "root";
$pass = "";
$db = "modul4";
$connection = mysqli_connect($host,$user,$pass,$db);
// 

// (2) Buatlah perkondisian untuk menampilkan pesan error ketika database gagal terkoneksi
if (!$connection) {
    die("Koneksi Gagal Terhubung: ". mysqli_connect_error());
}
// 
?>