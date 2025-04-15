<h1 class="mt-4 fw-bold"><i class="fas fa-book-open-reader me-2"></i>Daftar Buku</h1>
<div class="d-flex justify-content-end mb-3">
    <a href="?page=buku_tambah" class="btn btn-dark px-4 py-2 rounded-3 shadow-sm">
        <i class="fas fa-plus me-2"></i>Tambah Buku
    </a>
</div>
<div class="card shadow rounded-4 border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center" id="dataTable">
                <thead class="table-secondary">
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Deskripsi</th>
                        <th>Sampul</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM buku LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $data['kategori']; ?></td>
                        <td class="text-start"><?php echo $data['judul']; ?></td>
                        <td><?php echo $data['penulis']; ?></td>
                        <td><?php echo $data['penerbit']; ?></td>
                        <td><?php echo $data['tahun_terbit']; ?></td>
                        <td class="text-start"><?php echo $data['deskripsi']; ?></td>
                        <td style="width: 150px;">
                            <?php if ($data['cover']) { ?>
                            <img src="assets/sampul/<?php echo $data['cover']; ?>" alt="Sampul Buku"
                                class="img-fluid rounded shadow-sm" style="height: 150px; object-fit: cover;">
                            <?php } else { ?>
                            <span class="text-muted fst-italic"><i class="fas fa-image me-1"></i>Belum Ada Sampul</span>
                            <?php } ?>
                        </td>
                        <td>
                            <a href="?page=buku_ubah&&id=<?php echo $data['id_buku']; ?>"
                                class="btn btn-sm btn-primary">
                                <i class="fas fa-pen-to-square me-1"></i>Ubah
                            </a>

                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                data-bs-target="#hapusModal<?php echo $data['id_buku']; ?>">
                                <i class="fas fa-trash-alt me-1"></i>Hapus
                            </button>

                            <div class="modal fade" id="hapusModal<?php echo $data['id_buku']; ?>" tabindex="-1"
                                aria-labelledby="hapusModalLabel<?php echo $data['id_buku']; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="hapusModalLabel<?php echo $data['id_buku']; ?>">
                                                <i class="fas fa-triangle-exclamation me-2"></i>Konfirmasi Hapus
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            Apakah kamu yakin ingin menghapus buku
                                            <strong>"<?php echo $data['judul']; ?>"</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary rounded-3"
                                                data-bs-dismiss="modal">Batal</button>
                                            <a href="?page=buku_hapus&&id=<?php echo $data['id_buku']; ?>"
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