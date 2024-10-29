<?php
    $server ='localhost:3307';
    $user = 'root';
    $password = '';
    $db_name = 'smpjhvn';

    $conn = mysqli_connect($server, $user, $password, $db_name);

    if(!$conn){
        die('Gagal terhubung ke database : '.mysqli_connect_error());
    }
?>