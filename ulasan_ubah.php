<h1 class="mt-4 mb-4 fw-bold text-primary"><i class="fas fa-edit me-2"></i>Ubah Ulasan Buku</h1>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4">
        <?php
        $id = $_GET['id'];
        if (isset($_POST['submit'])) {
            $id_buku = $_POST['id_buku'];
            $id_user = $_SESSION['user']['id_user'];
            $ulasan = $_POST['ulasan'];
            $rating = $_POST['rating'];
            $query = mysqli_query($koneksi, "UPDATE ulasan SET id_buku='$id_buku', ulasan='$ulasan', rating='$rating' WHERE id_ulasan=$id");

            if ($query) {
                echo '<div class="alert alert-success">Ubah data berhasil</div>';
            } else {
                echo '<div class="alert alert-danger">Ubah data gagal</div>';
            }
        }

        $query = mysqli_query($koneksi, "SELECT * FROM ulasan WHERE id_ulasan=$id");
        $data = mysqli_fetch_array($query);
        ?>

        <form method="post">
            <div class="row mb-4">
                <label class="col-md-3 col-form-label fw-semibold">Judul Buku</label>
                <div class="col-md-9">
                    <select class="form-select shadow-sm" name="id_buku">
                        <?php
                        $buk = mysqli_query($koneksi, "SELECT * FROM buku");
                        while ($buku = mysqli_fetch_array($buk)) {
                        ?>
                        <option <?php if ($data['id_buku'] == $buku['id_buku']) echo 'selected'; ?>
                            value="<?php echo $buku['id_buku']; ?>">
                            <?php echo $buku['judul']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row mb-4">
                <label class="col-md-3 col-form-label fw-semibold">Ulasan</label>
                <div class="col-md-9">
                    <textarea name="ulasan" rows="4"
                        class="form-control shadow-sm rounded-3"><?php echo $data['ulasan']; ?></textarea>
                </div>
            </div>

            <div class="row mb-4">
                <label class="col-md-3 col-form-label fw-semibold">Rating</label>
                <div class="col-md-9">
                    <select name="rating" class="form-select shadow-sm w-25">
                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                        <option value="<?php echo $i; ?>" <?php if ($data['rating'] == $i) echo 'selected'; ?>>
                            <?php echo $i; ?> ★
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="offset-md-3 col-md-9 d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4" name="submit" value="submit">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                    <button type="reset" class="btn btn-secondary px-4">
                        <i class="fas fa-undo me-1"></i> Reset
                    </button>
                    <a href="?page=ulasan" class="btn btn-danger px-4">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>