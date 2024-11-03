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
}
$id_user = $_SESSION['id_user'];
$image_dir = "uploads/";

// Join transaksi dan buku
$history = [];
$query = "SELECT t.*, b.nama_buku, b.harga_buku, b.gambar 
          FROM transaksi t 
          JOIN buku b ON t.FK_id_buku = b.id_buku 
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
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="history.php">Histori</a>
        <a href="keranjang.php">Keranjang</a>
    </div>

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
                                <img src="<?php echo $image_dir . $item['gambar']; ?>" alt="gambar">
                            </a>
                        </div>
                        <div class="detail-history">
                            <h3><?php echo $item['nama_buku']; ?></h3>
                            <p>Rp<?php echo number_format($item['harga_buku'], 0, ',', '.'); ?></p>
                            <p>Kuantitas: <?php echo $item['jumlah_transaksi']; ?></p>
                            <b><p>Total: Rp<?php echo number_format($item['jumlah_transaksi'] * $item['harga_buku'], 0, ',', '.'); ?></p></b>
                            <p>Tanggal Transaksi: <?php echo $item['tanggal']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</body>

</html>