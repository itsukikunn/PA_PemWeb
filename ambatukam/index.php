<?php
session_start();
require "koneksi.php";

$login_akun = isset($_SESSION['login']) && $_SESSION['login'] === true;

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}

if($login_akun && $_SESSION['admin'] === true) {
    header("Location: CRUDadmin.php");
    exit;
}


$conn = mysqli_connect($server, $user, $password, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}


function getBooksByCategory($conn, $category) {
    $books = [];
    $sql = "";
    
    switch($category) {
        case 'rekomendasi':
            $sql = "SELECT id_buku, nama_buku, penulis, harga_buku, gambar 
            FROM buku 
            WHERE stok_buku > 0 
            ORDER BY RAND() 
            LIMIT 6";
            break;
            
        case 'adaptasi_film':
            $sql = "SELECT id_buku, nama_buku, penulis, harga_buku, gambar FROM buku 
                   WHERE stok_buku > 0 AND deskripsi LIKE '%film adapted%'";
            break;
            
        case 'penulis_terkenal':
            $sql = "SELECT id_buku, nama_buku, penulis, harga_buku, gambar 
                FROM buku 
                WHERE stok_buku > 0 AND (penulis = 'J.K. Rowling' OR penulis = 'Rick Warren' OR penulis = 'Harper Lee') 
                ORDER BY stok_buku DESC";
            break;
    }
    
    $result = mysqli_query($conn, $sql);
    if ($result) {
        while($row = mysqli_fetch_assoc($result)) {
            $books[] = $row;
        }
    }
    return $books;
}


