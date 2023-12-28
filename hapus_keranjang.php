<?php 
session_start();
session_destroy();
$id=$_GET['id'];

unset($_SESSION["keranjang"][$id]);

echo"<script>alert('produk di hapus dari keranjang');</script>";
echo"<script>location='keranjang.php';</script>";

?>