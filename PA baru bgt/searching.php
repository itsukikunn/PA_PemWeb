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
    <div class="card-container">
    <?php
    include 'koneksi.php';
    $search = $_POST['search'] ?? '';
    
    if ($conn->connect_error) {
        die("Connection failed: {$conn->connect_error}");
    }
    
    $stmt = $conn->prepare("SELECT * FROM buku WHERE nama_buku LIKE ? OR penulis LIKE ? OR kategori_buku LIKE ?");
    $searchParam = "%$search%";
    $stmt->bind_param("sss", $searchParam, $searchParam, $searchParam);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "
            <a href='detail_buku.php?id_buku={$row['id_buku']}' class='card-link'>
            <div class='card'>
                <img src='uploads/{$row['gambar']}' alt='Cover Image' />
                <h3>{$row['nama_buku']}</h3>
                <p>Penulis: {$row['penulis']}</p>
                <p class='price'>Rp" . number_format($row['harga_buku'], 0, ',', '.') . "</p>
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
</body>
</html>
