<?php

include('confiq.php');

    $nama = $_POST['nama'];
    $singkat = $_POST['singkat'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $name = $_FILES['foto']['name'];
	$lokasi =$_FILES['foto']['tmp_name'];
	move_uploaded_file($lokasi,"../assets/gambar/produk/".$name);


    if(!$nama || !$harga ) {
        echo "<div align='center'> Masih ada data (Nama, Stok, Ukuran, Warna dan Kondisi) yang kosong! <a href='tambah_produk.php'>Back to Tambah Produk</a>";
    }
    else{
        $data = "INSERT INTO produk (nama, singkat, deskripsi, harga, foto) VALUES('$nama','$singkat','$deskripsi','$harga', '$name')";
        $simpan = mysqli_query($db, $data);
        if($simpan) {
            header('Location: list_produk.php?status=sukses');
        }
        else {
            header('Location: tambah_produk.php?status=gagal');
        }
    }


?>