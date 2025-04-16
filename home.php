<div class="container py-3">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="fw-bold">Discover</h1>
        </div>
    </div>

    <div class="row align-items-center mb-5">
        <div class="col-md-4">
            <select class="form-select">
                <option>All Categories</option>
                <option>Business</option>
                <option>Self Improvement</option>
                <option>Design</option>
            </select>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Find the book you like...">
        </div>
        <div class="col-md-2">
            <button class="btn btn-dark w-100"><i class="fas fa-search me-1"></i> Search</button>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-semibold">Rekomendasi Buku</h5>
        <a href="#" class="btn btn-sm btn-outline-secondary">View all <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="row row-cols-1 row-cols-md-5 g-4 mb-5">
        <?php
    $query = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id_buku DESC LIMIT 5");
    while ($data = mysqli_fetch_array($query)) {
    ?>
        <div class="col text-center">
            <?php if (!empty($data['cover'])) { ?>
            <a href="detail-buku.php?id=<?php echo $data['id_buku']; ?>" class="text-decoration-none text-dark">
                <img src="assets/sampul/<?php echo $data['cover']; ?>"
                    class="img-fluid rounded shadow-sm mb-2 hover-shadow" style="height: 100%; width: 100%;"
                    alt="<?php echo $data['judul']; ?>">
                <div class="fw-semibold mt-2"><?php echo $data['judul']; ?></div>
            </a>
            <?php } else { ?>
            <div class="text-muted text-center fst-italic">Tidak ada sampul</div>
            <?php } ?>
        </div>
        <?php } ?>
    </div>


    <h5 class="fw-semibold mb-3">Kategori Buku</h5>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-5 g-4">
        <div class="col text-center">
            <a href="kategori.php?nama=Adventure" class="text-decoration-none text-dark">
                <img src="assets/sampul/buku6.jpeg" class="img-fluid rounded shadow-sm mb-2 hover-shadow"
                    alt="Adventure">
                <div class="fw-semibold">Adventure</div>
            </a>
        </div>
        <div class="col text-center">
            <a href="kategori.php?nama=Horor" class="text-decoration-none text-dark">
                <img src="assets/sampul/buku7.jpeg" class="img-fluid rounded shadow-sm mb-2 hover-shadow" alt="Horor">
                <div class="fw-semibold">Horor</div>
            </a>
        </div>
        <div class="col text-center">
            <a href="kategori.php?nama=Fiksi" class="text-decoration-none text-dark">
                <img src="assets/sampul/buku8.jpeg" class="img-fluid rounded shadow-sm mb-2 hover-shadow" alt="Fiksi">
                <div class="fw-semibold">Fiksi</div>
            </a>
        </div>
        <div class="col text-center">
            <a href="kategori.php?nama=Romance" class="text-decoration-none text-dark">
                <img src="assets/sampul/buku9.jpeg" class="img-fluid rounded shadow-sm mb-2 hover-shadow" alt="Romance">
                <div class="fw-semibold">Romance</div>
            </a>
        </div>
    </div>
</div>