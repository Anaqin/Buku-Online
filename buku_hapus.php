<?php
$id = $_GET['id'];

$cek = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id_buku = $id");

if (mysqli_num_rows($cek) > 0) {
    echo "<script>window.location.href='index.php?page=buku&error=buku_dipinjam';</script>";
} else {
    mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku = $id");
    echo "<script>window.location.href='index.php?page=buku';</script>";
}
?>