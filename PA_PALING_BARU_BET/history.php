<?php
require "koneksi.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    echo "<script>
    alert('Anda harus login terlebih dahulu')
    window.location.href='login.php'
    </script>";
    exit();
} else if (isset($_SESSION['admin'])){
    if ($_SESSION["admin"] == true) {
        echo "<script>
        window.location.href='CRUDadmin.php';
        </script>";
    }
}
$temp_user = $_SESSION['username'];
$query = "SELECT id_user FROM user WHERE username = '$temp_user'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$id_user = $row["id_user"];

$image_dir = "uploads/";


// SELECT t.*, b.nama_buku, b.harga_buku, b.gambar 
// LEFT JOIN buku b ON t.FK_id_buku = b.id_buku 
// Join transaksi dan buku
$history = [];
$query = "SELECT t.*, b.nama_buku, b.harga_buku, b.gambar 
          FROM transaksi t 
          LEFT JOIN buku b ON t.FK_id_buku = b.id_buku 
          WHERE t.FK_id_user = '$id_user' 
          AND t.status_transaksi = 2 
          ORDER BY t.tanggal DESC";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $history[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="styles/history.css">

</head>

<body>
    <?php include "navbar.php"; ?>

    <div class="judul">
        <h1>Histori Pembelian</h1>
    </div>

    <section class="isi-halaman">
        <div class="list-history">
            <?php if (empty($history)): ?>
                <p>Tidak Ada Histori Pembelian.</p>
            <?php else: ?>
                <?php foreach ($history as $item): ?>
                    <div class="item-history">
                        <div class="gambar-history">
                            <a href="detail_buku.php?id_buku=<?php echo $item['FK_id_buku']; ?>">
                                <img src="<?php echo $image_dir . $item['gambar']; ?>" alt="Buku sudah tidak tersedia">
                            </a>
                        </div>
                        <div class="detail-history">
                            <!-- Judul Buku -->
                            <h3><?php if ($item["FK_id_buku"] == null) {
                                    echo "Buku sudah tidak tersedia";
                                } else {
                                    echo $item['nama_buku'];
                                }
                                ?></h3>
                            <!-- Harga Buku -->
                            <p>
                                <?php
                                if ($item['FK_id_buku'] == null) {
                                    echo "";
                                } else {
                                    echo "Rp" . number_format($item['harga_buku'], 0, ',', '.');
                                }
                                ?>
                            </p>
                            <!-- Kuantitas -->
                            <p>Kuantitas: <?php echo $item['jumlah_transaksi']; ?></p>
                            <!-- Total Harga -->
                            <b>
                                <?php
                                if ($item['FK_id_buku'] == null) {
                                    echo '';
                                } else {
                                    echo "<p>Total: Rp" . number_format($item['jumlah_transaksi'] * $item['harga_buku'], 0, ',', '.') . "</p>";
                                }
                                ?>
                            </b>
                            <p>Tanggal Transaksi: <?php echo $item['tanggal']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>
