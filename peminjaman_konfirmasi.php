<h1 class="mt-4 fw-bold"><i class="fas fa-check-circle me-2"></i>Konfirmasi Peminjaman Buku</h1>
<div class="card shadow rounded-4 border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle text-center" id="dataTable">
                <thead class="table-secondary">
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Judul Buku</th>
                        <th>Tgl Peminjaman</th>
                        <th>Tgl Pengembalian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM peminjaman 
                        JOIN user ON user.id_user = peminjaman.id_user 
                        JOIN buku ON buku.id_buku = peminjaman.id_buku 
                        WHERE peminjaman.status_konfirmasi = 'pending'");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td class="text-start"><?= $data['nama']; ?></td>
                        <td class="text-start"><?= $data['judul']; ?></td>
                        <td><?= date("d M Y", strtotime($data['tanggal_peminjaman'])); ?></td>
                        <td><?= date("d M Y", strtotime($data['tanggal_pengembalian'])); ?></td>
                        <td>
                            <a href="konfirmasi.php?id=<?= $data['id_peminjaman']; ?>&aksi=setuju"
                                class="btn btn-success btn-sm rounded-pill px-3">
                                <i class="fas fa-check me-1"></i>Setujui
                            </a>
                            <a href="konfirmasi.php?id=<?= $data['id_peminjaman']; ?>&aksi=tolak"
                                class="btn btn-danger btn-sm rounded-pill px-3"
                                onclick="return confirm('Tolak peminjaman ini?');">
                                <i class="fas fa-times me-1"></i>Tolak
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>