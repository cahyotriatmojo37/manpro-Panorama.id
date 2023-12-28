<?php

include('confiq.php');

// cek apakah tombol simpan sudah diklik atau blum?
if(isset($_POST['simpan'])){

    // ambil data dari formulir
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $singkat = $_POST['singkat'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $name = $_FILES['foto']['name'];
	$lokasi =$_FILES['foto']['tmp_name'];
	move_uploaded_file($lokasi,"../assets/gambar/produk/".$name);

    // buat query update
    $sql = "UPDATE produk SET nama='$nama', singkat='$singkat',harga='$harga', deskripsi='$deskripsi', foto='$name' WHERE id=$id";
    $query = mysqli_query($db, $sql);

    // apakah query update berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman list-siswa.php
        header('Location: list_produk.php');
    } else {
        // kalau gagal tampilkan pesan
        die("Gagal menyimpan perubahan...");
    }


} else {
    die("Akses dilarang...");
}

?>