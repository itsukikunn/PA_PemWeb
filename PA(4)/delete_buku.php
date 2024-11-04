<?php
require "koneksi.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_GET['id_buku'])) {
    header("Location: CRUDadmin.php");
    exit;
}

$id_buku = $_GET['id_buku'];

// Update dulu FK_id_buku menjadi null di tabel transaksi status = 2
$query = "UPDATE transaksi SET FK_id_buku = NULL WHERE FK_id_buku = $id_buku AND status_transaksi = 2";
$result = mysqli_query($conn, $query);

// Hapus file terkait buku di folder
$query = "SELECT gambar FROM buku WHERE id_buku = $id_buku";
$result = mysqli_query($conn, $query);
$file_path = "uploads/" . mysqli_fetch_assoc($result)['gambar'];
if (file_exists($file_path)) {
    unlink($file_path);
}


// Hapus data buku di sql
$query = "DELETE FROM buku WHERE id_buku = $id_buku";
if (mysqli_query($conn, $query)) {
    header("Location: CRUDadmin.php");
    exit;
} else {
    echo "Error ";
}

// Hapus transaksi yang terkait
$query = "DELETE FROM transaksi WHERE FK_id_buku = $id_buku and status_transaksi = 0 or status_transaksi = 1";
if (mysqli_query($conn, $query)) {
    header("Location: CRUDadmin.php");
    exit;
} else {
    echo "Error";
}
