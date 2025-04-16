<h1 class="mt-4 fw-bold "><i class="fas fa-book-reader me-2"></i>Peminjaman Buku</h1>
<div class="card shadow rounded-4 border-0">
    <div class="card-body">
        <div class="d-flex justify-content-end mb-3">
            <a href="?page=peminjaman_tambah" class="btn btn-dark px-4 py-2 rounded-3 shadow-sm">
                <i class="fa fa-plus me-2"></i>Tambah Peminjaman
            </a>
        </div>
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM peminjaman 
                        LEFT JOIN user ON user.id_user = peminjaman.id_user 
                        LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku 
                        WHERE peminjaman.id_user = " . $_SESSION['user']['id_user']);
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
                        <td>
                            <?php if($data['status_peminjaman'] != 'dikembalikan') { ?>
                            <a href="?page=peminjaman_ubah&&id=<?php echo $data['id_peminjaman']; ?>"
                                class="btn btn-sm btn-primary rounded-pill mb-1">
                                <i class="fas fa-pen-to-square me-1"></i>Ubah
                            </a>
                            <a href="?page=peminjaman_hapus&&id=<?php echo $data['id_peminjaman']; ?>"
                                onclick="return confirm('Apakah anda yakin untuk menghapus data ini?');"
                                class="btn btn-sm btn-danger rounded-pill">
                                <i class="fas fa-trash-alt me-1"></i>Hapus
                            </a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>