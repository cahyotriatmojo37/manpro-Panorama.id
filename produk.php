<?php
    include ('confiq.php');
    session_start();

    //mendapatkan id gambar
    $id = $_GET["id"];

    //ambil id gambar data
    $ambil = $konek->query("SELECT * FROM produk WHERE id = '$id'");
    $detail = $ambil->fetch_assoc();
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="favicon.ico">

  <title>Detail Paket</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/album/">

  <!-- Bootstrap core CSS -->
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- Custom styles for this template -->
  <link href="assets/dist/css/album.css" rel="stylesheet">
</head>

<body>
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
  <!-- Navbar -->

  <main role="main">
    <br>

    <!-- Isi -->
    <section class="kon">
            <div class="container">
            <div class="row">
          <div class="col-sm-9">
            <div class="card">
              <div class="card-body">
              <img src="assets/gambar/produk/<?php echo $detail["foto"]; ?>" class="img-responsive " style="max-height:400px;" width="100%"> <!-- foto produk -->
                <h5 class="card-title mt-1"><?php echo $detail["nama"] ?></h5>    <!-- nama produk -->
                <pre class="card-text"><?php echo $detail["deskripsi"]; ?> </pre>     <!-- deskripsi produk -->
                <h4 class="card-text">Rp. <?php echo number_format($detail["harga"]); ?></h4>      <!-- harga produk -->
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card">
              <div class="card-body">
              <h6>Masukan Jumlah Pesanan</h6>
              <form method="post">
                <div class="form-group col-md-9">
                  <div class="input-group">
                    <input type="number" class="form-control bg-light" name="jumlah" required>
                      <div class="input-group mt-2">
                      <button class="btn btn-primary" name="beli">Pesan</button>
                      </div>
                    </div>
                  </div>
              </form>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
          <!-- Ketika isi pesan name beli -->
            <?php
            //jika ada yang beli
            if (isset($_POST["beli"])){

              //ambil jumlah yg diinput
              $jumlah = $_POST["jumlah"];

              //masuk ke cart
              $_SESSION["keranjang"][$id] = $jumlah;

              //alert
              // echo "<script>alert('Lanjut Ke Pembayaran');</script>";
              echo "<script>location='keranjang.php';</script>";
            }
            ?>
          </div>
        </div>
      </div>
    </section>
    <!-- Isi -->
    <br>

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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>
      window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/vendor/holder.min.js"></script>
</body>

</html>