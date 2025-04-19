<?php

include "koneksi.php";

if (!isset($_SESSION['user']['id_user'])) {
    echo "User tidak terautentikasi!";
    exit();
}

$query = mysqli_query($koneksi, "SELECT * FROM peminjaman 
    LEFT JOIN user ON user.id_user = peminjaman.id_user 
    LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku 
    WHERE peminjaman.id_user = " . $_SESSION['user']['id_user']);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Riwayat Peminjaman Anda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <h1 class="mt-4 fw-bold">Status Peminjaman Buku</h1>
        <div class="card shadow rounded-4 border-0">
            <div class="card-body">
                <h5 class="fw-bold mb-0">Riwayat Peminjaman Anda</h5>
                <div class="table-responsive mt-3">
                    <table class="table table-hover table-bordered align-middle text-center" id="dataTable">
                        <thead class="table-secondary">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while($data = mysqli_fetch_array($query)) {
    
                            ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td class="text-start"><?php echo $data['nama']; ?></td>
                                <td class="text-start"><?php echo $data['judul']; ?></td>
                                <td><?php echo date("d M Y", strtotime($data['tanggal_peminjaman'])); ?></td>
                                <td><?php echo date("d M Y", strtotime($data['tanggal_pengembalian'])); ?></td>
                                <td>
                                    <?php

                                    if ($data['status_peminjaman'] == 'pending') { ?>
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                        <i class="fas fa-clock me-1"></i>Menunggu Konfirmasi
                                    </span>
                                    <?php } elseif ($data['status_peminjaman'] == 'disetujui') { ?>
                                    <span class="badge bg-success px-3 py-2 rounded-pill">
                                        <i class="fas fa-check-circle me-1"></i>Disetujui
                                    </span>
                                    <?php } elseif ($data['status_peminjaman'] == 'ditolak') { ?>
                                    <span class="badge bg-danger px-3 py-2 rounded-pill">
                                        <i class="fas fa-times-circle me-1"></i>Ditolak
                                    </span>
                                    <?php } elseif ($data['status_peminjaman'] == 'dipinjam') { ?>
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                        <i class="fas fa-hourglass-half me-1"></i>Dipinjam
                                    </span>
                                    <?php } elseif ($data['status_peminjaman'] == 'dikembalikan') { ?>
                                    <span class="badge bg-primary px-3 py-2 rounded-pill">
                                        <i class="fas fa-book me-1"></i>Dikembalikan
                                    </span>
                                    <?php } else { ?>
                                    <span class="badge bg-secondary px-3 py-2 rounded-pill">
                                        <i class="fas fa-exclamation-circle me-1"></i>Tidak Diketahui
                                    </span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>