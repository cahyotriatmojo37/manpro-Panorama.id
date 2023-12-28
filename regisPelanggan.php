<?php
   include('confiq.php');
   $nama = $_POST['nama'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $nomer = $_POST['nomer'];
   $alamat = $_POST['alamat'];

   $sql = "SELECT * FROM pelanggan WHERE nama = '$nama'";
   $query = $konek->query($sql);
 
   if($query->num_rows != 0) {
     echo "<div align='center'>Username Sudah Terdaftar! <a href='index.php'>Back</a></div>";
   } 
   else {
     if(!$nama || !$email || !$password || !$nomer || !$alamat ) {
       echo "<div align='center'> Masih ada data yang kosong! <a href='index.php'>Back</a>";
     } 
     else {
       $data = "INSERT INTO pelanggan (nama, email, password, nomer, alamat) VALUES('$nama','$email','$password','$nomer','$alamat')";
       $simpan = mysqli_query($konek, $data);
       if($simpan) {
         echo "<div align='center'>Pendaftaran Sukses, Silahkan <a href='index.php'>Login</a></div>";
       } 
       else {
         echo "<div align='center'>Proses Gagal!</div>";
       }
     }
   }
?>