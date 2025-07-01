<?php
    error_reporting(0);
    include 'db.php';
	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 2");
	$a = mysqli_fetch_object($kontak);
	
	$produk = mysqli_query($conn, "SELECT * FROM tb_image WHERE image_id = '".$_GET['id']."' ");
	$p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>WEB Galeri Foto</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
        <ul>
            <li><a href="galeri.php" style="background-color: #007BFF; color: white; border: none; padding: 10px 20px; cursor: pointer;">Galeri</a></li>
           <li><a href="registrasi.php" style="background-color: #007BFF; color: white; border: none; padding: 10px 20px; cursor: pointer;">Registrasi</a></li>
           <li><a href="dashboard.php" style="background-color: #007BFF; color: white; border: none; padding: 10px 20px; cursor: pointer;">Kembali</li></a>
           <li><a href="login.php" style="background-color: #007BFF; color: white; border: none; padding: 10px 20px; cursor: pointer;">Login</a></li>
        </ul>
        </div>
    </header>
    
    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="galeri.php">
                <input type="text" name="search" placeholder="Cari Foto" value="<?php echo $_GET['search'] ?>" />
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>" />
                <input type="submit" name="cari" value="Cari Foto" style="background-color: #007BFF; color: white; border: none; padding: 10px 20px; cursor: pointer;">
                </form>
            </form>
        </div>
    </div>

    <!-- product detail -->
    <div class="section">
        <div class="container">
             <h3>Detail Foto</h3>
            <div class="box">
                <div class="col-2">
                   <img src="foto/<?php echo $p->image ?>" width="100%" /> 
                </div>
                <div class="col-2">
                   <h3><?php echo $p->image_name ?><br />Kategori : <?php echo $p->category_name  ?></h3>
                   <h4>Nama User : <?php echo $p->admin_name ?><br />
                   Upload Pada Tanggal : <?php echo $p->date_created  ?></h4>
                   <p>Deskripsi :<br />
                        <?php echo $p->image_description ?>
                   </p>
                   
                   <?php
session_start();
include 'db.php';
date_default_timezone_set('Asia/Jakarta');

$user_id = $_SESSION['a_global']->admin_id ?? null; // biar bisa like kalau login

// Hitung total like
$like_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tb_like WHERE image_id = '$p->image_id'");
$like_data = mysqli_fetch_assoc($like_query);

// Cek apakah user sudah like
$already_like = false;
if ($user_id) {
    $check = mysqli_query($conn, "SELECT * FROM tb_like WHERE image_id = '$p->image_id' AND user_id = '$user_id'");
    $already_like = mysqli_num_rows($check) > 0;
}
?>

<!-- LIKE -->
<div style="margin-top: 20px; margin-bottom: 30px;">
    <?php if ($user_id): ?>
        <form action="like.php" method="POST" style="display: flex; align-items: center; gap: 10px;">
            <input type="hidden" name="image_id" value="<?php echo $p->image_id; ?>">
            <button type="submit" name="like" 
                style="background: #ffebee; border: 1px solid #f44336; color: #f44336; border-radius: 50%; width: 45px; height: 45px; font-size: 20px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                <?php echo $already_like ? '💔' : '❤️'; ?>
            </button>
            <span style="font-size: 16px;"><?php echo $like_data['total']; ?> Likes</span>
        </form>
    <?php else: ?>
        <div style="font-size: 14px; margin-bottom: 10px;">
            <i><a href="login.php"></a></i><br>
            <span><?php echo $like_data['total']; ?> Likes</span>
        </div>
    <?php endif; ?>
</div>


<!-- KOMENTAR -->
<div style="margin-top: 40px;">
    <?php if (isset($_SESSION['a_global'])): ?>
        <h4 style="margin-bottom: 10px;">Tambah Komentar:</h4>
        <form action="comment.php" method="POST">
            <textarea name="comment_text" placeholder="Tulis komentar..." required class="input-control" rows="4" style="width: 100%; padding: 10px;"></textarea><br />
            <input type="hidden" name="image_id" value="<?php echo $p->image_id; ?>">
            <button type="submit" name="submit_comment" class="btn" style="background-color:rgb(145, 0, 46); color: white; border: none; padding: 10px 20px; cursor: pointer;">Kirim Komentar</button>
        </form>
    <?php else: ?>
        <p><i><a href="login.php">Login untuk like dan komentar</a></i></p>
    <?php endif; ?>
</div>

<!-- LIST KOMENTAR -->
<div style="margin-top: 30px;">
    <h4 style="margin-bottom: 15px;">Komentar:</h4>
    <div class="comments">
        <?php
            $comment_query = mysqli_query($conn, "SELECT * FROM tb_comments WHERE image_id = '$p->image_id' ORDER BY comment_date DESC");
            if (mysqli_num_rows($comment_query) > 0):
                while ($comment = mysqli_fetch_assoc($comment_query)):
        ?>
            <div class="comment" style="border-bottom:1px solid #ddd; margin-bottom:15px; padding-bottom:10px;">
                <p><strong><?php echo htmlspecialchars($comment['user_name']); ?>:</strong></p>
                <p style="margin: 5px 0;"><?php echo nl2br(htmlspecialchars($comment['comment_text'])); ?></p>
                <p><i style="color: #666;"><?php echo $comment['comment_date']; ?></i></p>
            </div>
        <?php endwhile; else: ?>
            <p>Belum ada komentar.</p>
        <?php endif; ?>
    </div>
</div>

                </div>
            </div>
        </div>
    </div>
    
    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - Web Galeri Foto.</small>
        </div>
    </footer>
</body>
</html>