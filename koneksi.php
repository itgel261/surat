<?php
    $servername = "localhost"; // Ganti dengan URL database Anda
    $username = "root"; // Ganti dengan username database Anda
    $password = ""; // Ganti dengan password database Anda
    $dbname = "surat_gel"; // Nama database Anda

    // Membuat koneksi
    $connect = mysqli_connect($servername, $username, $password, $dbname);


    if ($connect->connect_error) {
        die("Koneksi gagal: " . $connect->connect_error);
    }

?>
