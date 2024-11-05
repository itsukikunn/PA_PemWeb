<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Book</title>
    <link rel="stylesheet" href="styles/search.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="main-container">
        <!-- Left Content - Kategori Filter -->
        <div class="left-content">
            <div class="kategori-area">
                <h2>Kategori</h2>
                <form method="POST" class="kategori-list">
                    <?php
                    $query = "SELECT DISTINCT kategori_buku FROM buku";
                    $result = mysqli_query($conn, $query);
                    echo "<button type='submit' name='kategori' value='all'>Semua Kategori</button>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        $isSelected = isset($_POST['kategori']) && $_POST['kategori'] === $row['kategori_buku'];
                        $activeClass = $isSelected ? 'active' : '';
                        echo "<button type='submit' name='kategori' value='{$row['kategori_buku']}' class='$activeClass'>{$row['kategori_buku']}</button>";
                    }
                    ?>
                </form>
            </div>
        </div>
        <!-- Separator -->
        <div class="separator"></div>
        <!-- Right Content - Book Cards -->
        <div class="right-content">
            <div class="card-container">
                <?php
                if ($conn->connect_error) {
                    die("Connection failed: {$conn->connect_error}");
                }
                if (isset($_POST['kategori']) && $_POST['kategori'] !== 'all') {
                    $stmt = $conn->prepare("SELECT * FROM buku WHERE kategori_buku = ?");
                    $stmt->bind_param("s", $_POST['kategori']);
                } else {
                    $search = $_POST['search'] ?? '';
                    if ($search) {
                        $stmt = $conn->prepare("SELECT * FROM buku WHERE nama_buku LIKE ? OR penulis LIKE ? OR kategori_buku LIKE ?");
                        $searchParam = "%$search%";
                        $stmt->bind_param("sss", $searchParam, $searchParam, $searchParam);
                    } else {
                        $stmt = $conn->prepare("SELECT * FROM buku");
                    }
                }

                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <a href='detail_buku.php?id_buku={$row['id_buku']}' class='card-link'>
                            <div class='card'>
                                <div class='image-container'>
                                    <img src='uploads/{$row['gambar']}' alt='Cover {$row['nama_buku']}' />
                                </div>
                                <div class='card-content'>
                                    <div>
                                        <h3>{$row['nama_buku']}</h3>
                                        <p>Penulis: {$row['penulis']}</p>
                                    </div>
                                    <div class='price'>Rp" . number_format($row['harga_buku'], 0, ',', '.') . "</div>
                                </div>
                            </div>
                        </a>";
                    }
                } else {
                    echo "<p>Data tidak ditemukan</p>";
                }
                $stmt->close();
                $conn->close();
                ?>
            </div>
        </div>
    </div>
</body>
</html>