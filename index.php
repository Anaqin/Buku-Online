<?php
include "koneksi.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Buku Online</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-4 d-flex align-items-center gap-2" style="width:180px" href="index.php">
            <i class="fas fa-book"></i>
            <span>Buku Online</span>
        </a>

        <button class="btn btn-link btn-lg order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>

        <ul class="navbar-nav ms-auto me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center text-white" id="userDropdown" href="#"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle fa-lg me-2"></i>
                    <span><?= $_SESSION['user']['nama']; ?> (<?= $_SESSION['user']['level']; ?>)</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end  aria-labelledby=" userDropdown">
                    <li>
                        <h6 class="dropdown-header text-muted">
                            Login sebagai: <?= ucfirst($_SESSION['user']['level']); ?>
                        </h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <a class="dropdown-item text-danger" href="#" onclick="showLogoutPopup(event)">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading text-white">Core</div>
                        <a class="nav-link text-white" href="?page=home">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Discover
                        </a>
                        <div class="sb-sidenav-menu-heading text-white">Navigasi</div>
                        <?php if ($_SESSION['user']['level'] != 'peminjam') { ?>
                        <a class="nav-link text-white" href="?page=kategori">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Kategori
                        </a>
                        <a class="nav-link text-white" href="?page=buku">
                            <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                            Buku
                        </a>
                        <a class="nav-link text-white" href="?page=peminjaman_admin">
                            <div class="sb-nav-link-icon"><i class="fas fa-check-circle"></i></div>
                            Peminjaman Admin
                        </a>
                        <?php } ?>

                        <?php if ($_SESSION['user']['level'] == 'peminjam') { ?>
                        <a class="nav-link text-white" href="?page=peminjaman">
                            <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                            Riwayat Peminjaman
                        </a>
                        <a class="nav-link text-white" href="?page=pengembalian_buku">
                            <div class="sb-nav-link-icon"><i class="fas fa-undo"></i></div>
                            Pengembalian
                        </a>
                        <?php } ?>

                        <?php if ($_SESSION['user']['level'] != 'peminjam') { ?>
                        <a class="nav-link text-white" href="?page=laporan">
                            <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                            Laporan Peminjaman
                        </a>
                        <?php } ?>

                    </div>
                </div>
                <div class="sb-sidenav-footer bg-dark text-white">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-user-circle fa-lg"></i>
                        <div>
                            <div class="small mb-0 text-muted">Login Sebagai</div>
                            <div class="fw-semibold">
                                <?= isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']['nama']) : 'Guest'; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 mt-4">
                    <?php
                        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
                        if (file_exists($page . '.php')) {
                            include $page . '.php';
                        } else {
                            include '404.php';
                        }
                    ?>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Perpustakaan Digital SMK BPI 2025</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script>
    function showLogoutPopup(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Konfirmasi Logout',
            text: 'Apakah Anda yakin ingin logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "logout.php";
            }
        });
    }
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>