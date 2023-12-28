
<?php
session_start();

// menghancurkan session
session_destroy();

echo "<script>alert('Berhasil Logout');</script>";
echo "<script>location='index.php';</script>";
?>