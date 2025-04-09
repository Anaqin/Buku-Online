<?php
    include "koneksi.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v6.3.0/css/all.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body class="bg-primary min-vh-100">

    <div class="container py-5">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow">
                    <div class="card-body px-4 py-5"> 
                        <h3 class="text-center text-primary mb-4">Login</h3>
                        <?php
                            if(isset($_POST['login'])) {
                                $username = $_POST['username'];
                                $password = md5($_POST['password']);

                                $data = mysqli_query($koneksi, "SELECT*FROM user where username='$username' and password='$password'");
                                $cek = mysqli_num_rows($data);
                                if($cek > 0){
                                    $_SESSION['user'] = mysqli_fetch_array($data);
                                    echo '<script>alert("Berhasil Login"); location.href="index.php";</script>';
                                }else {
                                    echo '<script>alert("username/password salah")</script>';
                                }
                            }
                        ?>    
                        <form method="post">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username" required>
                                <label for="inputUsername">Username</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" required>
                                <label for="inputPassword">Password</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg w-100" name="login" value="login">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center small text-muted">
                        &copy; Your Website 2025
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
