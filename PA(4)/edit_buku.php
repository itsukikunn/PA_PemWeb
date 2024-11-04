<?php
require "koneksi.php";

if(session_status() == PHP_SESSION_NONE){
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
                // Query untuk update data ke database
                $update_query = "UPDATE buku SET 
                                nama_buku = '$nama_buku', 
                                penulis = '$penulis', 
                                deskripsi = '$deskripsi', 
                                kategori_buku = '$kategori_buku', 
                                stok_buku = '$stok_buku', 
                                harga_buku = '$harga_buku', 
                                gambar = '$new_filename' 
                                WHERE id_buku = $id_buku";
                
                if (mysqli_query($conn, $update_query)) {
                    header("Location: CRUDadmin.php");
                    exit;
                } else {
                    echo "Error saat mengupdate data: " . mysqli_error($conn);
                }
            } else {
                echo "<script>
                alert('Gagal mengupload file')
                </script>";
            }
        } else {
            echo "<script>
                alert('File Yang diupload Bukan Gambar')
                </script>";
        }
    } else {
        // Jika tidak ada file yang diupload, hanya update data teks
        $update_query = "UPDATE buku SET 
                        nama_buku = '$nama_buku', 
                        penulis = '$penulis', 
                        deskripsi = '$deskripsi', 
                        kategori_buku = '$kategori_buku', 
                        stok_buku = '$stok_buku', 
                        harga_buku = '$harga_buku'
                        WHERE id_buku = $id_buku";
        
        if (mysqli_query($conn, $update_query)) {
            header("Location: CRUDadmin.php");
            exit;
        } else {
            echo "Error saat mengupdate data: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
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
    <h1>Edit Buku</h1>
    <form action="edit_buku.php?id_buku=<?php echo $id_buku; ?>" method="POST" enctype="multipart/form-data">
        <label for="nama_buku">Nama Buku:</label>
        <input type="text" id="nama_buku" name="nama_buku" value="<?php echo $buku['nama_buku']; ?>" required><br>

        <label for="penulis">Penulis:</label>
        <input type="text" id="penulis" name="penulis" value="<?php echo $buku['penulis']; ?>" required><br>

        <label for="deskripsi">Deskripsi:</label>
        <textarea id="deskripsi" name="deskripsi" required><?php echo $buku['deskripsi']; ?></textarea><br>

        <label for="kategori_buku">Kategori Buku:</label>
        <input type="text" id="kategori_buku" name="kategori_buku" value="<?php echo $buku['kategori_buku']; ?>" required><br>

        <label for="stok_buku">Stok Buku:</label>
        <input type="number" id="stok_buku" name="stok_buku" value="<?php echo $buku['stok_buku']; ?>" required><br>

        <label for="harga_buku">Harga Buku:</label>
        <input placeholder="Rp..." type="number" id="harga_buku" name="harga_buku" value="<?php echo $buku['harga_buku']; ?>" required><br>
        
        <!-- Upload Gambar -->
        <label for="gambar">Gambar Buku:</label>
        <div class="gambar-box">
            <img id="preview" class="gambar-preview" src="uploads/<?php echo $buku['gambar']; ?>" alt="Preview">
            <input type="file" id="gambar" name="gambar" accept="image/*" onchange="previewImage(this)">
        </div>

        <button type="submit">Update</button>
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
                preview.src = 'uploads/<?php echo $buku['gambar']; ?>';
            }
        }
    </script>
</body>
</html>