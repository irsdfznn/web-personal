<?php
session_start();
include 'db.php';
date_default_timezone_set('Asia/Jakarta');

if (!isset($_SESSION['a_global'])) {
    echo '<script>alert("Silakan login terlebih dahulu!");window.location="login.php";</script>';
    exit;
}

$user_id = $_SESSION['a_global']->admin_id;
$image_id = $_POST['image_id'];

// Cek apakah sudah like
$cek = mysqli_query($conn, "SELECT * FROM tb_like WHERE image_id = '$image_id' AND user_id = '$user_id'");

if (mysqli_num_rows($cek) == 0) {
    // Belum like → insert
    mysqli_query($conn, "INSERT INTO tb_like (image_id, user_id) VALUES ('$image_id', '$user_id')");
} else {
    // Sudah like → hapus
    mysqli_query($conn, "DELETE FROM tb_like WHERE image_id = '$image_id' AND user_id = '$user_id'");
}

// Redirect balik ke halaman detail
header("Location: detail-image.php?id=$image_id");
exit;
