<?php

// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for snap popup:
// https://docs.midtrans.com/en/snap/integration-guide?id=integration-steps-overview

namespace Midtrans;

require_once dirname(__FILE__) . '/../../Midtrans.php';
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
Config::$serverKey = 'SB-Mid-server-lIHzickbDg7yyi96Rs-tjRae';
Config::$clientKey = 'SB-Mid-client-R0wkupAdVMomfCcd';

// non-relevant function only used for demo/example purpose
printExampleWarningMessage();

// Uncomment for production environment
// Config::$isProduction = true;
Config::$isSanitized = Config::$is3ds = true;

// Required
include "../../../confiq.php";
$id_belibarusan = $_GET['id'];

$ambil = $konek->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id
                    WHERE   pembelian.id_beli='$_GET[id]'");
// $detail = $ambil->fetch_assoc();
$detail = mysqli_fetch_array($ambil);

// Query untuk menampilkan data siswa berdasarkan NIS yang dikirim
// $query = "SELECT * FROM pembelian_produk WHERE id_pembelian='" . $id_belibarusan . "'";
// $sql = mysqli_query($konek, $query);  // Eksekusi/Jalankan query dari variabel $query
// $data = mysqli_fetch_array($sql);

// $id_produk = $data['id_produk'];
$id_beli_produk = $detail['id_beli'];
$jumlah = $detail['id_ongkir'];
$nama = $detail['nama'];
$nama_pro = $detail['nama_paket'];
$email = $detail['email'];
$total = $detail['total'];
$nomer = $detail['nomer'];




// $total =$data['total'];
$transaction_details = array(
    'order_id' => $id_beli_produk,
    'gross_amount' =>  $id_beli_produk, // no decimal allowed for creditcard
);
// Optional
$item_details = array(
    array(
        'id' => $id_beli_produk,
        'price' => $total,
        'quantity' => $jumlah,
        'name' => "$nama_pro"
    ),
);
// Optional
$customer_details = array(
    'first_name'    => "$nama",
    'last_name'     => "",
    'email'         => "$email",
    'phone'         => "$nomer",

);
// Fill transaction details
$transaction = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
);

$snap_token = '';
try {
    $snap_token = Snap::getSnapToken($transaction);
} catch (\Exception $e) {
    echo $e->getMessage();
}


function printExampleWarningMessage()
{
    if (strpos(Config::$serverKey, 'your ') != false) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'SB-Mid-server-lIHzickbDg7yyi96Rs-tjRae\';');
        die();
    }
}
?>
<!-- <pre><?php print_r($data); ?></pre> -->
<!-- <pre><?php print_r($detail); ?></pre> -->


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PAYMENT </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="nav">
      <div class="container-fluid">
        <a class="navbar-brand justify-content-center ms-5" href="index.php"><i class="bi bi-house-fill"> <strong>Panorama</strong></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto me-5">
              <li class="nav-item me-2 mb-1">
                <a href="../../../index.php">
                  <button class="btn btn-outline-primary" type="button">
                    <i class="bi bi-house"> Home</i>
                  </button>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <br>
    <br>
    <div class="container">
    <main class="col-md-9 ms-sm-auto me-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Detail Pembayaran</h1>
                </div>

                <section class="panel">
                <?php
                $ambil = $konek->query("SELECT * FROM pembelian JOIN pelanggan ON
                pembelian.id_pelanggan =pelanggan.id WHERE
                pembelian.id_beli='$_GET[id]'");
                $detail = $ambil->fetch_assoc();
                ?>

                <div class="row">
                  <div class="col-md-4"></div>
                  <div class="col-md-4">
                    <h3>Data Diri</h3>
                    <strong><?php echo $detail['nama']; ?></strong>
                  </div>

                  <div class="col-md-4">
                    <h3>Penjemputan</h3>
                    <strong><?php echo $detail['kota_ongkir']; ?></strong><br>
                    Ongkos Penjemputan: Rp. <?php echo number_format ($detail['tarif_ongkir']); ?>
                  </div>
                </div>
                      <table class="table table-striped table-advance table-hover">

                        <tr>
                          <th>No</th>
                          <th>Nama Paket</th>
                          <th>Jumlah</th>
                          <th>Total</th>
                        </tr>
                        <tbody>
                          <?php $nomor = 1; ?>

                          <?php $ambil = $konek->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>       <!-- id punya nya idproduk -->
                          <?php while ($pecah = $ambil->fetch_assoc()) { ?>

                            <tr>
                              <td><?php echo $nomor; ?></td>
                              <td><?php echo $pecah['namaBeli']; ?></td>
                              <td><?php echo $pecah['jumlah']; ?></td>
                              <td>Rp. <?php echo number_format($pecah['subtotal']) ?></td>
                              <!-- <td><?php echo $pecah['harga']*$pecah['jumlah']; ?></td> -->

                            </tr>

                            <?php $nomor++; ?>
                          <?php } ?>
                        </tbody>
                      </table>

                    </section>
            </main>
        <div class="card w-75 ms-auto me-auto mb-1 text-center">
            <div class="card-body">
                <p>Selesaikan Pembayaran Sekarang</p>
                <button id="pay-button" class="btn btn-primary">PILIH METODE PEMBAYARAN</button>

                <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
                <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey; ?>"></script>
                <script type="text/javascript">
                    document.getElementById('pay-button').onclick = function() {
                        // SnapToken acquired from previous step
                        snap.pay('<?php echo $snap_token ?>');
                    };
                </script>

            </div>
        </div>
    </div>
     <!-- foooter -->
     <footer class="bg-dark text-white pt-5 pb-4 sticky">
        <div class="container text-center text-md-left">
          <div class="row text-center text-md-left">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
              <h5 class="text-uppercase mb-4 font-weight-bold text-primary">Panorama</h5>
              <p>Kita adalah website untuk memesan paket liburan bagi masyarakat yang ingin melakukan pariwisata. </p>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
              <h5 class="text-uppercase mb-4 font-weight-bold text-primary">Social Media</h5>
              <p><a href="#" class="text-white" style="text-decoration: none;"> Facebook</a></p>
              <p><a href="#" class="text-white" style="text-decoration: none;"> Instagram</a></p>
              <p><a href="#" class="text-white" style="text-decoration: none;"> Twitter</a></p>
            </div>
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
              <h5 class="text-uppercase mb-4 font-weight-bold text-primary"> Alamat </h5>
              <p>Jl. Imam Bonjol No.207, Pendrikan Kidul, Kota Semarang, Jawa Tengah 50131</p>
            </div>
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
              <h5 class="text-uppercase mb-4 font-weight-bold text-primary"> Pembayaran </h5>
              <p>DANA, OVO, Gopay, ShopeePay, BNI, Mandiri, BCA, BRI, Bank Jateng</p>
            </div>
          </div>
          <hr class="mb-4">
            <div class="">
                <p> Copyright © 2023
                  <a href="#" style="text-decoration: none;">
                  <strong class="text-primary" >Panorama.ID</strong>
                  </a>
                </p>
            </div>
        </div>
      </div>

      </footer>
      <!-- foooter -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>

</html>