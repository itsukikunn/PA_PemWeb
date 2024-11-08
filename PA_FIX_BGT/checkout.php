<?php
require "koneksi.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION["username"])) {
    if(isset($_SESSION['admin'])) {
        $_SESSION['admin'] = true;
    }
    $id_user = $_SESSION["id_user"];
} else {
    header("Location: login.php");
    exit();
}


// Join data buku dan transaksi
$query = "SELECT t.*, b.nama_buku, b.harga_buku 
          FROM transaksi t 
          JOIN buku b ON t.FK_id_buku = b.id_buku 
          WHERE t.FK_id_user = '$id_user' AND t.status_transaksi = 1";
$result = mysqli_query($conn, $query);

$items = [];
$total_harga = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $items[] = $row;
    $total_harga += $row['harga_buku'] * $row['jumlah_transaksi'];
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>
    <link rel="stylesheet" href="styles/checkout.css">  
    <link rel="stylesheet" href="styles/darkmode.css">
</head>

<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <h1>Struk Pembelian</h1>
            <p>Terimakasih Atas Pembelian Anda!</p>
        </div>
        <table class="receipt-items">
            <thead>
                <tr>
                    <th>Nama Buku</th>
                    <th>Harga</th>
                    <th>Kuantitas</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?php echo $item['nama_buku']; ?></td>
                        <td>Rp<?php echo number_format($item['harga_buku'], 0, ',', '.'); ?></td>
                        <td><?php echo $item['jumlah_transaksi']; ?></td>
                        <td>Rp<?php echo number_format($item['harga_buku'] * $item['jumlah_transaksi'], 0, ',', '.'); ?></td>
                    </tr>
                    <?php 
                        $query = "UPDATE buku SET stok_buku = stok_buku - " . $item['jumlah_transaksi'] . " WHERE id_buku = " . $item['FK_id_buku'];
                        mysqli_query($conn, $query);
                        // Ubah status 1 -> 2
                        $query = 'UPDATE transaksi SET tanggal = NOW(), status_transaksi = 2 WHERE FK_id_user = ' . $id_user . ' AND status_transaksi = 1';
                        mysqli_query($conn, $query);    
                        endforeach
                    ?>
            </tbody>
        </table>
        <div class="receipt-total">
            Total: Rp<?php echo number_format($total_harga, 0, ',', '.'); ?>
        </div>
    </div>
    <!-- Navigasi Home, Lihat History -->
    <div class="nav">
        <a href="index.php">Home</a>
        <a href="history.php">Histori</a>
    </div>
    <script src="scripts/darkmode.js"></script>
</body>

</html>
