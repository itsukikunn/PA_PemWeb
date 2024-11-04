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
$query = "DELETE FROM buku WHERE id_buku = $id_buku";

if (mysqli_query($conn, $query)) {
    header("Location: CRUDadmin.php");
    exit;
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
