<?php

include('confiq.php');

    include('confiq.php');
    $nama = $_POST['nama'];
    $nomer = $_POST['nomer'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $pesan = $_POST['pesan'];

    if(!$nama || !$email || !$pesan ) {
        echo "<div align='center'> Masih ada data (Nama, Nomer, dan Pesan) yang kosong! <a href='../index.php'>Back to Index</a>";
    }
    else{
        $data = "INSERT INTO tamu (nama, nomer, email, alamat, pesan) VALUES('$nama','$nomer','$email','$alamat','$pesan')";
        $simpan = mysqli_query($db, $data);
        if($simpan) {
            header('Location: ../index.php?status=sukses');
        } 
        else {
            header('Location: ../tamu.php?status=gagal');
        }
    }

      
?>