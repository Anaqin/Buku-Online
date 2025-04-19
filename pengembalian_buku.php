<?php

include "koneksi.php";

if (isset($_GET['kembalikan'])) {
    $id_peminjaman = intval($_GET['kembalikan']);
    $tanggal_pengembalian = date('Y-m-d');

    $result = mysqli_query($koneksi, "SELECT id_buku FROM peminjaman WHERE id_peminjaman = $id_peminjaman");
    $row = mysqli_fetch_assoc($result);
    $id_buku = $row['id_buku'];

    $update = mysqli_query($koneksi, "UPDATE peminjaman 
        SET status_peminjaman = 'dikembalikan', 
            tanggal_pengembalian = '$tanggal_pengembalian' 
        WHERE id_peminjaman = $id_peminjaman");

    if ($update) {
        $updateStok = mysqli_query($koneksi, "UPDATE buku SET stok = stok + 1 WHERE id_buku = $id_buku");

        if ($updateStok) {
            echo '<div class="alert alert-success">Buku berhasil dikembalikan dan stok diperbarui.</div>';
        } else {
            echo '<div class="alert alert-warning">Buku berhasil dikembalikan, tapi gagal memperbarui stok.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Gagal mengembalikan buku.</div>';
    }
}


$id_user = $_SESSION['user']['id_user'];
$query = mysqli_query($koneksi, "SELECT p.*, b.judul 
                                FROM peminjaman p 
                                JOIN buku b ON p.id_buku = b.id_buku 
                                WHERE p.id_user = $id_user AND p.status_peminjaman IN ('disetujui')");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pengembalian Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <h1 class="mt-4 mb-4 fw-bold">Pengembalian Buku</h1>

        <div class="card shadow rounded-4 border-0">
            <div class="card-body">
                <h5 class="fw-bold mb-0">Daftar Buku yang Dipinjam</h5>
                <div class="table-responsive mt-3">
                    <table class="table table-hover table-bordered align-middle text-center">
                        <thead class="table-secondary">
                            <tr>
                                <th>No</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td class="text-start"><?php echo $data['judul']; ?></td>
                                <td><?php echo date('d M Y', strtotime($data['tanggal_peminjaman'])); ?></td>
                                <td><?php echo date('d M Y', strtotime($data['tanggal_pengembalian'])); ?></td>
                                <td>
                                    <?php
                                        if ($data['status_peminjaman'] == 'disetujui') {
                                    ?>
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                        <i class="fas fa-hourglass-half me-1"></i> Dipinjam
                                    </span>
                                    <?php
                                        }
                                    ?>
                                    <?php
                                        if ($data['status_peminjaman'] == 'dikembalikan') {
                                    ?>
                                    <span class="badge bg-success px-3 py-2 rounded-pill">
                                        <i class="fas fa-check-circle me-1"></i> Dikembalikan
                                    </span>
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td>

                                    <button class="btn btn-success btn-sm px-3 rounded-pill" data-bs-toggle="modal"
                                        data-bs-target="#kembalikanModal<?php echo $data['id_peminjaman']; ?>">
                                        <i class="fas fa-check-circle me-1"></i> Kembalikan
                                    </button>

                                    <div class="modal fade" id="kembalikanModal<?php echo $data['id_peminjaman']; ?>"
                                        tabindex="-1"
                                        aria-labelledby="kembalikanModalLabel<?php echo $data['id_peminjaman']; ?>"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header bg-success text-white">
                                                    <h5 class="modal-title"
                                                        id="kembalikanModalLabel<?php echo $data['id_peminjaman']; ?>">
                                                        <i class="fas fa-check-circle me-2"></i>Konfirmasi Pengembalian
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    Apakah kamu yakin ingin mengembalikan buku
                                                    <strong>"<?php echo $data['judul']; ?>"</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary rounded-3"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <a href="?page=pengembalian_buku&kembalikan=<?php echo $data['id_peminjaman']; ?>"
                                                        class="btn btn-success rounded-3">Ya, Kembalikan</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>