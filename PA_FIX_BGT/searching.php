<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Book</title>
    <link rel="stylesheet" href="styles/search.css">
    <link rel="stylesheet" href="styles/darkmode.css">
</head>
<body>
    <?php require 'navbar.php'; ?>
    <div class="main-container">

        <section class="categories">
            <form action="searching.php" method="post"></form>
        </section>

        <!-- Left Content - Kategori Filter -->
        <div class="left-content">
            <div class="kategori-area">
                <h2>Kategori</h2>
                <form method="POST" class="kategori-list">
                    <?php
                    $query = "SELECT DISTINCT kategori_buku FROM buku";
                    $result = mysqli_query($conn, $query);
                    
                    echo "<button type='submit' name='category' value='all'>Semua Kategori</button>";
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        $isSelected = isset($_POST['category']) && $_POST['category'] === $row['kategori_buku'];
                        $activeClass = $isSelected ? 'active' : '';
                        echo "<button type='submit' name='category' value='{$row['kategori_buku']}' class='$activeClass'>{$row['kategori_buku']}</button>";
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

                // Mulai membangun query
                $baseQuery = "SELECT * FROM buku";
                $params = [];
                $types = "";

                // Filter Berdasarkan Kategori dari 'category'
                if (isset($_POST['category']) && $_POST['category'] !== 'all') {
                    $baseQuery .= " WHERE kategori_buku = ?";
                    $params[] = $_POST['category'];
                    $types .= "s";
                }

                // Pencarian Berdasarkan Nama Buku atau Penulis
                if (!empty($_POST['search'])) {
                    $search = "%{$_POST['search']}%";
                    if (count($params) > 0) {
                        $baseQuery .= " AND (nama_buku LIKE ? OR penulis LIKE ?)";
                    } else {
                        $baseQuery .= " WHERE (nama_buku LIKE ? OR penulis LIKE ?)";
                    }
                    $params[] = $search;
                    $params[] = $search;
                    $types .= "ss";
                }

                // Eksekusi query dengan prepared statements
                $stmt = $conn->prepare($baseQuery);
                
                if ($types) {
                    $stmt->bind_param($types, ...$params);
                }
                
                $stmt->execute();
                $result = $stmt->get_result();

                // Menampilkan hasil pencarian atau kategori
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
    <script src="scripts/darkmode.js"></script>
</body>
</html>
