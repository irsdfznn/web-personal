<?php
session_start();
include 'db.php';
date_default_timezone_set('Asia/Jakarta');

if (isset($_POST['submit_comment'])) {
    $image_id = $_POST['image_id'];
    $user_id = $_SESSION['a_global']->admin_id;
    $user_name = $_SESSION['a_global']->admin_name;
    $comment_text = mysqli_real_escape_string($conn, $_POST['comment_text']);
    $comment_date = date('Y-m-d H:i:s');

    $insert = mysqli_query($conn, "INSERT INTO tb_comments (image_id, user_id, user_name, comment_text, comment_date)
                                   VALUES ('$image_id', '$user_id', '$user_name', '$comment_text', '$comment_date')");

    if ($insert) {
        echo "<script>alert('Komentar berhasil ditambahkan!'); window.location='detail-image.php?id=$image_id';</script>";
    } else {
        echo "<script>alert('Komentar gagal!'); window.location='detail-image.php?id=$image_id';</script>";
    }
}
?>
