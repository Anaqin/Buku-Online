<?php
session_start();
include "koneksi.php";
$login_success = false;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <title>Login - Buku Online</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-secondary d-flex justify-content-center align-items-center min-vh-100">

    <div class="bg-white rounded-4 overflow-hidden shadow-lg w-100" style="max-width: 800px; height: 500px;">
        <div class="row h-100 g-0">
            <div class="col-md-6 bg-dark text-white d-flex flex-column justify-content-center align-items-center p-5">
                <div class="d-flex align-items-center">
                    <i class="fas fa-book fa-2x me-3"></i>
                    <div>
                        <h4 class="fw-bold text-center">BUKU ONLINE</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-6 d-flex flex-column justify-content-center p-5">
                <h4 class="text-center mb-4 fw-bold">Login</h4>

                <?php
                if (isset($_POST['login'])) {
                    $username = $_POST['username'];
                    $password = md5($_POST['password']);

                    $data = mysqli_query($koneksi, "SELECT * FROM user WHERE (username='$username' OR email='$username') AND password='$password'");
                    $cek = mysqli_num_rows($data);
                    if ($cek > 0) {
                        $_SESSION['user'] = mysqli_fetch_array($data);
                        $login_success = true;
                    } else {
                        echo '<div class="alert alert-danger text-center py-2">Username / Email atau Password salah!</div>';
                    }
                }
                ?>

                <form method="post">
                    <div class="mb-3">
                        <input type="text" name="username" class="form-control form-control-sm"
                            placeholder="Username atau Email" required>
                    </div>
                    <div class="mb-4">
                        <input type="password" name="password" class="form-control form-control-sm"
                            placeholder="Password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" name="login" value="login" class="btn btn-dark btn-sm">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php if ($login_success): ?>
    <div class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 1055;">
        <div class="toast align-items-center text-bg-dark border-0 show" role="alert">
            <div class="d-flex">
                <div class="toast-body text-center w-100 fw-semibold">
                    Login berhasil! Mengalihkan...
                </div>
            </div>
        </div>
    </div>
    <script>
    setTimeout(() => {
        window.location.href = "index.php"; // Mengalihkan ke halaman utama setelah login sukses
    }, 2000);
    </script>
    <?php endif; ?>

</body>

</html>