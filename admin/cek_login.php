<?php 
// mengaktifkan session php
session_start();
// menghubungkan dengan koneksi
include('confiq.php');

 
// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];
 
// menyeleksi data admin dengan username dan password yang sesuai
$sql = "SELECT * FROM admin WHERE username = '$username' and password = '$password'";
$data = mysqli_query($db, $sql);
 
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);
 
if($cek > 0){
    $_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	$_SESSION["login"] = true;
	header("location:index.php");

}else{
	$_SESSION["login"] = false;
	header("location:loginAdmin.php?");
}
?>