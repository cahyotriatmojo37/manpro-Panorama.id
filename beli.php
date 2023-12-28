<?php
session_start();
$id = $_GET['id'];

if (isset($_SESSION['keranjang'][$id])) {
    $_SESSION['keranjang'][$id]+=1;
} else {
    $_SESSION['keranjang'][$id]=1;
}

echo "<script>location = 'keranjang.php';</script>";
?>