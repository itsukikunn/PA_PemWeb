<?php
    $server = 'localhost:3307';
    $user = 'root';
    $password = '';
    $db = 'smpjhvn';

    $conn = mysqli_connect($server, $user, $password, $db);
    if(!$conn) {
        die("Gagal terhubung ke database: " . mysqli_connect_error());
    }