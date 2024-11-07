<?php
session_start();
require "koneksi.php";

if (isset($_POST['login'])) {
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
    <title>Login Page</title>
    <link rel="stylesheet" href="styles/log.css">
</head>
<body>
    <div class="container-login" id="container">
        <div class="box-left">
            <div class="toggle">
            <h1>Gasss Login Brokkk!</h1>
            </div>
        </div>
        <div class="box-right" id="box-right">
            <div class="content-right">
            <form action="login.php" method="POST">
                <h1>Login</h1>
                <div>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div>
                    <button type="submit" name="login">Login</button>
                </div>
                    <br>
                <p>Belum punya akun? Registrasi di <a href="signup.php"> sini!</a></p>
            </form>
            </div>
        </div>
    </div>
</body>
</html>