<?php
session_start();

$id_paket = $_GET["id"];
unset($_SESSION["keranjang"][$id_paket]);

echo "<script>alert(' Paket telah Dihapus');</script>";
echo "<script>location='keranjang.php';</script>";
?>