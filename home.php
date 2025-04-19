<div class="container py-3">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="fw-bold">Discover</h1>
        </div>
    </div>

    <form method="GET" class="row align-items-center mb-5">
        <input type="hidden" name="page" value="home">
        <div class="col-md-10">
            <input type="text" name="cari" class="form-control" placeholder="Cari buku yang anda sukai!"
                value="<?php echo isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : ''; ?>">
        </div>
        <div class="col-md-2">
            <button class="btn btn-dark w-100"><i class="fas fa-search me-1"></i> Search</button>
        </div>
    </form>

    <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
        <h5 class="fw-semibold">Daftar Buku</h5>
    </div>

    <div class="row g-4 mb-5">
        <?php
        $cari = isset($_GET['cari']) ? mysqli_real_escape_string($koneksi, $_GET['cari']) : '';
        if (!empty($cari)) {
            $query = mysqli_query($koneksi, "SELECT * FROM buku WHERE judul LIKE '%$cari%' ORDER BY id_buku DESC");
        } else {
            $query = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id_buku DESC");
        }

        if (mysqli_num_rows($query) > 0) {
            while ($data = mysqli_fetch_array($query)) {
        ?>
        <div class="col-6 col-md-4 col-lg-3 text-center">
            <?php if (!empty($data['cover'])) { ?>
            <div class="position-relative d-inline-block" style="width: 90%; height: 90%;">
                <?php if ($data['stok'] > 0): ?>
                <a href="?page=buku_detail&&id=<?php echo $data['id_buku']; ?>" class="text-decoration-none text-dark">
                    <img src="assets/sampul/<?php echo $data['cover']; ?>"
                        class="img-fluid rounded shadow-sm hover-shadow"
                        style="width: 100%; height: 100%; object-fit: cover;" alt="<?php echo $data['judul']; ?>">
                </a>
                <?php else: ?>
                <img src="assets/sampul/<?php echo $data['cover']; ?>" class="img-fluid rounded shadow-sm"
                    style="width: 100%; height: 100%; object-fit: cover; filter: grayscale(100%) brightness(0.7);"
                    alt="<?php echo $data['judul']; ?>">
                <div
                    class="position-absolute top-50 start-50 translate-middle text-white bg-dark bg-opacity-75 px-3 py-2 rounded-3 fw-semibold">
                    Stok Habis
                </div>
                <?php endif; ?>
            </div>
            <div class="fw-semibold mt-2"><?php echo $data['judul']; ?></div>
            <?php } else { ?>
            <div class="text-muted text-center fst-italic">Tidak ada sampul</div>
            <?php } ?>
        </div>
        <?php 
            }
        } else {
            echo '<div class="text-center text-muted">Buku tidak ditemukan.</div>';
        }
        ?>
    </div>
</div>