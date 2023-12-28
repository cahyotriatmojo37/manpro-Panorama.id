<?php
include('confiq.php');
session_start();

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="favicon.ico">

  <title>Panorama.id</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/album/">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Bootstrap core CSS -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/dist/css/album.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- Custom styles for this template -->
  <style>
    #back-to-top {
      position: fixed;
      right: 28px;
      bottom: 100px;
      display: grid;
      place-items: center;
      border-radius: 50%;
      width: 35px;
      height: 35px;
      text-decoration: none;
      cursor: pointer;
      background-color: #fff;
      color: black;
      font-size: 22px;
      transition: all 0.3s linear;
      opacity: 0;
      pointer-events: none;
    }

    #back-to-top.active {
      opacity: 1;
      pointer-events: auto;
    }

    #back-to-top:hover {
      background-color: darkslategrey;
      color: #fff;
    }
  </style>
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
          <form role="form" method="POST" name="login">
            <div class="form-group">
              <label for="email"><i class="bi bi-person"></i> Email</label>
              <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
            <div class="form-group">
              <label for="password"><i class="bi bi-key-fill"></i> Password</label>
              <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="" checked>Remember me</label>
            </div>
            <button type="submit" class="btn btn-success btn-block" name="login"><i class="bi bi-unlock"></i>Login</button>
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

      // echo "<script>alert('Anda Sukses Login');</script>";
      // echo "<script>location = 'index.php';</script>";
      echo "<script type='text/javascript'>
      setTimeout(function () {
        swal({
          title: 'Anda Sukses Login',
          text: 'Selamat Datang di Panorama.id',
          icon: 'success',
          showConfirmButton: true
        });
      },10);
        window.setTimeout(function(){
          window.location.replace('index.php');
        } ,3000);
          </script>";

    } else {
      // echo "<script>alert('Anda Gagal');</script>";
      // echo "<script>location = 'index.php';</script>";
      echo "<script type='text/javascript'>
      setTimeout(function () {
        swal({
          title: 'Anda Gagal Login',
          text: 'Silahkan Login Ulang Yaa',
          icon: 'error',
          showConfirmButton: true
        });
      },10);
        window.setTimeout(function(){
          window.location.replace('index.php');
        } ,3000);
          </script>";
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
          <form role="form" method="post" action="regisPelanggan.php">
            <div class="form-group">
              <label for="nama"><i class="bi bi-person"></i> Nama Lengkap</label>
              <input type="text" class="form-control" id="nama" placeholder="Enter nama" name="nama">
            </div>
            <div class="form-group">
              <label for="email"><i class="bi bi-envelope"></i> Email</label>
              <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
            <div class="form-group">
              <label for="password"><i class="bi bi-key"></i> Password</label>
              <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
            </div>
            <div class="form-group">
              <label for="nomer"><i class="bi bi-phone"></i> Nomer Hp</label>
              <input type="number" class="form-control" id="nomer" placeholder="Enter Nomer HP" name="nomer">
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
              <a href="keranjang.php">
                <button class="btn btn-outline-warning" type="button">
                  <i class="bi bi-cart"> Cart</i>
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
    <!-- navbar -->
  </header>

  <main role="main">

    <!-- Slider -->
    <div id="demo" class="carousel slide carousel-fade" data-ride="carousel">
      <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
        <li data-target="#demo" data-slide-to="4"></li>
      </ul>
      <div class="carousel-inner" style="max-height: 750px;">
        <div class="carousel-item active">
          <img src="assets/gambar/1.png" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
          </div>
        </div>
        <div class="carousel-item">
          <img src="assets/gambar/2.png" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
          </div>
        </div>
        <div class="carousel-item">
          <img src="assets/gambar/3.png" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <!-- <h5>Karimun Jawa </h5> -->
          </div>
        </div>
        <div class="carousel-item">
          <img src="assets/gambar/4.png" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <!-- <h5>Borobudur</h5> -->
          </div>
        </div>

        <a class="carousel-control-prev" href="#demo" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
          <span class="carousel-control-next-icon"></span>
        </a>
      </div>
      <!-- Slider -->
      <!-- Sponsor -->

      <div class="container px-5 my-5">
        <div class="text-center mb-5">
          <br>
          <h2 class="fw-bolder">Sponsorship</h2>
        </div>
        <div id="gallery" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
              <div class="carousel-item active">
                  <div class="row ">
                      <div class="col card ms-auto" style="max-width: 14rem;">
                          <img class="img-fluid m-auto" src="assets/gambar/sponsor/bear.jpg" height="" alt="Image 1"/>
                      </div>

                      <div class="col card ms-auto" style="max-width: 14rem;">
                          <img class="img-fluid m-auto" src="assets/gambar/sponsor/indomie.png" alt="Image 2"/>
                      </div>

                      <div class="col card ms-auto"style="max-width: 14rem;">
                          <img class="img-fluid m-auto" src="assets/gambar/sponsor/SB.png" alt="Image 3"/>
                      </div>

                      <div class="col card ms-auto me-auto"style="max-width: 14rem;">
                          <img class="img-fluid m-auto" src="assets/gambar/sponsor/kornet.png" alt="Image 4"/>
                      </div>
                  </div>
              </div>

              <div class="carousel-item">
                  <div class="row">
                      <div class="col card ms-auto me-auto" style="max-width: 14rem;">
                          <img class="img-fluid m-auto" src="assets/gambar/sponsor/timo.png" height="" alt="Image 1"/>
                      </div>

                      <div class="col card ms-auto me-auto" style="max-width: 14rem;">
                          <img class="img-fluid m-auto" src="assets/gambar/sponsor/sakatonik.png" alt="Image 5"/>
                      </div>

                      <div class="col card ms-auto me-auto"style="max-width: 14rem;">
                          <img class="img-fluid m-auto" src="assets/gambar/sponsor/kornet.png" alt="Image 3"/>
                      </div>

                      <div class="col card ms-auto me-auto"style="max-width: 14rem;">
                          <img class="img-fluid m-auto" src="assets/gambar/sponsor/fiesta.jpg" alt="Image 4"/>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>


    <!-- Paket -->
      <div class="container px-5 my-5">
        <div class="text-center mb-5 ">
          <br>
          <h2 class="fw-bolder">Paket Wisata</h2>
        </div>

        <!-- search -->
        <form method="$_GET" action="index.php" class="d-flex justify-content-center">
          <input class="form-control input-md w-auto bg-light" type="search" placeholder="Search" aria-label="Search" name="cari" value="<?php if (isset($_GET['cari'])) {
                                                                                                                                            echo $_GET['cari'];
                                                                                                                                          } ?>">
          <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
        </form>
      </div>

      <!-- Isi Gambar Paket -->
      <div class="container">
        <div class="row">
          <?php
          include('confiq.php');

          if (isset($_GET['cari'])) {
            $pencarian = $_GET['cari'];
            $query = "SELECT * FROM produk where nama like '%" . $pencarian . "%' order by id asc";
          } else {
            $query = "SELECT * FROM produk order by id asc";
          }

          $tampil = mysqli_query($konek, $query);
          while ($perproduk = mysqli_fetch_array($tampil)) { ?>

            <div class="col-md-3 card text-center me-auto ms-auto p-3 mb-3 row" style="width: 19rem;">

              <div class="thumbnail"><img src="assets/gambar/produk/<?php echo $perproduk['foto']; ?>" alt="" width="93%" style="max-height:130px; max-width:240px">
              </div>
              <div class="caption mt-1">
                <h5><?php echo $perproduk['nama']; ?></h5> <!--judul produk-->
                <p><?php echo $perproduk['singkat']; ?>..</p>
                <div class="btn-group">
                  <a href="produk.php?id=<?php echo  $perproduk['id']; ?>">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Lebih Lengkap</button>
                  </a>
                </div>
              </div>
            </div>
          <?php }
          ?>
        </div>
      </div>
    </div>
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

      <!-- back to top -->
      <a href="#" id="back-to-top">
        <i class="fas fa fa-chevron-up"></i>
      </a>


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
      <script src="assets/dist/js/sponsor.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>

      <script>
        // back to top scroll js
        let toTop = document.querySelector("#back-to-top");

        window.addEventListener("scroll", () => {
          if (window.pageYOffset > 100) {
            toTop.classList.add("active")
          } else {
            toTop.classList.remove("active")
          }
        })
      </script>

</body>

</html>