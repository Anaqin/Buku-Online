<h1 class="mt-2 fw-bold"><i class="fas fa-tags me-2"></i>Kategori Buku</h1>
<div class="d-flex justify-content-end mb-3">
    <a href="?page=kategori_tambah" class="btn btn-dark px-4 py-2 rounded-3 shadow-sm">
        <i class="fas fa-plus me-2"></i>Tambah Kategori
    </a>
</div>
<div class="card shadow rounded-4 border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center" id="dataTableKategori">
                <thead class="table-secondary">
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM kategori");
                    while($data = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td class="text-start"><?php echo $data['kategori']; ?></td>
                        <td>
                            <a href="?page=kategori_ubah&&id=<?php echo $data['id_kategori']; ?>"
                                class="btn btn-sm btn-primary">
                                <i class="fas fa-pen-to-square me-1"></i>Ubah
                            </a>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                data-bs-target="#hapusModal<?php echo $data['id_kategori']; ?>">
                                <i class="fas fa-trash-alt me-1"></i>Hapus
                            </button>

                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="hapusModal<?php echo $data['id_kategori']; ?>" tabindex="-1"
                                aria-labelledby="hapusModalLabel<?php echo $data['id_kategori']; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title"
                                                id="hapusModalLabel<?php echo $data['id_kategori']; ?>">
                                                <i class="fas fa-triangle-exclamation me-2"></i>Konfirmasi Hapus
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            Apakah kamu yakin ingin menghapus kategori
                                            <strong>"<?php echo $data['kategori']; ?>"</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary rounded-3"
                                                data-bs-dismiss="modal">Batal</button>
                                            <a href="?page=kategori_hapus&&id=<?php echo $data['id_kategori']; ?>"
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

<?php if (isset($_GET['error']) && $_GET['error'] === 'kategori_dipakai'): ?>
<!-- Modal error jika kategori sedang dipakai -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="errorModalLabel">
                    <i class="fas fa-circle-exclamation me-2"></i>Kategori Sedang Digunakan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                Kategori ini tidak dapat dihapus karena masih digunakan oleh satu atau lebih buku.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-3" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script>
var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
errorModal.show();
</script>
<?php endif; ?>