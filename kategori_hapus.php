<?php
$id = $_GET['id'];

$cek = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_kategori = $id");

if (mysqli_num_rows($cek) > 0) {
    echo "<script>window.location.href='index.php?page=kategori&error=kategori_dipakai';</script>";
    exit;
} else {
    mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori = $id");
    echo "<script>window.location.href='index.php?page=kategori';</script>";
    exit;
}
?>