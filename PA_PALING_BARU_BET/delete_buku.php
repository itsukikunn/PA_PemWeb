<?php
require "koneksi.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id_buku = mysqli_real_escape_string($conn, $_GET['id_buku']);

// Mulai transaksi database
mysqli_begin_transaction($conn);

// Update FK_id_buku menjadi NULL pada history
$update_history_query = "UPDATE transaksi SET FK_id_buku = NULL 
                       WHERE FK_id_buku = $id_buku AND status_transaksi = 2";
if (!mysqli_query($conn, $update_history_query)) {
    mysqli_rollback($conn);
    echo "<script>
        alert('Gagal mengupdate histori transaksi: " . mysqli_error($conn) . "');
        window.location.href = 'CRUDadmin.php';
    </script>";
    exit;
}

// Hapus transaksi
$delete_transaksi_query = "DELETE FROM transaksi 
                          WHERE FK_id_buku = $id_buku 
                          AND (status_transaksi = 0 OR status_transaksi = 1)";
if (!mysqli_query($conn, $delete_transaksi_query)) {
    mysqli_rollback($conn);
    echo "<script>
        alert('Gagal menghapus transaksi terkait: " . mysqli_error($conn) . "');
        window.location.href = 'CRUDadmin.php';
    </script>";
    exit;
}

// Hapus Gambar di folder
$get_image_query = "SELECT gambar FROM buku WHERE id_buku = $id_buku";
$image_result = mysqli_query($conn, $get_image_query);
if ($image_result && $image_data = mysqli_fetch_assoc($image_result)) {
    if ($image_data['gambar'] && $image_data['gambar'] != 'default.jpg') {
        $file_path = "uploads/" . $image_data['gambar'];
        if (file_exists($file_path)) {
            if (!unlink($file_path)) {
                mysqli_rollback($conn);
                echo "<script>
                    alert('Gagal menghapus file gambar');
                    window.location.href = 'CRUDadmin.php';
                </script>";
                exit;
            }
        }
    }
}

// Hapus data buku
$delete_buku_query = "DELETE FROM buku WHERE id_buku = $id_buku";
if (!mysqli_query($conn, $delete_buku_query)) {
    mysqli_rollback($conn);
    echo "<script>
        alert('Gagal menghapus data buku: " . mysqli_error($conn) . "');
        window.location.href = 'CRUDadmin.php';
    </script>";
    exit;
}
mysqli_commit($conn);

echo "<script>
    alert('Buku berhasil dihapus!');
    window.location.href = 'CRUDadmin.php';
</script>";
