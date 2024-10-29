<?php
require 'koneksi.php';

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $cek = "SELECT * FROM user WHERE email='$email' or username='$username'";
    $cekhasil = mysqli_query($conn, $cek);

    if (mysqli_num_rows($cekhasil) > 0) {
        echo "
        <script>
        alert('Email atau username sudah digunakan! Silakan login dengan akun Anda.');
        window.location.href = 'login.php';
        </script>"; 
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "
            <script>
            alert('Sign Up Berhasil!');
            window.location.href = 'login.php';
            </script>";
        } else {
            echo "
            <script>
            alert('Sign Up Gagal, Silahkan Coba Lagi: " . mysqli_error($conn) . "');
            window.location.href = 'signup.php';
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
    <title>Menu Sign Up</title>
    <link rel="stylesheet" href="styles/signup.css">
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <form action="signup.php" method="POST">
            <div>
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
                <button type="submit" name="signup">Sign Up</button>
            </div>
        </form>
        <p style="text-align: center;">Sudah punya akun? Login di <a href="login.php" style="color: blue">sini!</a></p>
    </div>
</body>
</html>
