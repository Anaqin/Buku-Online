<div class="container">
    <h1 class="mt-4 mb-4 fw-bold"><i class="fas fa-pen-to-square me-2"></i>Ubah Buku</h1>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <form method="post">
                <?php
                $id = $_GET['id'];
                
                // Check if the form is submitted
                if (isset($_POST['submit'])) {
                    // Get form values
                    $id_kategori = $_POST['id_kategori'];
                    $judul = $_POST['judul'];
                    $penulis = $_POST['penulis'];
                    $penerbit = $_POST['penerbit'];
                    $tahun_terbit = $_POST['tahun_terbit'];
                    $deskripsi = $_POST['deskripsi'];
                    $stok = $_POST['stok'];  // Menambahkan stok

                    // Run update query
                    $query = mysqli_query($koneksi, "UPDATE buku SET 
                        id_kategori='$id_kategori', 
                        judul='$judul', 
                        penulis='$penulis', 
                        penerbit='$penerbit', 
                        tahun_terbit='$tahun_terbit', 
                        deskripsi='$deskripsi',
                        stok='$stok'  -- Update stok
                        WHERE id_buku=$id");

                    // Check if the update is successful
                    if ($query) {
                        echo '<div class="alert alert-success">Ubah data berhasil</div>';
                    } else {
                        echo '<div class="alert alert-danger">Ubah data gagal</div>';
                    }
                }

                // Retrieve the current book data
                $query = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku=$id");
                $data = mysqli_fetch_array($query);
                ?>

                <!-- Form Fields -->
                <div class="row mb-4">
                    <label class="col-md-3 col-form-label fw-semibold">Kategori</label>
                    <div class="col-md-9">
                        <select class="form-select shadow-sm" name="id_kategori" style="width: 50%">
                            <?php
                            $kat = mysqli_query($koneksi, "SELECT * FROM kategori");
                            while ($kategori = mysqli_fetch_array($kat)) {
                            ?>
                            <option value="<?= $kategori['id_kategori']; ?>"
                                <?= ($kategori['id_kategori'] == $data['id_kategori']) ? 'selected' : ''; ?>>
                                <?= $kategori['kategori']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <label class="col-md-3 col-form-label fw-semibold">Judul</label>
                    <div class="col-md-9">
                        <input type="text" name="judul" value="<?= $data['judul']; ?>" class="form-control shadow-sm"
                            style="width: 50%">
                    </div>
                </div>

                <div class="row mb-4">
                    <label class="col-md-3 col-form-label fw-semibold">Penulis</label>
                    <div class="col-md-9">
                        <input type="text" name="penulis" value="<?= $data['penulis']; ?>"
                            class="form-control shadow-sm" style="width: 50%">
                    </div>
                </div>

                <div class="row mb-4">
                    <label class="col-md-3 col-form-label fw-semibold">Penerbit</label>
                    <div class="col-md-9">
                        <input type="text" name="penerbit" value="<?= $data['penerbit']; ?>"
                            class="form-control shadow-sm" style="width: 50%">
                    </div>
                </div>

                <div class="row mb-4">
                    <label class="col-md-3 col-form-label fw-semibold">Tahun Terbit</label>
                    <div class="col-md-9">
                        <input type="number" name="tahun_terbit" value="<?= $data['tahun_terbit']; ?>"
                            class="form-control shadow-sm" style="width: 50%">
                    </div>
                </div>

                <div class="row mb-4">
                    <label class="col-md-3 col-form-label fw-semibold">Deskripsi</label>
                    <div class="col-md-9">
                        <textarea name="deskripsi" rows="5" class="form-control shadow-sm"
                            style="width: 50%"><?= $data['deskripsi']; ?></textarea>
                    </div>
                </div>

                <div class="row mb-4">
                    <label class="col-md-3 col-form-label fw-semibold">Stok</label>
                    <div class="col-md-9">
                        <input type="number" name="stok" value="<?= $data['stok']; ?>" class="form-control shadow-sm"
                            style="width: 50%" required>
                    </div>
                </div>

                <div class="row">
                    <div class="offset-md-3 col-md-9 d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4" name="submit" value="submit">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>
                        <a href="?page=buku" class="btn btn-danger px-4">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>