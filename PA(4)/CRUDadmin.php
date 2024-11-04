<?php 
require "koneksi.php";

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

// Hanya admin yang bisa masuk
if(isset($_SESSION["username"])){
    if($_SESSION['admin'] == true){
        $_SESSION['admin'] = true;
    }
} else {
    header("Location: index.php");
    exit();
}

// Query untuk mendapatkan semua records
if(isset($_SESSION["username"])){
    $username = $_SESSION["username"];
    $query = "SELECT id_user FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $id_user = $row["id_user"];
        $_SESSION["id_user"] = $id_user;
    }
}

// JIka ada parameter search, tambahkan query WHERE
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query = "SELECT * FROM buku WHERE id_buku LIKE '%$search%' OR nama_buku LIKE '%$search%' OR penulis LIKE '%$search%'";
} else {
    $query = "SELECT * FROM buku";
}

$buku = [];
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $buku[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background-color: #285398;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            font-size: 16px;
            font-weight: bold;
        }

        .navbar a:hover {
            color: #4CAF50;
        }

        .navbar .logo {
            height: 40px;
            margin-right: 10px;
        }

        .navbar .logo-container {
            display: flex;
            align-items: center;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        .search-bar {
            margin: 20px auto;
            text-align: center;
        }
        .search-bar input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .tambah {
            display: block;
            width: 150px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .tambah:hover {
            background-color: #45a049;
            text-decoration: none;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .gambar-row {
            width: 100px;
            height: auto;
        }
        td a {
            margin-right: 10px;
            color: #333;
            text-decoration: none;
        }
        td a:hover {
            text-decoration: underline;
        }

        .search-bar {
            margin: 20px auto;
            text-align: center;
            align-items: center;
        }

        .search-bar form {
            display: inline-block;
            margin: 0 auto;
        }

        .search-bar input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .search-bar input[type="text"]:focus {
            border-color: #4CAF50;
            outline: none;
        }

        .aksi-edit {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 0 0 10px 5px;
            font-size: 12px;
            width: 60px;
        }

        .aksi-hapus {
            padding: 5px 10px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 0 0 10px 5px;
            font-size: 12px;
            width: 60px;
        }

        .logo {
            height: 20px;
            vertical-align: middle;
        }

        .logout {
            float: right;
            padding: 14px 20px;
        }

    </style>
</head>
<body>
    <div class="navbar">
        <a href="index.php" style="float: left; padding: 14px 16px;">
            <img class='logo' src="uploads/logo.png" alt="Logo">
            <span>Nama Web</span>
        </a>
        <a class="logout" href="logout.php" style="float: right; padding: 14px 16px;">Logout</a>
    </div>
    <h1>ADMIN PANEL</h1>

    <div class="search-bar">
        <form action="CRUDadmin.php" method="GET">
            <input type="text" name="search" placeholder="Cari ID, Judul, Penulis"
            <?php if(isset($_GET['search'])) echo 'value="'.$_GET['search'].'"'; ?>>
        </form>
    </div>

    <a href="tambah_buku.php">
        <button class="tambah">Tambah Buku</button>
    </a>
    <table>
        <tr>
            <th>ID </th>
            <th>Judul</th>
            <th>Gambar</th>

            <th>Penulis</th>
            <th>Deskripsi</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php foreach($buku as $b) : ?>
            <tr>
                <td><?php echo $b['id_buku'] ?></td>
                <td><?php echo $b['nama_buku'] ?></td>
                <td><img class="gambar-row" src="uploads/<?php echo $b['gambar'] ?>" alt="gambar buku" style="width: 100px;"></td>
                <td><?php echo $b['penulis'] ?></td>
                <td><?php echo $b['deskripsi'] ?></td>
                <td><?php echo $b['kategori_buku'] ?></td>
                <td><?php echo $b['stok_buku']?></td>
                <td><?php echo $b['harga_buku']?></td>
                <td>
                    <a href="edit_buku.php?id_buku=<?php echo $b['id_buku'] ?>">
                        <button class="aksi-edit">Edit</button>
                    <a href="delete_buku.php?id_buku=<?php echo $b['id_buku'] ?>" onclick="return confirm('Yakin ingin menghapus?')">
                        <button class="aksi-hapus">Delete </button>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
