<h1 class="mt-4 mb-4 fw-bold text-primary"><i class="fas fa-book me-2"></i>Peminjaman Buku</h1>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4">
        <form method="post">
            <?php
            $id = $_GET['id'];
            if (isset($_POST['submit'])) {
                $id_buku = $_POST['id_buku'];
                $id_user = $_SESSION['user']['id_user'];
                $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
                $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
                $status_peminjaman = $_POST['status_peminjaman'];
                $query = mysqli_query($koneksi, "UPDATE peminjaman set id_buku='$id_buku', tanggal_peminjaman='$tanggal_peminjaman', tanggal_peminjaman='$tanggal_pengembalian', status_peminjaman='$status_peminjaman' WHERE id_peminjaman=$id");

                if ($query) {
                    echo '<div class="alert alert-success">Ubah data berhasil</div>';
                } else {
                    echo '<div class="alert alert-danger">Ubah data gagal</div>';
                }
            }
            $query = mysqli_query($koneksi, "SELECT*FROM peminjaman WHERE id_peminjaman=$id");
            $data = mysqli_fetch_array($query);
            ?>

            <div class="row mb-4">
                <label class="col-md-3 col-form-label fw-semibold">Buku</label>
                <div class="col-md-9">
                    <select class="form-select shadow-sm" name="id_buku">
                        <?php
                        $buk = mysqli_query($koneksi, "SELECT * FROM buku");
                        while ($buku = mysqli_fetch_array($buk)) {
                        ?>
                        <option <?php if ($buku['id_buku'] == $data['id_buku']) echo 'selected'; ?>
                            value="<?php echo $buku['id_buku']; ?>">
                            <?php echo $buku['judul']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mb-4">
                <label class="col-md-3 col-form-label fw-semibold">Tanggal Peminjaman</label>
                <div class="col-md-9">
                    <input type="date" class="form-control shadow-sm" value="<?php echo $data['tanggal_peminjaman']; ?>"
                        name="tanggal_peminjaman">
                </div>
            </div>

            <div class="row mb-4">
                <label class="col-md-3 col-form-label fw-semibold">Tanggal Pengembalian</label>
                <div class="col-md-9">
                    <input type="date" class="form-control shadow-sm"
                        value="<?php echo $data['tanggal_pengembalian']; ?>" name="tanggal_pengembalian">
                </div>
            </div>

            <div class="row mb-4">
                <label class="col-md-3 col-form-label fw-semibold">Status Peminjaman</label>
                <div class="col-md-9">
                    <select name="status_peminjaman" class="form-select shadow-sm">
                        <option value="dipinjam" <?php if($data['status_peminjaman'] == 'dipinjam') echo 'selected'; ?>>
                            Dipinjam</option>
                        <option value="dikembalikan"
                            <?php if($data['status_peminjaman'] == 'dikembalikan') echo 'selected'; ?>>
                            Dikembalikan</option>
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
                    <a href="?page=peminjaman" class="btn btn-danger px-4">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>