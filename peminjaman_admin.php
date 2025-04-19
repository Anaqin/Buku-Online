<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "koneksi.php";

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id_peminjaman = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action === 'disetujui') {
        $queryUpdate = "UPDATE peminjaman SET status_peminjaman = 'disetujui' WHERE id_peminjaman = $id_peminjaman";
        $update = mysqli_query($koneksi, $queryUpdate);
        $_SESSION['message'] = $update ? "Peminjaman berhasil disetujui." : "Gagal menyetujui: " . mysqli_error($koneksi);
        $_SESSION['message_type'] = $update ? "success" : "danger";
    } elseif ($action === 'ditolak') {

        $result = mysqli_query($koneksi, "SELECT id_buku FROM peminjaman WHERE id_peminjaman = $id_peminjaman");
        $row = mysqli_fetch_assoc($result);
        $id_buku = $row['id_buku'];
    
        $queryUpdate = "UPDATE peminjaman SET status_peminjaman = 'ditolak' WHERE id_peminjaman = $id_peminjaman";
        $update = mysqli_query($koneksi, $queryUpdate);
    
        if ($update) {
            $updateStok = mysqli_query($koneksi, "UPDATE buku SET stok = stok + 1 WHERE id_buku = $id_buku");
    
            if ($updateStok) {
                $_SESSION['message'] = "Peminjaman berhasil ditolak dan stok buku telah ditambahkan.";
                $_SESSION['message_type'] = "warning";
            } else {
                $_SESSION['message'] = "Peminjaman ditolak, tetapi gagal menambahkan stok buku: " . mysqli_error($koneksi);
                $_SESSION['message_type'] = "danger";
            }
        } else {
            $_SESSION['message'] = "Gagal menolak peminjaman: " . mysqli_error($koneksi);
            $_SESSION['message_type'] = "danger";
        }
    }
     

    echo "<script>window.location.href='index.php?page=peminjaman_admin';</script>";
    exit();
}

$query = mysqli_query($koneksi, "
    SELECT p.*, u.nama AS nama_user, b.judul AS judul_buku 
    FROM peminjaman p
    JOIN user u ON p.id_user = u.id_user
    JOIN buku b ON p.id_buku = b.id_buku
    WHERE p.status_peminjaman = 'pending'
");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-3">
        <h1 class="mt-4 fw-bold"><i class="fas fa-clipboard-check me-2"></i>Konfirmasi Peminjaman Buku</h1>

        <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show mt-3" role="alert">
            <?= $_SESSION['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
        <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
        <?php endif; ?>

        <div class="card shadow rounded-4 border-0 mt-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center" id="dataTable">
                        <thead class="table-secondary">
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Judul Buku</th>
                                <th>Tgl. Peminjaman</th>
                                <th>Tgl. Pengembalian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; while ($row = mysqli_fetch_array($query)): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td class="text-start"><?= htmlspecialchars($row['nama_user']) ?></td>
                                <td class="text-start"><?= htmlspecialchars($row['judul_buku']) ?></td>
                                <td><?= date("d M Y", strtotime($row['tanggal_peminjaman'])) ?></td>
                                <td><?= date("d M Y", strtotime($row['tanggal_pengembalian'])) ?></td>
                                <td>
                                    <button class="btn btn-success btn-sm shadow-sm px-3 py-1 me-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalSetujui<?= $row['id_peminjaman'] ?>">
                                        <i class="fas fa-check me-1"></i>Setujui
                                    </button>
                                    <button class="btn btn-danger btn-sm shadow-sm px-3 py-1" data-bs-toggle="modal"
                                        data-bs-target="#modalTolak<?= $row['id_peminjaman'] ?>">
                                        <i class="fas fa-times me-1"></i>Tolak
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalSetujui<?= $row['id_peminjaman'] ?>" tabindex="-1"
                                aria-labelledby="modalSetujuiLabel<?= $row['id_peminjaman'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header bg-success text-white rounded-top-4">
                                            <h5 class="modal-title" id="modalSetujuiLabel<?= $row['id_peminjaman'] ?>">
                                                Konfirmasi
                                                Persetujuan</h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin <strong>menyetujui</strong> peminjaman buku
                                            "<em><?= htmlspecialchars($row['judul_buku']) ?></em>" oleh
                                            <strong><?= htmlspecialchars($row['nama_user']) ?></strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <a href="index.php?page=peminjaman_admin&action=disetujui&id=<?= $row['id_peminjaman'] ?>"
                                                class="btn btn-success">Ya, Setujui</a>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="modalTolak<?= $row['id_peminjaman'] ?>" tabindex="-1"
                                aria-labelledby="modalTolakLabel<?= $row['id_peminjaman'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header bg-danger text-white rounded-top-4">
                                            <h5 class="modal-title" id="modalTolakLabel<?= $row['id_peminjaman'] ?>">
                                                Konfirmasi Penolakan</h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin <strong>menolak</strong> peminjaman buku
                                            "<em><?= htmlspecialchars($row['judul_buku']) ?></em>" oleh
                                            <strong><?= htmlspecialchars($row['nama_user']) ?></strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <a href="index.php?page=peminjaman_admin&action=ditolak&id=<?= $row['id_peminjaman'] ?>"
                                                class="btn btn-danger">Ya, Tolak</a>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>