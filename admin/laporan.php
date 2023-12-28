<?php include('confiq.php');
session_start();?>
<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
  <script src="assets/js/color-modes.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="favicon.ico">
  <title>Laporan</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      width: 100%;
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
      --bd-violet-bg: #712cf9;
      --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

      --bs-btn-font-weight: 600;
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bd-violet-bg);
      --bs-btn-border-color: var(--bd-violet-bg);
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: #6528e0;
      --bs-btn-hover-border-color: #6528e0;
      --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
      --bs-btn-active-color: var(--bs-btn-hover-color);
      --bs-btn-active-bg: #5a23c8;
      --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
      z-index: 1500;
    }

    .bd-mode-toggle .dropdown-menu .active .bi {
      display: block !important;
    }
  </style>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="assets/css/dashboard.css" rel="stylesheet">
</head>

<body>


  <header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">Admin</a>

    <ul class="navbar-nav flex-row d-md-none">
      <li class="nav-item text-nowrap">
        <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <svg class="bi">
            <use xlink:href="#list" />
          </svg>
        </button>
      </li>
    </ul>
  </header>

  <div class="container-fluid">
    <div class="row">
      <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
        <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">Admin</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
          </div>
          <!-- sidebar -->
          <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <a class="nav-link d-flex align-items-center gap-2" href="index.php">
              <i class="bi bi-house"></i>
              Home
            </a>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
              <span>Transaksi</span>
              <a class="link-secondary" href="#" aria-label="Add a new report">
                <svg class="bi">
                  <use xlink:href="#plus-circle" />
                </svg>
              </a>
            </h6>
            <ul class="nav flex-column mb-auto">
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="list_produk.php">
                  <i class="bi bi-book"></i>
                  Daftar Wisata
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="tambah_produk.php">
                  <i class="bi bi-book-half"></i>
                  Tambah Wisata
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="daftarPesan.php">
                  <i class="bi bi-book-fill"></i>
                  Daftar Pesan
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="laporan.php">
                  <i class="bi bi-book-fill"></i>
                  Laporan
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
              <span>User</span>
              <a class="link-secondary" href="#" aria-label="Add a new report">
                <svg class="bi">
                  <use xlink:href="#plus-circle" />
                </svg>
              </a>
            </h6>
            <ul class="nav flex-column mb-auto">
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="admin.php">
                  <i class="bi bi-person"></i>
                  Daftar Admin
                </a>
              </li>
            </ul>

            <hr class="my-4">

            <ul class="nav flex-column mb-auto">
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="logout.php">
                  <i class="bi bi-key"></i>
                  Sign out
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <?php

        $laport = array();
        $tgl_mulai = " ";
        $tgl_selesai = " ";

        if (isset($_POST["kirim"])) {
        $tgl_mulai = $_POST["tglm"];
        $tgl_selesai = $_POST["tgls"];

        $ambil = $db->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl
                    ON pm.id_pelanggan = pl.id WHERE tgl_pesan BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
        if ($ambil) {
        while ($pecah = $ambil->fetch_assoc()) {
            $laport[] = $pecah; // Fix: Change $ambil to $pecah
        }
        } else {
        echo "Error: " . $db->error; // Display an error message if the query fails
        }
        }


        ?>

<!-- <pre><?php print_r($laport); ?></pre> -->
      <!-- isi -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Laporan pembelian
            <?php echo $tgl_mulai ?> SAMPAI <?php echo $tgl_selesai ?>
        </h2>

          <div class="container">
            <div class="isi">
            <form method="post">
                <div class="row">
                <div class="col-md-3">
                    <label>Dari Tanggal</label>
                    <input type="date" class="form-control" name="tglm" value="<?php echo $tgl_mulai ?>">
                </div>
                <div class="col-md-3">
                    <label>Sampai Tanggal</label>
                    <input type="date" class="form-control" name="tgls" value="<?php echo $tgl_selesai ?>">
                </div>

                <div class="col-md-3">
                    <label>&nbsp;</label><br>
                    <button class="btn btn-primary" name="kirim">Lihat Laporan</button>
                </div>
                </div>
            </form>
            <br>
              <table class="table table-responsive">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Pembeli</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                  </tr>
                </thead>
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

                    <!-- <?php echo "Total: " . number_format($total) . ",00"; ?> -->


                </tbody>
              </table>

              <p>Total: <?php echo number_format($total) ?>,00

            </div>
            <a href="cetak.php?tglm=<?php echo $tgl_mulai ?>&tgls=<?php echo $tgl_selesai ?>">Download Laporan</a>
          </div>
        </div>

    </div>
    </main>
  </div>
  </div>
  <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js" integrity="sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp" crossorigin="anonymous"></script>
  <script src="dashboard.js"></script>
</body>

</html>