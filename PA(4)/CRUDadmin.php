<?php 
require "koneksi.php";

if(session_status() == PHP_SESSION_NONE){
    session_start();
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .search-bar {
            margin-bottom: 20px;
        }
        .tambah {
            color:black;
            padding: 10px 10px;
            text-decoration: none;
            border: 1px solid black;
            cursor: pointer;
        }
        .tambah:hover {
            background-color: #f1f1f1;
        }

        .navbar {
            overflow: hidden;
            background-color: #333;
            height: 50px;
            color: white;
        }

        .navbar a{
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            font-size : 20px;
        }
        .gambar-row {
            width: fit-content;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="logout.php">Logout</a>
    </div>
    <h1>CRUD ADMIN</h1>
    <search-bar>
        <form action="CRUDadmin.php" method="GET">
            <input type="text" name="search" placeholder="Cari ID, Judul, Penulis"
            <?php if(isset($_GET['search'])) echo 'value="'.$_GET['search'].'"'; ?>>
        </form>
    </search-bar>
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
                    <a href="edit_buku.php?id_buku=<?php echo $b['id_buku'] ?>">Edit</a>
                    <a href="delete_buku.php?id_buku=<?php echo $b['id_buku'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
