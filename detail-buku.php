<?php
include "koneksi.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID buku tidak ditemukan.";
    exit;
}

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM buku LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori WHERE id_buku = $id");
$data = mysqli_fetch_array($query);

if (!$data) {
    echo "Data buku tidak ditemukan.";
    exit;
}
?>



<h1 class="mt-4 fw-bold"><i class="fas fa-book me-2"></i>Detail Buku</h1>
<div class="card shadow border-0 rounded-4 mt-3">
    <div class="card-body row">
        <div class="col-md-4 text-center">
            <?php if ($data['cover']) { ?>
            <img src="assets/sampul/<?php echo $data['cover']; ?>" class="img-fluid rounded shadow"
                style="height: 300px; object-fit: cover;">
            <?php } else { ?>
            <div class="text-muted"><i class="fas fa-image me-2"></i>Tidak ada sampul</div>
            <?php } ?>
        </div>
        <div class="col-md-8">
            <h3 class="fw-bold"><?php echo $data['judul']; ?></h3>
            <p><strong>Kategori:</strong> <?php echo $data['kategori']; ?></p>
            <p><strong>Penulis:</strong> <?php echo $data['penulis']; ?></p>
            <p><strong>Penerbit:</strong> <?php echo $data['penerbit']; ?></p>
            <p><strong>Tahun:</strong> <?php echo $data['tahun_terbit']; ?></p>
            <p><strong>Deskripsi:</strong><br><?php echo $data['deskripsi']; ?></p>

            <a href="peminjaman.php?id_buku=<?php echo $data['id_buku']; ?>" class="btn btn-success rounded-3 mt-2">
                <i class="fas fa-book-reader me-2"></i>Pinjam Buku Ini
            </a>
        </div>
    </div>
</div>