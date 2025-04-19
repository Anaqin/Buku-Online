<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "koneksi.php";


if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id_peminjaman = intval($_GET['id']);


    $query = "UPDATE peminjaman SET status_peminjaman = 'ditolak' WHERE id_peminjaman = $id_peminjaman";
    $update = mysqli_query($koneksi, $query);

    if ($update) {
        $_SESSION['message'] = "Peminjaman berhasil ditolak.";
        $_SESSION['message_type'] = "danger";
    } else {
        $_SESSION['message'] = "Gagal menolak peminjaman: " . mysqli_error($koneksi);
        $_SESSION['message_type'] = "danger";
    }


    header("Location: index.php?page=peminjaman_admin");
    exit();
} else {

    $_SESSION['message'] = "ID peminjaman tidak ditemukan.";
    $_SESSION['message_type'] = "warning";
    header("Location: index.php?page=peminjaman_admin");
    exit();
}