<h1 class=" fw-bold "><i class="fas fa-comments me-2"></i>Ulasan Buku</h1>
<div class="d-flex justify-content-end mb-1">
    <a href="?page=ulasan_tambah" class="btn btn-dark px-4 py-2 rounded-3 shadow-sm">
        <i class="fa fa-plus me-2"></i>Tambah Data
    </a>
</div>
<div class="card shadow rounded-4 border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle text-center" id="dataTable">
                <thead class="table-secondary">
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Judul Buku</th>
                        <th>Sampul</th>
                        <th>Ulasan</th>
                        <th>Rating</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM ulasan 
                        LEFT JOIN user ON user.id_user = ulasan.id_user 
                        LEFT JOIN buku ON buku.id_buku = ulasan.id_buku");
                    while($data = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td class="text-start"><?php echo $data['nama']; ?></td>
                        <td class="text-start"><?php echo $data['judul']; ?></td>
                        <td>
                            <?php if ($data['cover']) { ?>
                            <img src="assets/sampul/<?php echo $data['cover']; ?>" alt="Sampul"
                                style="height: 100px; object-fit: cover; border-radius: 10px;">
                            <?php } else { ?>
                            <span class="text-muted fst-italic">Tidak ada</span>
                            <?php } ?>
                        </td>
                        <td class="text-start"><?php echo $data['ulasan']; ?></td>
                        <td>
                            <?php
                                $rating = intval($data['rating']);
                                for ($j = 1; $j <= 5; $j++) {
                                    echo $j <= $rating
                                        ? '<i class="fas fa-star text-warning"></i>'
                                        : '<i class="far fa-star text-muted"></i>';
                                }
                            ?>
                            <div><small class="text-muted"><?php echo $rating; ?>/5</small></div>
                        </td>
                        <td>
                            <a href="?page=ulasan_ubah&&id=<?php echo $data['id_ulasan']; ?>"
                                class="btn btn-sm btn-primary">
                                <i class="fas fa-pen-to-square me-1"></i>Ubah
                            </a>

                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                data-bs-target="#hapusUlasanModal<?php echo $data['id_ulasan']; ?>">
                                <i class="fas fa-trash-alt me-1"></i>Hapus
                            </button>


                            <div class="modal fade" id="hapusUlasanModal<?php echo $data['id_ulasan']; ?>" tabindex="-1"
                                aria-labelledby="hapusUlasanModalLabel<?php echo $data['id_ulasan']; ?>"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title"
                                                id="hapusUlasanModalLabel<?php echo $data['id_ulasan']; ?>">
                                                <i class="fas fa-triangle-exclamation me-2"></i>Konfirmasi Hapus
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            Apakah kamu yakin ingin menghapus ulasan untuk buku
                                            <strong>"<?php echo $data['judul']; ?>"</strong> oleh
                                            <strong><?php echo $data['nama']; ?></strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary rounded-3"
                                                data-bs-dismiss="modal">Batal</button>
                                            <a href="?page=ulasan_hapus&&id=<?php echo $data['id_ulasan']; ?>"
                                                class="btn btn-danger rounded-3">Ya, Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>