<?php
require "koneksi.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET["id_buku"])) {
    $id_buku = $_GET["id_buku"];
} else {
    echo "<script>alert('Buku tidak ditemukan')</script>";
    header("Location: index.html");
}

// Cari ID User berdasarkan username
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $query = "SELECT id_user FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $id_user = $row["id_user"];
        $_SESSION["id_user"] = $id_user;
    }
}

$image_dir = "uploads/";
$query = "SELECT * FROM buku WHERE id_buku = $id_buku";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) != 1) {
    echo "<script>alert('Buku tidak ditemukan')</script>";
    header("Location: index.html");
}

while ($row = mysqli_fetch_assoc($result)) {
    $id_buku = $row["id_buku"];
    $nama_buku = $row["nama_buku"];
    $penulis = $row["penulis"];
    $deskripsi = $row["deskripsi"];
    $kategori = $row["kategori_buku"];
    $stok = $row["stok_buku"];
    $harga = $row["harga_buku"];
    $path_gambar = $row["gambar"];
}

// Rekomendasi buku lainnya dengan kategori yang sama
$buku_acak = [];
$query = "SELECT * FROM buku WHERE kategori_buku = '$kategori' AND id_buku != $id_buku ORDER BY RAND() LIMIT 5";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $buku_acak[] = $row;
}
// Jika rekomendasi masih kurang dari 5
if (count($buku_acak) <= 5) {
    $limit = 5 - count($buku_acak);
    $query = "SELECT * FROM buku WHERE id_buku != $id_buku AND kategori_buku != '$kategori' ORDER BY RAND() LIMIT $limit";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $buku_acak[] = $row;
    }
}

if (isset($_POST["tambah_keranjang"])) {
    if (!isset($_SESSION["username"])) {
        echo "<script>alert('Silahkan login terlebih dahulu'); 
        window.location.href='login.php';
        </script>";
    }

    $id_buku = $_POST["id_buku"];
    $jumlah_transaksi = 1;
    $status_transaksi = 0;

    // Cek apakah buku sudah ada di keranjang
    $query = "SELECT * FROM transaksi WHERE FK_id_user = $id_user AND FK_id_buku = $id_buku AND status_transaksi = 0";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $query = "UPDATE transaksi SET jumlah_transaksi = jumlah_transaksi + 1 WHERE FK_id_user = $id_user AND FK_id_buku = $id_buku AND status_transaksi = 0";
        $result = mysqli_query($conn, $query);
        echo "<script>alert('Buku sudah ada pada keranjang'); 
        window.location.href='keranjang.php';</script>";
    }
    // Tambahkan pesanan baru di keranjang
    else {
        $query = "INSERT INTO transaksi(id_transaksi, jumlah_transaksi, status_transaksi, FK_id_user, FK_id_buku) VALUES ('',$jumlah_transaksi, '$status_transaksi', $id_user, $id_buku)";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "<script>
            alert('Berhasil menambahkan ke keranjang');
            window.location.href='keranjang.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan ke keranjang')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <title>Detail Buku</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/detail.css">

</head>

<body>
    <div class="navbar">
        <!-- vardump session -->
        Cek Session: (<?php var_dump($_SESSION); ?>)
        <a href="index.html">Home</a>
        <a href="history.php">Histori</a>
        <a href="keranjang.php">Keranjang</a>
    </div>

    <section class="detail-buku">
        <div class="image-container">
            <img src="<?php echo $image_dir . $path_gambar; ?>" alt="gambar buku">
        </div>
        <div class="detail-container">
            <h2 class="penulis"><?php echo $penulis; ?></h2>
            <h1 class="judul"><?php echo $nama_buku; ?></h1>
            <h1 class="harga">Rp<?php echo number_format($harga, 0, ',', '.'); ?></h1>

            <h3 class="judul-deskripsi">Deskripsi:</h3>
            <div class="isi-deskripsi">
                <p><?php echo $deskripsi; ?></p>
            </div>
            <button class="selengkapnya">Baca Selengkapnya</button>
            <p><b>Kategori:</b> <?php echo $kategori; ?></p>
            <p><b>Stok:</b> <?php echo $stok; ?></p>

            <form action="" method="POST" style="margin-top: 1.5rem;">
                <input type="hidden" name="id_buku" value="<?php echo $id_buku; ?>">
                <input type="hidden" name="jumlah_transaksi" value=1>
                <button name="tambah_keranjang" type="submit">+ Keranjang</button>
            </form>
        </div>
    </section>

    <section class="rekomendasi">
        <h1>Rekomendasi Lainnya: </h1>
        <section class="buku-lainnya">
            <!-- Card Sekumpulan rekomendasi buku lainnya -->
            <div class="buku-container">
                <?php foreach ($buku_acak as $buku) : ?>
                    <!-- Hidden form -->
                    <form action="" method="GET">
                        <input type="hidden" name="id_buku" value="<?php echo $buku["id_buku"]; ?>">
                        <button class="tombol-rekomendasi" name="tombol-rekomendasi" type="submit">
                            <div class="buku-card">
                                <div class="card-image">
                                    <img src="<?php echo $image_dir . $buku["gambar"]; ?>" alt="gambar buku">
                                </div>
                                <p class="penulis"><?php echo $buku["penulis"]; ?></p>
                                <h5><?php echo $buku["nama_buku"]; ?></h5>
                                <p><b>Rp<?php echo number_format($buku["harga_buku"], 0, ',', '.'); ?></b></p>
                            </div>
                        </button>
                    <?php endforeach; ?>
            </div>
        </section>
    </section>

    <script src="scripts/detail.js"></script>
</body>

</html>