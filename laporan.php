<h1 class="mt-4 fw-bold "><i class="fas fa-file-alt me-2"></i>Laporan Peminjaman Buku</h1>
<div class="d-flex justify-content-end mb-3">
    <a href="cetak.php" class="btn btn-dark px-4 py-2 rounded-3 shadow-sm">
        <i class="fa fa-print me-2"></i>Cetak Data
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
                        <th>Buku</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status Peminjaman</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM peminjaman 
                        LEFT JOIN user ON user.id_user = peminjaman.id_user 
                        LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku");
                    while($data = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td class="text-start"><?php echo $data['nama']; ?></td>
                        <td class="text-start"><?php echo $data['judul']; ?></td>
                        <td><?php echo date("d M Y", strtotime($data['tanggal_peminjaman'])); ?></td>
                        <td><?php echo date("d M Y", strtotime($data['tanggal_pengembalian'])); ?></td>
                        <td>
                            <?php if($data['status_peminjaman'] == 'dipinjam') { ?>
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                <i class="fas fa-hourglass-half me-1"></i>Dipinjam
                            </span>
                            <?php } else { ?>
                            <span class="badge bg-success px-3 py-2 rounded-pill">
                                <i class="fas fa-check-circle me-1"></i>Dikembalikan
                            </span>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>