function displayBooks($books) {
    if (empty($books)) {
        echo '<p>Tidak ada buku yang tersedia.</p>';
        return;
    }

    foreach($books as $book) {
        $id_buku = isset($book['id_buku']) ? $book['id_buku'] : '';
        
        echo '<div class="book-card" id="book-' . $id_buku . '">';
        echo '<form action="detail_buku.php" method="GET">';
        echo '<input type="hidden" name="id_buku" value="' . $id_buku . '">';
        echo '<button type="submit" class="book-button">';
        echo '<img src="uploads/' . htmlspecialchars($book['gambar']) . '" alt="' . htmlspecialchars($book['nama_buku']) . '" class="book-image">';
        echo '<div class="book-title">' . htmlspecialchars($book['nama_buku']) . '</div>';
        echo '<div class="book-author">' . htmlspecialchars($book['penulis']) . '</div>';
        echo '<div class="book-price">Rp' . number_format($book['harga_buku'], 0, ',', '.') . '</div>';
        echo '</button>';
        echo '</form>';
        echo '</div>';
    }

   
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sempaja Haven</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    
    <header class="header">
        <div class="logo-container">
            <img src="uploads/sempaja1.png" alt="Sempajahaven" class="custom-logo">
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search for anything">
            <button class="search-button">🔍</button>
        </div>
        <div class="header-buttons">
            <a href="#" class="header-link"><strong>Home</strong></a>
            <a href="#" class="header-link">📱<strong>About Us</strong></a>
            <a href="detail_buku.php?id_buku=1" class="header-link"><strong>DETAIL BUKU (INJIL)</strong></a>
            <a href="signup.php" class="header-link"><strong>Sign Up</strong></a>
            <a href="login.php" class="header-link"><strong>Login</strong></a>
            <div class="cart-badge">
                <a href="keranjang.php" class="header-link">
                    🛒
                    <span class="badge"></span>
                </a>
            </div>
            <a href="#" class="sell-button">Sell</a>
        </div>
    </header>

    
    <div class="banner-container">
        <div class="banner-item large">
            <img id="bannerLarge" src="uploads/banner1.png" alt="Banner Large">
        </div>
        <div class="banner-item small">
            <img src="uploads/banner2.png" alt="Banner Small 1">
        </div>
        <div class="banner-item small">
            <img src="uploads/banner3.png" alt="Banner Small 2">
        </div>
    </div>

    
    <section class="categories">
    <form action="searching.php" method="post">
        <div class="category-item">
            <button type="submit" name="category" value="fiksi">
                <img src="uploads/fiction.jpeg" alt="Buku Baru Andalan">
                <span>Fiction<br>Books</span>
            </button>
        </div>
    </form>
    <form action="searching.php" method="post">
        <div class="category-item">
            <button type="submit" name="category" value="nonfiksi">
                <img src="uploads/nonfiction.jpeg" alt="Buku Fiksi Pilihan">
                <span>Non-Fiction<br>Books</span>
            </button>
        </div>
    </form>
    <form action="searching.php" method="post">
        <div class="category-item">
            <button type="submit" name="category" value="edukasi">
                <img src="uploads/education.jpeg" alt="International Books">
                <span>Educational<br>Books</span>
            </button>
        </div>
    </form>
    <form action="searching.php" method="post">
        <div class="category-item">
            <button type="submit" name="category" value="selfhelp">
                <img src="uploads/selfhelp.jpeg" alt="Majalah Gramedia">
                <span>SelfHelp<br>Books</span>
            </button>
        </div>
    </form>
    <form action="searching.php" method="post">
        <div class="category-item">
            <button type="submit" name="category" value="bisnis">
                <img src="uploads/bussiness.jpeg" alt="Gramedia Academy">
                <span>Business<br>Books</span>
            </button>
        </div>
    </form>
    <form action="searching.php" method="post">
        <div class="category-item">
            <button type="submit" name="category" value="agama">
                <img src="uploads/religion.jpeg" alt="Print On Demand">
                <span>Religion<br>Books</span>
            </button>
        </div>
    </form>
    <form action="searching.php" method="post">
        <div class="category-item">
            <button type="submit" name="category" value="anak-anak">
                <img src="uploads/children.jpeg" alt="Non-Books">
                <span>Children-Young Books</span>
            </button>
        </div>
    </form>
</section>


    <section class="book-container">
    <div class="container">
        <div class="headerbook">
            <h2>Rekomendasi Buku</h2>
            <a href="#">Lihat Semua</a>
        </div>
        
        <div class="content">
            <div class="category-background">
                <img src="uploads/banner-best-seller.avif" alt="Banner rekomendasi buku">
            </div>
            
            <div class="book-list">
                <?php
                $recommended_books = getBooksByCategory($conn, 'rekomendasi');
                displayBooks($recommended_books);
                ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="headerbook">
            <h2>Buku Adaptasi Film</h2>
            <a href="#">Lihat Semua</a>
        </div>
        
        <div class="content">
            <div class="category-background">
                <img src="uploads/banner-best-seller.avif" alt="Banner buku adaptasi film">
            </div>
            
            <div class="book-list">
                <?php
                $movie_books = getBooksByCategory($conn, 'adaptasi_film');
                displayBooks($movie_books);
                ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="headerbook">
            <h2>Buku Penulis Terkenal</h2>
            <a href="#">Lihat Semua</a>
        </div>
        
        <div class="content">
            <div class="category-background">
                <img src="uploads/banner-best-seller.avif" alt="Banner penulis terkenal">
            </div>
            
            <div class="book-list">
                <?php
                $famous_author_books = getBooksByCategory($conn, 'penulis_terkenal');
                displayBooks($famous_author_books);
                ?>
            </div>
        </div>
    </div>
</section>


    <footer class="footer-main">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-item">
                    <div>
                        <div class="footer-option">
                            <a href="index.html">
                                <img src="uploads/sempaja1.png" alt="Logo" width="80" height="80">
                            </a>
                            <div>
                                <h5 class="title-option"> SHOP </h5>
                                <ul class="list-option">
                                    <li class="list-item">
                                        <a href="index.html" class="list-link">Home</a>
                                    </li>
                                    <li class="list-item">
                                        <a href="start_review.html" class="list-link">Start Selling</a>
                                    </li>
                                    <li class="list-item">
                                        <a href="about_me.html" class="list-link">About Us</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h5 class="title-option"> SELL </h5>
                                <ul class="list-option">
                                    <li class="list-item">
                                        <a href="index.html" class="list-link">How To Sell</a>
                                    </li>
                                    <li class="list-item">
                                        <a href="start_review.html" class="list-link">Verification User</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h5 class="title-option"> SUPPORT </h5>
                                <ul class="list-option">
                                    <li class="list-item">
                                        <a href="index.html" class="list-link"> Contact Us</a>
                                    </li>
                                    <li class="list-item">
                                        <a href="start_review.html" class="list-link">Help Center</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h5 class="title-option"> COMPANY & POLICIES</h5>
                                <ul class="list-option">
                                    <li class="list-item">
                                        <a href="index.html" class="list-link">About Us</a>
                                    </li>
                                    <li class="list-item">
                                        <a href="start_review.html" class="list-link">Policy Center</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h5 class="title-option"> FIND US ON </h5>
                                <ul class="list-option">
                                    <li class="list-item">
                                        <a href="index.html" class="list-link">Facebook</a>
                                    </li>
                                    <li class="list-item">
                                        <a href="start_review.html" class="list-link">Instagram</a>
                                    </li>
                                    <li class="list-item">
                                        <a href="start_review.html" class="list-link">Twitter</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="copyright">
                        <div class="sub-copyright">
                            <p>© 2024 Sempajahaven. All Rights Reserved</p>
                            <ul class="menu-copyright">
                                <li class="list-item">
                                    <a href="index.html" class="list-link">Terms of Service</a>
                                </li>
                                <li class="list-item">
                                    <a href="start_review.html" class="list-link">Privacy Policy</a>
                                </li>
                                <li class="list-item">
                                    <a href="start_review.html" class="list-link">Accessibility</a>
                                </li>
                                <li class="list-item">
                                    <a href="start_review.html" class="list-link">Cookie Preferences</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="scripts/scripts.js"></script>
</body>
</html>
<?php mysqli_close($conn); ?>
