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
<?php require "navbar.php"; ?>
    </header>
    <div class="banner-container">
        <div class="banner-item large">
            <img id="bannerLarge" src="uploads/banner1.png" alt="Banner Large">
            <span>HavenMedia</span>
        </div>
        <div class="banner-item small">
            <img src="uploads/banner2.png" alt="Banner Small 1">
        </div>
        <div class="banner-item small">
            <img src="uploads/banner3.png" alt="Banner Small 2">
        </div>
    </div>

    
    <section class="categories">
        <div class="category-item">
            <img src="uploads/fiction.jpeg" alt="Buku Baru Andalan">
            <span>Fiction<br>Books</span>
        </div>
        <div class="category-item">
            <img src="uploads/nonfiction.jpeg" alt="Buku Fiksi Pilihan">
            <span>Non-Fiction<br>Books</span>
        </div>
        <div class="category-item">
            <img src="uploads/education.jpeg" alt="International Books">
            <span>Educational<br>Books</span>
        </div>
        <div class="category-item">
            <img src="uploads/selfhelp.jpeg" alt="Majalah Gramedia">
            <span>SelfHelp<br>Books</span>
        </div>
        <div class="category-item">
            <img src="uploads/bussiness.jpeg" alt="Gramedia Academy">
            <span>Bussiness<br>Books</span>
        </div>
        <div class="category-item">
            <img src="uploads/religion.jpeg" alt="Print On Demand">
            <span>Religion Books</span>
        </div>
        <div class="category-item">
            <img src="uploads/children.jpeg" alt="Non-Books">
            <span>Children-Young Books</span>
        </div>
    </section>

    <div class="container">
        <div class="headerbook">
            <h1>Buku Terlaris</h1>
            <a href="#">Lihat Semua</a>
        </div>
    
        <div class="content">
            <div class="category-background">
                <img src="uploads/banner-best-seller.avif" alt="Deskripsi Foto" class="category-image">
            </div>
    
            <div class="book-list">
    <div class="book-card">
        <form action="detail_buku.php" method="GET">
            <input type="hidden" name="id_buku" value="1">
            <button type="submit" class="book-button">
                <img src="https://via.placeholder.com/200x250" alt="Buku 1" class="book-image">
                <div class="book-title">Buku 1</div>
                <div class="book-author">Penulis 1</div>
                <div class="book-price">Rp50.000</div>
            </button>
        </form>
    </div>
    
    <div class="book-card">
        <form action="detail_buku.php" method="GET">
            <input type="hidden" name="id_buku" value="2">
            <button type="submit" class="book-button">
                <img src="https://via.placeholder.com/200x250" alt="Buku 2" class="book-image">
                <div class="book-title">Buku 2</div>
                <div class="book-author">Penulis 2</div>
                <div class="book-price">Rp50.000</div>
            </button>
        </form>
    </div>

            <div class="book-card">
                <form action="detail_buku.php" method="GET">
                    <input type="hidden" name="id_buku" value="3">
                    <button type="submit" class="book-button">
                        <img src="https://via.placeholder.com/200x250" alt="Buku 3" class="book-image">
                        <div class="book-title">Buku 3</div>
                        <div class="book-author">Penulis 3</div>
                        <div class="book-price">Rp50.000</div>
                    </button>
                </form>
            </div>

            <div class="book-card">
                <form action="detail_buku.php" method="GET">
                    <input type="hidden" name="id_buku" value="4">
                    <button type="submit" class="book-button">
                        <img src="https://via.placeholder.com/200x250" alt="Buku 4" class="book-image">
                        <div class="book-title">Buku 4</div>
                        <div class="book-author">Penulis 4</div>
                        <div class="book-price">Rp50.000</div>
                    </button>
                </form>
            </div>

            <div class="book-card">
                <form action="detail_buku.php" method="GET">
                    <input type="hidden" name="id_buku" value="5">
                    <button type="submit" class="book-button">
                        <img src="https://via.placeholder.com/200x250" alt="Buku 5" class="book-image">
                        <div class="book-title">Buku 5</div>
                        <div class="book-author">Penulis 5</div>
                        <div class="book-price">Rp50.000</div>
                    </button>
                </form>
            </div>

            <div class="book-card">
                <form action="detail_buku.php" method="GET">
                    <input type="hidden" name="id_buku" value="6">
                    <button type="submit" class="book-button">
                        <img src="https://via.placeholder.com/200x250" alt="Buku 6" class="book-image">
                        <div class="book-title">Buku 6</div>
                        <div class="book-author">Penulis 6</div>
                        <div class="book-price">Rp50.000</div>
                    </button>
                </form>
            </div>
    </div>
        </div>
    </div>

    <div class="container">
        <div class="headerbook">
            <h1>Buku Terlaris</h1>
            <a href="#">Lihat Semua</a>
        </div>
    
        <div class="content">
            <div class="category-background">
                <img src="uploads/banner-best-seller.avif" alt="Deskripsi Foto" class="category-image">
            </div>
    
            <div class="book-list">
    <div class="book-card">
        <form action="detail_buku.php" method="GET">
            <input type="hidden" name="id_buku" value="1">
            <button type="submit" class="book-button">
                <img src="https://via.placeholder.com/200x250" alt="Buku 1" class="book-image">
                <div class="book-title">Buku 1</div>
                <div class="book-author">Penulis 1</div>
                <div class="book-price">Rp50.000</div>
            </button>
        </form>
    </div>
    
    <div class="book-card">
        <form action="detail_buku.php" method="GET">
            <input type="hidden" name="id_buku" value="2">
            <button type="submit" class="book-button">
                <img src="https://via.placeholder.com/200x250" alt="Buku 2" class="book-image">
                <div class="book-title">Buku 2</div>
                <div class="book-author">Penulis 2</div>
                <div class="book-price">Rp50.000</div>
            </button>
        </form>
    </div>

            <div class="book-card">
                <form action="detail_buku.php" method="GET">
                    <input type="hidden" name="id_buku" value="3">
                    <button type="submit" class="book-button">
                        <img src="https://via.placeholder.com/200x250" alt="Buku 3" class="book-image">
                        <div class="book-title">Buku 3</div>
                        <div class="book-author">Penulis 3</div>
                        <div class="book-price">Rp50.000</div>
                    </button>
                </form>
            </div>

            <div class="book-card">
                <form action="detail_buku.php" method="GET">
                    <input type="hidden" name="id_buku" value="4">
                    <button type="submit" class="book-button">
                        <img src="https://via.placeholder.com/200x250" alt="Buku 4" class="book-image">
                        <div class="book-title">Buku 4</div>
                        <div class="book-author">Penulis 4</div>
                        <div class="book-price">Rp50.000</div>
                    </button>
                </form>
            </div>

            <div class="book-card">
                <form action="detail_buku.php" method="GET">
                    <input type="hidden" name="id_buku" value="5">
                    <button type="submit" class="book-button">
                        <img src="https://via.placeholder.com/200x250" alt="Buku 5" class="book-image">
                        <div class="book-title">Buku 5</div>
                        <div class="book-author">Penulis 5</div>
                        <div class="book-price">Rp50.000</div>
                    </button>
                </form>
            </div>

            <div class="book-card">
                <form action="detail_buku.php" method="GET">
                    <input type="hidden" name="id_buku" value="6">
                    <button type="submit" class="book-button">
                        <img src="https://via.placeholder.com/200x250" alt="Buku 6" class="book-image">
                        <div class="book-title">Buku 6</div>
                        <div class="book-author">Penulis 6</div>
                        <div class="book-price">Rp50.000</div>
                    </button>
                </form>
            </div>
    </div>
        </div>
    </div>

    <div class="container">
        <div class="headerbook">
            <h1>Buku Terlaris</h1>
            <a href="#">Lihat Semua</a>
        </div>
    
        <div class="content">
            <div class="category-background">
                <img src="uploads/banner-best-seller.avif" alt="Deskripsi Foto" class="category-image">
            </div>
    
            <div class="book-list">
    <div class="book-card">
        <form action="detail_buku.php" method="GET">
            <input type="hidden" name="id_buku" value="1">
            <button type="submit" class="book-button">
                <img src="https://via.placeholder.com/200x250" alt="Buku 1" class="book-image">
                <div class="book-title">Buku 1</div>
                <div class="book-author">Penulis 1</div>
                <div class="book-price">Rp50.000</div>
            </button>
        </form>
    </div>
    
    <div class="book-card">
        <form action="detail_buku.php" method="GET">
            <input type="hidden" name="id_buku" value="2">
            <button type="submit" class="book-button">
                <img src="https://via.placeholder.com/200x250" alt="Buku 2" class="book-image">
                <div class="book-title">Buku 2</div>
                <div class="book-author">Penulis 2</div>
                <div class="book-price">Rp50.000</div>
            </button>
        </form>
    </div>

            <div class="book-card">
                <form action="detail_buku.php" method="GET">
                    <input type="hidden" name="id_buku" value="3">
                    <button type="submit" class="book-button">
                        <img src="https://via.placeholder.com/200x250" alt="Buku 3" class="book-image">
                        <div class="book-title">Buku 3</div>
                        <div class="book-author">Penulis 3</div>
                        <div class="book-price">Rp50.000</div>
                    </button>
                </form>
            </div>

            <div class="book-card">
                <form action="detail_buku.php" method="GET">
                    <input type="hidden" name="id_buku" value="4">
                    <button type="submit" class="book-button">
                        <img src="https://via.placeholder.com/200x250" alt="Buku 4" class="book-image">
                        <div class="book-title">Buku 4</div>
                        <div class="book-author">Penulis 4</div>
                        <div class="book-price">Rp50.000</div>
                    </button>
                </form>
            </div>

            <div class="book-card">
                <form action="detail_buku.php" method="GET">
                    <input type="hidden" name="id_buku" value="5">
                    <button type="submit" class="book-button">
                        <img src="https://via.placeholder.com/200x250" alt="Buku 5" class="book-image">
                        <div class="book-title">Buku 5</div>
                        <div class="book-author">Penulis 5</div>
                        <div class="book-price">Rp50.000</div>
                    </button>
                </form>
            </div>

            <div class="book-card">
                <form action="detail_buku.php" method="GET">
                    <input type="hidden" name="id_buku" value="6">
                    <button type="submit" class="book-button">
                        <img src="https://via.placeholder.com/200x250" alt="Buku 6" class="book-image">
                        <div class="book-title">Buku 6</div>
                        <div class="book-author">Penulis 6</div>
                        <div class="book-price">Rp50.000</div>
                    </button>
                </form>
            </div>
    </div>
        </div>
    </div>
    <?php require "footer.php"; ?>
    <script src="scripts/scripts.js"></script>
</body>
</html>