<div class="container py-3">
    <h1 class="mt-4 mb-4 fw-bold"><i class="fas fa-layer-group me-2"></i>Tambah Kategori Buku</h1>
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <form method="post">
                <?php
                if (isset($_POST['submit'])) {
                    $kategori = $_POST['kategori'];
                    $query = mysqli_query($koneksi, "INSERT INTO kategori(kategori) VALUES('$kategori')");
    
                    if ($query) {
                        echo '<div class="alert alert-success">Tambah data berhasil</div>';
                    } else {
                        echo '<div class="alert alert-danger">Tambah data gagal</div>';
                    }
                }
                ?>

                <div class="row mb-4">
                    <label class="col-md-3 col-form-label fw-semibold">Nama Kategori</label>
                    <div class="col-md-9">
                        <input type="text" name="kategori" class="form-control shadow-sm" style="width: 50%" required>
                    </div>
                </div>

                <div class="row">
                    <div class="offset-md-3 col-md-9 d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4" name="submit" value="submit">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>
                        <a href="?page=kategori" class="btn btn-danger px-4">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>