<?php

include('confiq.php');

if( isset($_GET['id']) ){

    // ambil id dari query string
    $id = $_GET['id'];

    // buat query hapus

    $data = "DELETE FROM admin WHERE id=$id";
    $data1 = "DELETE FROM produk WHERE id=$id";


    $apus = mysqli_query($db, $data);
    $apus1 = mysqli_query($db, $data1);

    // apakah query hapus berhasil?
    if($apus){
        header('Location: admin.php');
    }
    if($apus1){
        header('Location: list_produk.php');
    }
    else {
        die("gagal menghapus...");
    }

} else {
    die("akses dilarang...");
}

?>