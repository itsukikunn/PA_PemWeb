<?php
session_start();
require "koneksi.php";

if (isset($_POST['signup'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $usernameadmin = 'admin';
    $passwordadmin = 'admin';

    if ($username === $usernameadmin && $password === $passwordadmin) {
        $_SESSION['username'] = $usernameadmin;
        $_SESSION['login'] = true;
        $_SESSION['admin'] = true;
        echo "<script>
                alert('Login berhasil sebagai Admin! Selamat datang $usernameadmin');
                document.location.href = 'CRUDadmin.php';
              </script>";
    } else {
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username;
                $_SESSION['login'] = true;
                echo "<script>
                        alert('Login berhasil! Selamat datang $username');
                        document.location.href = 'index.php';
                    </script>";
            } else {
                echo "<script>
                        alert('Password salah!');
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Username tidak ditemukan! Silakan registrasi terlebih dahulu.');
                    document.location.href = 'signup.php';
                  </script>";
        }
    }
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Login</title>
    <link rel="stylesheet" href="styles/log.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <button type="submit" name="signup">Login</button>
            </div>
        </form>
        <p style="text-align: center;">Belum punya akun? Registrasi di<a href="signup.php" style="color: blue;"> sini!</a></p>
    </div>
</body>
</html>
