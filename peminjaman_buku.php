<?php
include "koneksi.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id = intval($_GET['id']);
$query = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku = $id");
$data = mysqli_fetch_array($query);

if (!$data) {
    echo '<div class="alert alert-danger">Buku tidak ditemukan.</div>';
    exit;
}

$success = false;
$error = "";

if (isset($_POST['submit'])) {
    $id_user = $_SESSION['user']['id_user'];
    $id_buku = $_POST['id_buku'];
    $tanggal_peminjaman_input = $_POST['tanggal_peminjaman'];
    $tanggal_pengembalian_input = $_POST['tanggal_pengembalian'];
    $status_peminjaman = 'pending';


    $ts_peminjaman = strtotime($tanggal_peminjaman_input);
    $ts_pengembalian = strtotime($tanggal_pengembalian_input);

    if ($ts_pengembalian > $ts_peminjaman + (5 * 24 * 60 * 60)) {
        $error = "Tanggal pengembalian tidak boleh lebih dari 5 hari setelah tanggal peminjaman.";
    } elseif ($data['stok'] <= 0) {
        $error = "Stok buku tidak mencukupi untuk peminjaman.";
    } else {
        $tanggal_peminjaman = date('Y-m-d', $ts_peminjaman);
        $tanggal_pengembalian = date('Y-m-d', $ts_pengembalian);

        $insert = mysqli_query($koneksi, "INSERT INTO peminjaman (id_buku, id_user, tanggal_peminjaman, tanggal_pengembalian, status_peminjaman)
                                          VALUES ('$id_buku', '$id_user', '$tanggal_peminjaman', '$tanggal_pengembalian', '$status_peminjaman')");

        if ($insert) {
            $new_stok = $data['stok'] - 1;
            $update_stok = mysqli_query($koneksi, "UPDATE buku SET stok = $new_stok WHERE id_buku = $id_buku");

            if ($update_stok) {
                $success = true;
            } else {
                $error = "Gagal mengupdate stok buku.";
            }
        } else {
            $error = "Gagal menyimpan data peminjaman.";
        }
    }
}
?>

<div class="container py-3">
    <h1 class="mt-4 mb-4 fw-bold"><i class="fas fa-book-reader me-2"></i>Peminjaman Buku</h1>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <form method="post">
                <?php if ($success): ?>
                <div class="alert alert-success">Peminjaman berhasil. Menunggu konfirmasi admin.</div>
                <?php elseif (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <div class="row mb-3">
                    <label class="col-md-3 col-form-label fw-semibold">Buku</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" value="<?= htmlspecialchars($data['judul']); ?>"
                            disabled>
                        <input type="hidden" name="id_buku" value="<?= $data['id_buku']; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-md-3 col-form-label fw-semibold">Tanggal Peminjaman</label>
                    <div class="col-md-9">
                        <input type="date" class="form-control" name="tanggal_peminjaman" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-md-3 col-form-label fw-semibold">Tanggal Pengembalian</label>
                    <div class="col-md-9">
                        <input type="date" class="form-control" name="tanggal_pengembalian" required>
                    </div>
                </div>

                <div class="row">
                    <div class="offset-md-3 col-md-9 d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4" name="submit">
                            <i class="fas fa-paper-plane me-1"></i> Pinjam
                        </button>
                        <a href="index.php?page=home" class="btn btn-danger px-4">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.querySelector('[name="tanggal_peminjaman"]').addEventListener('change', function() {
    var peminjaman = new Date(this.value);
    var maxReturnDate = new Date(peminjaman);
    maxReturnDate.setDate(peminjaman.getDate() + 5);

    var returnDateInput = document.querySelector('[name="tanggal_pengembalian"]');
    returnDateInput.setAttribute('min', this.value);
    returnDateInput.setAttribute('max', maxReturnDate.toISOString().split('T')[0]);
});
</script>