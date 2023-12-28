<?php
   include('confiq.php');
   $nama = $_POST['nama'];
   $username = $_POST['username'];
   $password = $_POST['password'];
   $nomer = $_POST['nomer'];
   $email = $_POST['email'];
   $alamat = $_POST['alamat'];

   $sql = "SELECT * FROM admin WHERE username = '$username'";
   $query = $db->query($sql);
 
   if($query->num_rows != 0) {
     echo "<div align='center'>Username Sudah Terdaftar! <a href='loginAdmin.php'>Back</a></div>";
   } 
   else {
     if(!$username || !$password || !$nama || !$nomer || !$alamat ) {
       echo "<div align='center'> Masih ada data yang kosong! <a href='loginAdmin.php'>Back</a>";
     } 
     else {
       $data = "INSERT INTO admin (nama, username, password, nomer, email, alamat) VALUES('$nama','$username','$password','$nomer','$email','$alamat')";
       $simpan = mysqli_query($db, $data);
       if($simpan) {
         echo "<div align='center'>Pendaftaran Sukses, Silahkan <a href='loginAdmin.php'>Login</a></div>";
       } 
       else {
         echo "<div align='center'>Proses Gagal!</div>";
       }
     }
   }
?>