<?php
require 'koneksi.php';

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (strlen($password) < 8) {
        echo "
        <script>
        alert('Password minimal 8 karakter!');
        window.location.href = 'register.php';
        </script>";
        exit;
    }

    $cek = "SELECT * FROM user WHERE email='$email' OR username='$username'";
    $cekhasil = mysqli_query($conn, $cek);

    if (mysqli_num_rows($cekhasil) > 0) {
        echo "
        <script>
        alert('Email atau username sudah digunakan! Silakan login dengan akun Anda.');
        window.location.href = 'login.php';
        </script>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO user (email, username, password) VALUES ('$email', '$username', '$hashed_password')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "
            <script>
            alert('Register Berhasil!');
            window.location.href = 'login.php';
            </script>";
        } else { 
            echo "
            <script>
            alert('Register Gagal, Silahkan Coba Lagi: " . mysqli_error($conn) . "');
            window.location.href = 'register.php';
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="styles/register.css">
</head>
<body>
    <div class="container-register" id="container">
        <div class="box-left">
            <div class="toggle">
            <img src="uploads/logo.png" alt="Sempajahaven" class="logo">
                <h1>Selamat Datang Di Website Kami!</h1>
                <h3>Silahkan registrasi terlebih dahulu</h3>
            </div>
        </div>
        <div class="box-right" id="box-right">
            <div class="content-right">
            <form action="register.php" method="POST">
            <div>
                <h1>Register</h1>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <button type="submit" name="register">Register</button>
            </div>
        </form>
            </div>
            <br>
            <p style="text-align: center;">Sudah punya akun? Login di <a href="login.php" style="color: blue">sini!</a></p>
        </div>
    </div>
</body>
</html>