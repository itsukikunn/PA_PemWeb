<?php
require "koneksi.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Hanya admin yang bisa masuk
if (isset($_SESSION["username"])) {
    if ($_SESSION['admin'] == true) {
        $_SESSION['admin'] = true;
    }
} else {
    header("Location: index.php");
    exit();
}

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

// JIka search, tambahkan query WHERE
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
    <link rel="stylesheet" href="styles/admin.css">
    <link rel="stylesheet" href="styles/darkmode.css">
    <title>CRUD Admin</title>
</head>

<body>
    <div class="navbar">
        <a href="">
            <img src="uploads/logo.png" alt="Logo" class='logo'>
        </a>
        <a href="logout.php" class="logout">Logout</a>
    </div>
    <h1>ADMIN PANEL</h1>

    <div class="search-bar">
        <form action="CRUDadmin.php" method="GET">
            <input type="text" name="search" placeholder="Cari ID, Judul, Penulis"
                <?php if (isset($_GET['search'])) echo 'value="' . $_GET['search'] . '"'; ?>>
        </form>
    </div>

    <a href="tambah_buku.php">
        <button class="tambah">Tambah Buku</button>
    </a>
    <div class="table-container">
        <table>
            <tr>
                <th>ID </th>
                <th>Judul</th>
                <th>Gambar</th>
                <th>Penulis</th>
                <th class="kolom-deksripsi">Deskripsi</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
            <?php foreach ($buku as $b) : ?>
                <tr>
                    <td><?php echo $b['id_buku'] ?></td>
                    <td><?php echo $b['nama_buku'] ?></td>
                    <td><img class="gambar-row" src="uploads/<?php echo $b['gambar'] ?>" alt="gambar buku" style="width: 100px;"></td>
                    <td><?php echo $b['penulis'] ?></td>
                    <td class="kolom-deskripsi"><?php echo $b['deskripsi'] ?></td>
                    <td><?php echo $b['kategori_buku'] ?></td>
                    <td><?php echo $b['stok_buku'] ?></td>
                    <td><?php echo $b['harga_buku'] ?></td>
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
    </div>
    <script src="scripts/darkmode.js"></script>
</body>

</html>
