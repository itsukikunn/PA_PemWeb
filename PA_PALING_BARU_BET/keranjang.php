<?php
require "koneksi.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $query = "SELECT id_user FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $_SESSION['id_user'] = $row['id_user'];
} else {
    echo "<script>
    alert('Anda harus login terlebih dahulu')
    window.location.href='login.php'
    </script>";
}

$image_dir = "uploads/";

// Penghapusan
if (isset($_POST['delete_item'])) {
    $id_transaksi = $_POST['delete_item'];
    $query = "DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi' AND FK_id_user = '" . $_SESSION['id_user'] . "'";
    mysqli_query($conn, $query);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Update Kuantitas
if (isset($_POST['update_quantity'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $new_quantity = $_POST['quantity'];
    if ($new_quantity >= 1 && $new_quantity <= 99) {
        $query = "UPDATE transaksi SET jumlah_transaksi = '$new_quantity' 
                  WHERE id_transaksi = '$id_transaksi' AND FK_id_user = '" . $_SESSION['id_user'] . "'";
        mysqli_query($conn, $query);
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Centang Checkbox
if (isset($_POST['update_status'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $new_status = $_POST['is_checked'] === 'true' ? 1 : 0;
    $query = "UPDATE transaksi SET status_transaksi = '$new_status' 
              WHERE id_transaksi = '$id_transaksi' AND FK_id_user = '" . $_SESSION['id_user'] . "'";
    mysqli_query($conn, $query);
    exit();
}

// Item Keranjang (Status 0 & 1)
$keranjang = [];
$query = "SELECT t.*, b.nama_buku, b.harga_buku, b.gambar 
          FROM transaksi t 
          JOIN buku b ON t.FK_id_buku = b.id_buku 
          WHERE t.FK_id_user = '" . $_SESSION['id_user'] . "' 
          AND t.status_transaksi < 2 
          ORDER BY t.id_transaksi ASC";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $keranjang[] = $row;
}
?>

<html>

<head>
    <title>Keranjang</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="styles/keranjang.css">
</head>

<body>
    <?php include 'navbar.php' ?>

    <div class="judul">
        <h1>Keranjang</h1>
    </div>

    <section class="isi-halaman">
        <div class="form-keranjang">
            <div class="isi-kiri">
                <div class="list-keranjang">
                    <?php
                    foreach ($keranjang as $item):
                        $query = "SELECT stok_buku FROM buku WHERE id_buku = " . $item['FK_id_buku'];
                        $result = mysqli_query($conn, $query);
                        $stokbuku = mysqli_fetch_array($result);
                    ?>
                        <div class="item-keranjang
                        <?php if ($stokbuku['stok_buku'] <= 0) {
                            echo 'red disabled';
                        } ?>"
                            data-harga="<?php echo $item['harga_buku']; ?>">
                            <div class="container-pilih">
                                <input class="pilih item-checkbox" type="checkbox"
                                    value="<?php echo $item['id_transaksi']; ?>"
                                    <?php
                                    if ($stokbuku['stok_buku'] <= 0) {
                                        echo 'disabled';
                                        $query = "UPDATE transaksi SET status_transaksi = 0 
                                                  WHERE id_transaksi = '" . $item['id_transaksi'] . "' 
                                                  AND FK_id_user = '" . $_SESSION['id_user'] . "'";
                                        mysqli_query($conn, $query);
                                    } else {
                                        echo $item['status_transaksi'] == 1 ? 'checked' : '';
                                    }
                                    ?>
                                    onchange="updateItemStatus(this)">
                            </div>
                            <div class="data-list">
                                <div class="gambar-keranjang">
                                    <a href="detail_buku.php?id_buku=<?php echo $item['FK_id_buku']; ?>">
                                        <img src="<?php echo $image_dir . $item['gambar']; ?>" alt="gambar">
                                    </a>
                                </div>
                                <div class="detail-keranjang">
                                    <h3><?php echo $item['nama_buku']; ?></h3>
                                    <p>Rp<?php echo number_format($item['harga_buku'], 0, ',', '.'); ?></p>
                                    <p>Stok: <?php echo $stokbuku['stok_buku']; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="aksi">
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="delete_item" value="<?php echo $item['id_transaksi']; ?>">
                                    <button type="submit" class="hapus">
                                        <img src="uploads/trashcan.png" alt="hapus">
                                    </button>
                                </form>
                                <form method="POST" class="quantity-form" style="display: inline-flex; align-items: center;">
                                    <input type="hidden" name="update_quantity" value="1">
                                    <input type="hidden" name="id_transaksi" value="<?php echo $item['id_transaksi']; ?>">
                                    <button type="button" class="tombol-aksi kurangi" onclick="updateJumlah(this, -1)">-</button>
                                    <div class="jumlah-item">
                                        <input type="number" name="quantity"
                                            value="<?php
                                                    if ($item['jumlah_transaksi'] >= $stokbuku['stok_buku']) {
                                                        echo $stokbuku['stok_buku'];
                                                    } else {
                                                        echo $item['jumlah_transaksi'];
                                                    } ?>"
                                            min="0" max="<?php echo $stokbuku['stok_buku']; ?>"
                                            onchange="this.form.submit()"
                                            style="width: 30px; text-align: center;">
                                    </div>
                                    <button type="button" class="tombol-aksi tambah" onclick="updateJumlah(this, 
                                    <?php
                                    if ($item['jumlah_transaksi'] >= $stokbuku['stok_buku']) {
                                        echo 0;
                                    } else {
                                        echo 1;
                                    }
                                    ?>

                                    )">+</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="isi-kanan">
                <form action="checkout.php" method="POST" id="checkoutForm">
                    <h3>Ringkasan Keranjang</h3>
                    <div class="jumlah-barang">
                        <p>Jumlah Buku</p>
                        <p id="totalItems">0</p>
                    </div>
                    <hr>
                    <div class="total-harga">
                        <h2>Total Harga</h2>
                        <p id="totalHarga">Rp0</p>
                    </div>
                    <button type="submit" class="checkout" name="checkoutButton" id="checkoutButton">Checkout</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Script -->
    <script>
        function updateJumlah(button, change) {
            const form = button.closest('form');
            const input = form.querySelector('input[name="quantity"]');
            const newValue = parseInt(input.value) + change;
            if (newValue >= 0) {
                input.value = newValue;
                form.submit();
            }

        }

        function updateItemStatus(checkbox) {
            const id_transaksi = checkbox.value;
            const isChecked = checkbox.checked;

            // Update SQL (Explain)
            fetch('<?php echo $_SERVER['PHP_SELF']; ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `update_status=1&id_transaksi=${id_transaksi}&is_checked=${isChecked}`
            }).then(() => {
                updateRingkasan();
            });

        }

        function updateRingkasan() {
            let totalItems = 0;
            let totalHarga = 0;

            const items = document.getElementsByClassName('item-keranjang');
            for (let item of items) {
                const checkbox = item.querySelector('.item-checkbox');
                if (checkbox.checked) {
                    const jumlah = parseInt(item.querySelector('input[name="quantity"]').value);
                    const harga = parseInt(item.dataset.harga);
                    totalItems += jumlah;
                    totalHarga += (harga * jumlah);
                }
            }

            document.getElementById('totalItems').textContent = totalItems;
            document.getElementById('totalHarga').textContent =
                'Rp' + new Intl.NumberFormat('id-ID').format(totalHarga);
            document.getElementById('checkoutButton') = totalItems === 0;
        }

        // Jika checkout di klik saat keranjang kosong
        document.getElementById('checkoutButton').addEventListener('click', function(event) {
            if (document.getElementById('totalItems').textContent === '0') {
            alert('Keranjang masih kosong');         
            event.preventDefault();
            }
        });

        // Update saat checkbox diubah
        document.getElementById('checkoutForm').addEventListener('submit', function(event) {
            const items = document.getElementsByClassName('item-checkbox');
            for (let item of items) {
                if (!item.checked) {
                    item.disabled = true;
                }
            }
        });

        // Update saat masuk di halaman
        document.addEventListener('DOMContentLoaded', updateRingkasan);
    </script>
</body>

</html>
