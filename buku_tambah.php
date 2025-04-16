<h1 class="mt-4 mb-4 fw-bold "><i class="fas fa-book me-2"></i>Buku</h1>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4">
        <form method="post" enctype="multipart/form-data">

            <?php
            if (isset($_POST['submit'])) {

                $id_kategori = $_POST['id_kategori'];
                $judul = $_POST['judul'];
                $penulis = $_POST['penulis'];
                $penerbit = $_POST['penerbit'];
                $tahun_terbit = $_POST['tahun_terbit'];
                $deskripsi = $_POST['deskripsi'];
                
                if (isset($_FILES['cover']) && $_FILES['cover']['error'] == 0) {
                    $file_name = $_FILES['cover']['name'];
                    $file_tmp = $_FILES['cover']['tmp_name'];
                    $file_size = $_FILES['cover']['size'];
                    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

                    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

                    if (in_array($file_ext, $allowed_ext)) {

                        $upload_dir = 'assets/sampul/';
                        $new_file_name = uniqid() . '.' . $file_ext;
                        $upload_path = $upload_dir . $new_file_name;

                        if (move_uploaded_file($file_tmp, $upload_path)) {

                            $query = mysqli_query($koneksi, "INSERT INTO buku(id_kategori,judul,penulis,penerbit,tahun_terbit,deskripsi,cover) 
                            values ('$id_kategori','$judul','$penulis','$penerbit','$tahun_terbit','$deskripsi','$new_file_name')");
                            
                            if ($query) {
                                echo '<div class="alert alert-success">Tambah data berhasil</div>';
                            } else {
                                echo '<div class="alert alert-danger">Tambah data gagal</div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger">Gagal mengunggah gambar!</div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger">Ekstensi file tidak diperbolehkan!</div>';
                    }
                }
            }
            ?>

            <div class="row mb-4">
                <label class="col-md-3 col-form-label fw-semibold">Kategori</label>
                <div class="col-md-9">
                    <select class="form-select shadow-sm" name="id_kategori" style="width: 50%">
                        <?php
                        $kat = mysqli_query($koneksi, "SELECT * FROM kategori");
                        while ($kategori = mysqli_fetch_array($kat)) {
                        ?>
                        <option value="<?php echo $kategori['id_kategori']; ?>">
                            <?php echo $kategori['kategori']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mb-4">
                <label class="col-md-3 col-form-label fw-semibold">Judul</label>
                <div class="col-md-9">
                    <input type="text" name="judul" class="form-control shadow-sm" style="width: 50%">
                </div>
            </div>

            <div class="row mb-4">
                <label class="col-md-3 col-form-label fw-semibold">Penulis</label>
                <div class="col-md-9">
                    <input type="text" name="penulis" class="form-control shadow-sm" style="width: 50%">
                </div>
            </div>

            <div class="row mb-4">
                <label class="col-md-3 col-form-label fw-semibold">Penerbit</label>
                <div class="col-md-9">
                    <input type="text" name="penerbit" class="form-control shadow-sm" style="width: 50%">
                </div>
            </div>

            <div class="row mb-4">
                <label class="col-md-3 col-form-label fw-semibold">Tahun Terbit</label>
                <div class="col-md-9">
                    <input type="number" name="tahun_terbit" class="form-control shadow-sm" style="width: 50%">
                </div>
            </div>

            <div class="row mb-4">
                <label class="col-md-3 col-form-label fw-semibold">Deskripsi</label>
                <div class="col-md-9">
                    <textarea name="deskripsi" rows="5" class="form-control shadow-sm" style="width: 50%"></textarea>
                </div>
            </div>

            <div class="row mb-4">
                <label class="col-md-3 col-form-label fw-semibold ">Sampul Buku</label>
                <div class="col-md-9">
                    <input type="file" name="cover" class="form-control shadow-sm" style="width: 50%" accept="image/*"
                        required>
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
                    <a href="?page=buku" class="btn btn-danger px-4">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>