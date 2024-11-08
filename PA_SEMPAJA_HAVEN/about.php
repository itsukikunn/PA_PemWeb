<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sempaja Haven</title>
    <link rel="stylesheet" href="styles/about.css">
    <link rel="stylesheet" href="styles/darkmode.css">
</head>
<body>
<?php require "navbar.php"; ?>
    </header>
    <div class="kelompok-container">
        <h1>Nama Kelompok: Sempaja Haven</h1>
        
        <div class="member-container">
            <div class="member">
                <h2>Ketua Kelompok</h2>
                <p>Nama: Zulfikar Heriansyah</p>
                <p>NIM: 2309106033</p>
            </div>
            <div class="member">
                <h2>Anggota</h2>
                <p>Nama: Ahmad Zuhair Nur Aiman</p>
                <p>NIM: 2309106025</p>
            </div>
            <div class="member">
                <h2>Anggota</h2>
                <p>Nama: Injil Karepowan</p>
                <p>NIM: 2309106028</p>
            </div>
            <div class="member">
                <h2>Anggota</h2>
                <p>Nama: Muhammad Rafly Pratama Olanda</p>
                <p>NIM: 2309106043</p>
            </div>
        </div>
    </div>
    <?php require "footer.php"; ?>
    <script src="scripts/darkmode.js"></script>
</body>
</html>