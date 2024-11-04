<?php
require "koneksi.php";

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form
    $nama_buku = $_POST['nama_buku'];
    $penulis = $_POST['penulis'];
    $deskripsi = $_POST['deskripsi'];
    $kategori_buku = $_POST['kategori_buku'];
    $stok_buku = $_POST['stok_buku'];
    $harga_buku = $_POST['harga_buku'];

    // Cek apakah ada file yang diupload
    if(isset($_FILES["gambar"]) && $_FILES["gambar"]["error"] == 0) {
        // Direktori untuk menyimpan file
        $target_dir = "uploads/";
        
        // Mendapatkan ekstensi file
        $file_extension = strtolower(pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION));
        
        // Mendapatkan nama asli file
        $original_filename = pathinfo($_FILES["gambar"]["name"], PATHINFO_FILENAME);
        
        // Membuat nama file baru yang unik
        $new_filename = $original_filename . '_' . uniqid() . '.' . $file_extension;
        
        // Path lengkap file tujuan
        $target_file = $target_dir . $new_filename;
        
        // Cek apakah file adalah gambar
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if($check !== false) {
            // Upload file ke folder tujuan
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                // Query untuk insert data ke database
                $insert_query = "INSERT INTO buku (nama_buku, penulis, deskripsi, kategori_buku, stok_buku, harga_buku, gambar) 
                               VALUES ('$nama_buku', '$penulis', '$deskripsi', '$kategori_buku', '$stok_buku', '$harga_buku', '$new_filename')";
                
                if (mysqli_query($conn, $insert_query)) {
                    header("Location: CRUDadmin.php");
                    exit;
                } else {
                    echo "Error saat memasukkan data: " . mysqli_error($conn);
                }
            } else {
                echo "<script>
                alert(Gagal mengupload file)
                </script>";
            }
        } else {
            echo "<script>
                alert(File Yang diupload Bukan Gambar)
                </script>";
        }
    } else {
        echo "<script>
                alert(Harap pilih file gambar untuk diupload.)
                </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
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
        }

        form {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
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
            justify-content: space-between;
            align-items: center;
            border: 1px solid #ccc;
            margin: 10px 0;
            padding: 10px;
        }

        .gambar-preview {
            max-width: 200px;
            max-height: 200px;
            margin: 10px 0;
            object-fit: contain;
        }

        .gambar-box input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f4f4f4;
            cursor: pointer;
        }
    </style>

</head>

<body>
    <h1>Tambah Buku</h1>
    <form action="tambah_buku.php" method="POST" enctype="multipart/form-data">
        <label for="nama_buku">Nama Buku:</label>
        <input type="text" id="nama_buku" name="nama_buku" required><br>

        <label for="penulis">Penulis:</label>
        <input type="text" id="penulis" name="penulis" required><br>

        <label for="deskripsi">Deskripsi:</label>
        <textarea id="deskripsi" name="deskripsi" required></textarea><br>

        <label for="kategori_buku">Kategori Buku:</label>
        <input type="text" id="kategori_buku" name="kategori_buku" required><br>

        <label for="stok_buku">Stok Buku:</label>
        <input type="number" id="stok_buku" name="stok_buku" required><br>

        <label for="harga_buku">Harga Buku:</label>
        <input placeholder="Rp..." type="number" id="harga_buku" name="harga_buku" required><br>
        
        <!-- Upload Gambar -->
        <label for="gambar">Gambar Buku:</label>
        <div class="gambar-box">
            <img id="preview" class="gambar-preview" src="uploads/default.jpg" alt="Preview">
            <input type="file" id="gambar" name="gambar" accept="image/*" required onchange="previewImage(this)">
        </div>

        <button type="submit">Tambah</button>
        <a href="CRUDadmin.php"><button type="button" class="back-button">Kembali</button></a>

    </form>

        <!-- Script untuk preview gambar -->
        <script>
        // Fungsi untuk menampilkan preview gambar saat file dipilih
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const file = input.files[0];
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                
                reader.readAsDataURL(file);
            } else {
                preview.src = 'uploads/default.jpg';
            }
        }
    </script>
</body>
</html>