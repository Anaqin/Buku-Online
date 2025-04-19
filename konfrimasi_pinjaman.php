<?php
include "koneksi.php";

if ($_SESSION['user']['level'] != 'admin') {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id_peminjaman = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action == 'approve') {
        $status = 'disetujui';
    } elseif ($action == 'reject') {
        $status = 'ditolak';
    } else {
        echo "Aksi tidak valid.";
        exit();
    }

    $query = mysqli_query($koneksi, "UPDATE peminjaman SET status_peminjaman = '$status' WHERE id_peminjaman = $id_peminjaman");

    if ($query) {
        header("Location: index.php?page=peminjaman_admin");
        exit();
    } else {
        echo "Gagal mengupdate status peminjaman.";
    }
} else {
    echo "ID atau aksi tidak valid.";
}