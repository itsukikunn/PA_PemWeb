<?php
$login_akun = isset($_SESSION['login']) && $_SESSION['login'] === true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>  
    <header class="header">
        <div class="logo-container">
            <a href="index.php" class="header-link">
            <img src="uploads/logo.png" alt="Sempajahaven" class="custom-logo">
            </a>
        </div>
        <form class="search-bar" action="searching.php" method="POST">
            <input type="text" placeholder="Cari buku berdasarkan judul, penulis, atau kategori..." name="search">
            <button type="submit" class="search-button">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
        </div>
        <div class="header-buttons">
            <a href="index.php" class="header-link"><strong>Home</strong></a>
            <a href="about.php" class="header-link">📱<strong>About Us</strong></a>
            <a href="detail_buku.php?id_buku=1" class="header-link"><strong>DETAIL BUKU (INJIL)</strong></a>
            <?php if ($login_akun): ?>
                <a href="index.php?logout=true" class="header-link"><strong>Logout</strong></a>
            <?php else: ?>
                <a href="signup.php" class="header-link"><strong>Sign Up</strong></a>
                <a href="login.php" class="header-link"><strong>Login</strong></a>
            <?php endif; ?>
            <div class="cart-badge">
                <a href="keranjang.php" class="header-link">
                    🛒
                    <span class="badge"></span>
                </a>
            </div>
    </header>
</body>
</html>