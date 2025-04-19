<?php
include "koneksi.php";

if (!isset($_GET['id'])) {
    echo "ID buku tidak ditemukan.";
    exit;
}

$id = intval($_GET['id']); 
$query = mysqli_query($koneksi, "SELECT * FROM buku 
    LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori 
    WHERE id_buku = $id");

$data = mysqli_fetch_array($query);

if (!$data) {
    echo "Data buku tidak ditemukan.";
    exit;
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?php echo $data['judul']; ?> - Buku Online</title>
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-light">

    <div class="container py-3">
        <nav class="mb-4">
            <div>
                <a href="index.php" class="text-decoration-none text-secondary">Home</a> &gt;
                <?php echo substr($data['judul'], 0, 30); ?>.
            </div>
        </nav>

        <div class="row g-5">
            <div class="col-md-4">
                <?php if ($data['cover']) { ?>
                <img src="assets/sampul/<?php echo $data['cover']; ?>" class="img-fluid rounded shadow-sm w-100"
                    style="object-fit: cover;">
                <?php } else { ?>
                <div class="border rounded p-5 text-muted d-flex align-items-center justify-content-center"
                    style="height: 400px;">
                    <i class="fas fa-image fa-2x me-2"></i> Tidak ada sampul
                </div>
                <?php } ?>
            </div>

            <div class="col-md-8">
                <h5 class="text-muted mt-4"><?php echo $data['penulis']; ?></h5>
                <h2 class="fw-bold"><?php echo $data['judul']; ?></h2>


                <div class="mt-4">
                    <h5 class="fw-bold mb-3">Deskripsi</h5>
                    <p class="text-justify"><?php echo nl2br($data['deskripsi']); ?></p>
                </div>

                <div class="mt-4">
                    <h5 class="fw-bold mb-3">Detail Buku</h5>
                    <div class="row">
                        <div class="col-4">
                            <p><strong>Penerbit:</strong><br><?php echo $data['penerbit']; ?></p>
                        </div>
                        <div class="col-4">
                            <p><strong>Tahun
                                    Terbit:</strong><br><?php echo date('Y', strtotime($data['tahun_terbit'])); ?></p>
                        </div>
                        <div class="col-4">
                            <p><strong>kategori:</strong><br><?php echo $data['kategori']; ?></p>
                        </div>
                    </div>
                </div>

                <div class="mt-2">
                    <a href="?page=peminjaman_buku&&id=<?php echo $data['id_buku']; ?>"
                        class="btn btn-dark rounded-pill px-4 py-2 ">
                        <i class=" "></i> Pinjam Sekarang
                    </a>
                </div>


            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>