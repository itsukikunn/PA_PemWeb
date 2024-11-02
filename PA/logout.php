<?php
session_start();
$_SESSION['logout_message'] = 'Anda telah berhasil logout!';
session_unset();
session_destroy();

header("Location: index.php?status=logout");
exit;
?>
