<?php
include('confiq.php');
session_start();

// ketika kosong maka tidak bisa mengakses session keranjang(pembayaran)
if (empty($_SESSION["keranjang"]) || !isset($_SESSION["keranjang"])) {
  echo "<script>alert('Pilih Paket Wisata Dahulu');</script>";
  echo "<script>location='index.php';</script>";
}

// Pelanggan harus login terlebih dahulu utk membeli
if (!isset($_SESSION["pelanggan"])) {
  echo "<script>alert('Silahkan Login Dahulu');</script>";
  echo "<script>location='index.php';</script>";
}

?>

  <!doctype html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">


    <title>Checkout</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Custom styles for this template -->
    <link href="assets/dist/css/album.css" rel="stylesheet">
    <link href="assets/dist/css/checkout.css" rel="stylesheet">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-R0wkupAdVMomfCcd"></script>

  </head>

  <body class="bg-body-tertiary">

    <!-- Modal Login -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-lock"></i> Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form" action="admin/cek_login.php" method="POST" name="login">
              <div class="form-group">
                <label for="username"><i class="bi bi-person"></i> Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
              </div>
              <div class="form-group">
                <label for="password"><i class="bi bi-key-fill"></i> Password</label>
                <input type="text" class="form-control" id="password" placeholder="Enter password" name="password">
              </div>
              <div class="checkbox">
                <label><input type="checkbox" value="" checked>Remember me</label>
              </div>
              <button type="submit" class="btn btn-success btn-block" value="login"><i class="bi bi-unlock"></i>Login</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">Register</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Login -->

  <!-- Proses Login -->
  <?php
  if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    //query cek akun
    $pick = $konek->query("SELECT * FROM pelanggan WHERE email = '$email' AND password = '$password'");

    $cekakun = $pick->num_rows;

    if ($cekakun == 1) {
      $akun = $pick->fetch_assoc();

      $_SESSION["pelanggan"] = $akun;

      echo "<script>alert('Anda Sukses Login');</script>";
      echo "<script>location = 'index.php';</script>";
    } else {
      echo "<script>alert('Anda Gagal');</script>";
      echo "<script>location = 'index.php';</script>";
    }
  }
  ?>

    <!-- Modal Register -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-lock"></i> Register</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form" method="post" action="admin/aksi_register.php">
              <div class="form-group">
                <label for="nama"><i class="bi bi-person"></i> Nama</label>
                <input type="text" class="form-control" id="nama" placeholder="Enter nama" name="nama">
              </div>
              <div class="form-group">
                <label for="username"><i class="bi bi-person"></i> Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
              </div>
              <div class="form-group">
                <label for="password"><i class="bi bi-key"></i> Password</label>
                <input type="text" class="form-control" id="password" placeholder="Enter password" name="password">
              </div>
              <div class="form-group">
                <label for="email"><i class="bi bi-envelope"></i> Email</label>
                <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
              </div>
              <div class="form-group">
                <label for="nomer"><i class="bi bi-phone"></i> Nomer Hp</label>
                <input type="text" class="form-control" id="nomer" placeholder="Enter Nomer HP" name="nomer">
              </div>
              <div class="form-group">
                <label for="alamat"><i class="bi bi-house-fill"></i> Alamat</label>
                <input type="text" class="form-control" id="alamat" placeholder="Enter Alamat" name="alamat">
              </div>
              <button type="submit" name="register" class="btn btn-success btn-block"><i class="bi bi-unlock"></i> Register</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Register-->

    <!-- Navbar -->
    <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="nav">
      <div class="container-fluid">
        <a class="navbar-brand justify-content-center ms-5" href="index.php"><i class="bi bi-house-fill"> <strong>Panorama</strong></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto me-5">
              <li class="nav-item me-2 mb-1">
                <a href="index.php">
                  <button class="btn btn-outline-primary" type="button">
                    <i class="bi bi-house"> Home</i>
                  </button>
                </a>
              </li>
              <li class="nav-item">
                <div class="dropdown">
                  <button class="btn btn-outline-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                    <i class="bi bi-person"> Account</i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                  <!-- Ketika ada session pelanggan yg login -->
                  <?php if (isset($_SESSION["pelanggan"])) : ?>
                    <a href="logout.php" class="dropdown-item"> Logout</a>

                    <!-- Belum ada session pelanggan -->
                  <?php else : ?>
                    <button class="dropdown-item" data-toggle="modal" data-target="#exampleModal"> Login</button>
                    <button class="dropdown-item" data-toggle="modal" data-target="#exampleModal1"> Register</button>
                  <?php endif ?>
                </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <br>
    <div class="container">
      <main>
        <!-- <pre><?php print_r($_SESSION["pelanggan"]) ?></pre>
        <pre><?php print_r($_SESSION["keranjang"]) ?></pre> -->
        <form class="needs-validation" method="post" novalidate>
        <div class="row g-5">
          <div class="col-md-5 col-lg-4 order-md-last">
            <ul class="list-group mb-3">
              <?php $total = 0; ?>
              <?php foreach ($_SESSION["keranjang"] as $id => $jumlah) : ?>
                <!-- perulangan menampilkan paket berdasarkan id -->
                <?php
                $ambil = $konek->query("SELECT * FROM produk WHERE id = '$id'");
                $pecah = $ambil->fetch_assoc();

                $nama_paket = $pecah['nama'];

                // Hitung subharga
                $subharga = $pecah['harga']*$jumlah;
                ?>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                  <div>
                    <small class="text-muted">Paket Wisata</small>
                    <h2><?php echo $pecah["nama"] ?></h2>
                  </div>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                  <span>Rp.</span>
                  <h4><?php echo number_format($subharga); ?></h4>
                  <strong>
                    <a href="hapusCart.php?id=<?php echo $id ?>">Hapus</a>
                  </strong>
                </li>
                <?php $total += $subharga; ?>
              <?php endforeach ?>
            </ul>

            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-primary">Total Harga</span>
            </h4>
            <ul class="list-group mb-3">
              <li class="list-group-item d-flex justify-content-between">
                <span>Total (Rp)</span>
                <h4><?php echo number_format($total); ?></h4>
              </li>
            </ul>
          </div>

          <div class="col-md-7 col-lg-8 card p-3">
            <h4 class="mb-3">Data Pembeli</h4>

              <div class="row g-3">
                <div class="col-12">
                  <label for="address" class="form-label">Nama</label>
                  <input type="text" class="form-control" value="<?php echo $_SESSION["pelanggan"]['nama'] ?>">
                </div>

                <div class="col-12">
                  <label for="address" class="form-label">Email</label>
                  <input type="text" class="form-control" value="<?php echo $_SESSION["pelanggan"]['email'] ?>">
                </div>

                <div class="col-12">
                  <label for="address" class="form-label">Alamat</label>
                  <input type="text" class="form-control" value="<?php echo $_SESSION["pelanggan"]['alamat'] ?>">
                </div>

                <div class="col-12">
                  <label for="address" class="form-label">Nomer Ponsel</label>
                  <input type="text" class="form-control" value="<?php echo $_SESSION["pelanggan"]['nomer'] ?>">
                </div>

                <div class="col-12">
                  <label for="date" class="form-label">Tanggal Penjemputan</label>
                  <input type="date" id="pesan" name="pesan" class="form-control" required>
                </div>

                <div class="col-md-6">
                  <!-- <label for="cc-name" class="form-label">Lokasi Penjemputan</label> -->
                  <select class="form-control" name="id_ongkir" required>
                    <option value="">Pilih Lokasi Penjemputan</option>
                    <?php
                    $ambil = $konek->query("SELECT * FROM ongkir");
                    while ($perongkir = $ambil->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $perongkir["id_ongkir"] ?>">
                      <?php echo $perongkir['nama_kota']; ?>
                    </option>
                  <div class="invalid-feedback">
                    Tulis Lokasi Anda
                  </div>
                  <?php } ?>
                  </select>
                </div>


                <div class="col-12">
                  <label for="address" class="form-label">Alamat Penjemputan</label>
                  <input type="text" name="alamatJemput" class="form-control" required>
                </div>


              </div>
              <br>
               <button class="w-100 btn btn-primary btn-lg" name="chekout" type="submit">Checkout</button>
            </form>

            <!-- menyimpan data pembelian -->
          <?php
            if (isset($_POST["chekout"])) {
              $id_pelanggan = $_SESSION["pelanggan"]["id"];
              $id_alamat = $_SESSION["pelanggan"]["alamat"];
              $id_ongkir = $_POST["id_ongkir"];
              $pesan = $_POST["pesan"];
              $almtJemput = $_POST["alamatJemput"];

              $ambil = $konek->query("SELECT * FROM ongkir WHERE id_ongkir ='$id_ongkir'");
              $arrayongkir = $ambil->fetch_assoc();
              $tarif = $arrayongkir['tarif'];
              $kota_ongkir = $arrayongkir['nama_kota'];
              $tarif_ongkir = $arrayongkir['tarif'];

              $total_beli = $total + $tarif;

              // menyimpan data pembelian ke database
              $query = "INSERT INTO pembelian (id_pelanggan, id_ongkir, nama_paket, total, tgl_pesan, kota_ongkir, tarif_ongkir, alamat_penjemputan) VALUES ('$id_pelanggan', '$id_ongkir', '$nama_paket', '$total_beli', '$pesan', '$kota_ongkir', '$tarif_ongkir', '$almtJemput')";
              // Execute the query
              if ($konek->query($query) === TRUE) {
               echo "Sukses";
              } else {
                echo "Error: " . $query . "<br>" . $konek->error;
              }

              // mendapatkan id beli terbaru
              $id_belibarusan = $konek->insert_id;

              foreach ($_SESSION["keranjang"] as $id => $jumlah){
                // mendapatkan data produk berdasarkan id di tbl produk
                $ambil = $konek->query("SELECT * FROM produk WHERE id = '$id'");
                $perproduk = $ambil->fetch_assoc();

                $namaBeli = $perproduk['nama'];
                $hargaBeli = $perproduk['harga'];

                $subtotal = $perproduk['harga']*$jumlah;

                $konek->query("INSERT INTO pembelian_produk (id_pembelian, id_produk, jumlah, namaBeli, hargaBeli, subtotal)
                    VALUES ('$id_belibarusan', '$id', '$jumlah', '$namaBeli', '$hargaBeli','$subtotal') ");
              }

              // mengkosongkan
              unset($_SESSION["keranjang"]);

               // tampilkan ke nota
            echo "<script>alert('Lanjut Ke Pembayaran');</script>";
            echo "<script>location = './midtrans/examples/snap/checkout-process-simple-version.php?id=$id_belibarusan';</script>";

            }


          ?>
          </div>
        </div>
      </main>
    </div>
    <br>

    <!-- Isi -->
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

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="assets/dist/js/checkout.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>
      window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/vendor/holder.min.js"></script>
  </body>

  </html>
