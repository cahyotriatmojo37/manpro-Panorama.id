<?php
include('confiq.php');
session_start();




 $tgl_mulai = $_GET["tglm"];
 $tgl_selesai = $_GET["tgls"];

 $laport = array();
 $ambil = $db->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl
            ON pm.id_pelanggan = pl.id WHERE tgl_pesan BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
if ($ambil) {
 while ($pecah = $ambil->fetch_assoc()) {
     $laport[] = $pecah; // Fix: Change $ambil to $pecah
 }
} else {
 // Display an error message if the query fails
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Document</title>
 <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

 <table class="table table-striped">

   <tr>
    <th>No</th>
    <th>Pembeli</th>
    <th>Tanggal</th>
    <th>Jumlah</th>
   </tr> 


 <tbody>

  <?php $total = 0; ?>
   <?php foreach ($laport as $key => $value): ?>
    <?php $total += $value["total"]; ?> <!-- Corrected line -->
    <tr>
     <td>
      <?php echo $key + 1; ?>
     </td>
     <td>
      <?php echo $value["nama"]; ?>
     </td>
     <td>
      <?php echo date("d F Y", strtotime($value["tgl_pesan"])); ?>
     </td>
     <td>
      <?php echo number_format($value["total"]); ?>,00
     </td>
    </tr>
   <?php endforeach ?>
   <!-- Display the total after the loop -->
   <!-- <?php echo "Total: " . number_format($total) . ",00"; ?> -->
   </tbody>
   <tfoot>
   <tr>
   <th colspan="3">Total</th>
    <th>Rp.
    <?php echo number_format($total) ?>


</body>
<script>
   window.print();
</script>

</html>