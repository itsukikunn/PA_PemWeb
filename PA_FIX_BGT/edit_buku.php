<?php
require "koneksi.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id_buku = $_GET['id_buku'];

// Query untuk mendapatkan data buku berdasarkan id
$query = "SELECT * FROM buku WHERE id_buku = $id_buku";
$result = mysqli_query($conn, $query);
$buku = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form
    $nama_buku = $_POST['nama_buku'];
    $penulis = $_POST['penulis'];
    $deskripsi = $_POST['deskripsi'];
    $kategori_buku = $_POST['kategori_buku'];
    $stok_buku = $_POST['stok_buku'];
    $harga_buku = $_POST['harga_buku'];
    $gambar = $buku['gambar']; // Menggunakan gambar yang sudah ada sebagai default

    // Cek jika ada file baru yang diupload
    if ($_FILES["gambar"]["size"] > 0) {
        $target_dir = "uploads/";
        $file_extension = strtolower(pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION));

        $original_filename = pathinfo($_FILES["gambar"]["name"], PATHINFO_FILENAME);
        $new_filename = $original_filename . '_' . uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;

        // Cek apakah file adalah gambar yang valid
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($file_extension, $allowed_extensions)) {
            echo "<script>
                alert('File Yang diupload Bukan Gambar');
                window.location.href = 'edit_buku.php?id_buku=" . $id_buku . "';
            </script>";
            exit;
        }

        // Upload file
        if (!move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            echo "<script>
                alert('Gagal mengupload file');
                window.location.href = 'edit_buku.php?id_buku=" . $id_buku . "';
            </script>";
            exit;
        }

        // Jika berhasil upload, update nama file gambar
        $gambar = $new_filename;
    }

    // Update data ke database
    $update_query = "UPDATE buku SET 
                    nama_buku = '$nama_buku', 
                    penulis = '$penulis', 
                    deskripsi = '$deskripsi', 
                    kategori_buku = '$kategori_buku', 
                    stok_buku = '$stok_buku', 
                    harga_buku = '$harga_buku', 
                    gambar = '$gambar' 
                    WHERE id_buku = $id_buku";

    if (mysqli_query($conn, $update_query)) {
        header("Location: CRUDadmin.php");
        exit;
    } else {
        echo "<script>
            alert('Error saat mengupdate data: " . mysqli_error($conn) . "');
            window.location.href = 'edit_buku.php?id_buku=" . $id_buku . "';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link rel="stylesheet" href="styles/darkmode.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        form {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
            max-width: 100%;
            min-width: 100%;
            min-height: 50px;
        }

        button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        .back-button {
            background-color: #007bff;
            margin-top: 10px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        .gambar-box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border: 1px solid #ccc;
            margin: 10px 0;
            padding: 10px;
            border-radius: 4px;
            background-color: #fafafa;
        }

        .gambar-preview {
            max-width: 200px;
            max-height: 200px;
            margin: 10px 0;
            object-fit: contain;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .gambar-box input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f4f4f4;
            cursor: pointer;
            font-size: 16px;
        }

        /* Menambahkan style untuk radio button */
        .radio-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 10px;
            margin-bottom: 20px;
        }

        .radio-item {
            position: relative;
            display: flex;
            align-items: center;
        }

        .radio-item input[type="radio"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .radio-item label {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            width: 100%;
            background-color: #f8f9fa;
            border: 2px solid #dee2e6;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            margin: 0;
        }

        .radio-item input[type="radio"]:checked+label {
            background-color: #007bff;
            color: white;
            border-color: #0056b3;
            font-weight: bold;
        }

        .radio-item label:hover {
            background-color: #e9ecef;
            border-color: #adb5bd;
        }

        .radio-item input[type="radio"]:checked+label:hover {
            background-color: #0056b3;
        }

        .kategori-label {
            margin-bottom: 10px;
            color: #555;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Edit Buku</h1>
    <form action="edit_buku.php?id_buku=<?php echo $id_buku; ?>" method="POST" enctype="multipart/form-data">
        <label for="nama_buku">Nama Buku:</label>
        <input type="text" id="nama_buku" name="nama_buku" value="<?php echo $buku['nama_buku']; ?>" required><br>

        <label for="penulis">Penulis:</label>
        <input type="text" id="penulis" name="penulis" value="<?php echo $buku['penulis']; ?>" required><br>

        <label for="deskripsi">Deskripsi:</label>
        <textarea id="deskripsi" name="deskripsi" required><?php echo $buku['deskripsi']; ?></textarea><br>

        <label class="kategori-label">Kategori Buku:</label>
        <div class="radio-group">
            <div class="radio-item">
                <input type="radio" id="nonfiksi" name="kategori_buku" value="Nonfiksi" <?php echo ($buku['kategori_buku'] == 'Nonfiksi') ? 'checked' : ''; ?> required>
                <label for="nonfiksi">Nonfiksi</label>
            </div>
            <div class="radio-item">
                <input type="radio" id="fiksi" name="kategori_buku" value="Fiksi" <?php echo ($buku['kategori_buku'] == 'Fiksi') ? 'checked' : ''; ?>>
                <label for="fiksi">Fiksi</label>
            </div>
            <div class="radio-item">
                <input type="radio" id="anak" name="kategori_buku" value="Anak-Anak" <?php echo ($buku['kategori_buku'] == 'Anak-Anak') ? 'checked' : ''; ?>>
                <label for="anak">Anak-Anak</label>
            </div>
            <div class="radio-item">
                <input type="radio" id="edukasi" name="kategori_buku" value="Edukasi" <?php echo ($buku['kategori_buku'] == 'Edukasi') ? 'checked' : ''; ?>>
                <label for="edukasi">Edukasi</label>
            </div>
            <div class="radio-item">
                <input type="radio" id="selfhelp" name="kategori_buku" value="Selfhelp" <?php echo ($buku['kategori_buku'] == 'Selfhelp') ? 'checked' : ''; ?>>
                <label for="selfhelp">Selfhelp</label>
            </div>
            <div class="radio-item">
                <input type="radio" id="bisnis" name="kategori_buku" value="Bisnis" <?php echo ($buku['kategori_buku'] == 'Bisnis') ? 'checked' : ''; ?>>
                <label for="bisnis">Bisnis</label>
            </div>
            <div class="radio-item">
                <input type="radio" id="agama" name="kategori_buku" value="Agama" <?php echo ($buku['kategori_buku'] == 'Agama') ? 'checked' : ''; ?>>
                <label for="agama">Agama</label>
            </div>
        </div>

        <label for="stok_buku">Stok Buku:</label>
        <input type="number" id="stok_buku" name="stok_buku" value="<?php echo $buku['stok_buku']; ?>" required><br>

        <label for="harga_buku">Harga Buku:</label>
        <input placeholder="Rp..." type="number" id="harga_buku" name="harga_buku" value="<?php echo $buku['harga_buku']; ?>" required><br>

        <label for="gambar">Gambar Buku:</label>
        <div class="gambar-box">
            <img id="preview" class="gambar-preview" src="uploads/<?php echo $buku['gambar']; ?>" alt="Preview">
            <input type="file" id="gambar" name="gambar" accept="image/*" onchange="previewImage(this)">
        </div>

        <button type="submit">Update</button>
        <a href="CRUDadmin.php"><button type="button" class="back-button">Kembali</button></a>
    </form>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
    <script src="scripts/darkmode.js"></script>
</body>

</html>