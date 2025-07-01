<?php
    include 'db.php';
    session_start();
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Irsyad Gallery's</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
        <h1><a href="dashboard.php">WEB GALERI FOTO</a></h1>
        <ul>
           <li><a href="dashboard.php" style="background-color: #007BFF; color: white; border: none; padding: 10px 20px; cursor: pointer;">Dashboard</a></li>
           <li><a href="profil.php" style="background-color: #007BFF; color: white; border: none; padding: 10px 20px; cursor: pointer;">Profil</a></li>
           <li><a href="tambah-image.php" style="background-color: #007BFF; color: white; border: none; padding: 10px 20px; cursor: pointer;">Tambah Foto</li></a>
           <li><a href="data-image.php" style="background-color: #007BFF; color: white; border: none; padding: 10px 20px; cursor: pointer;">Data Foto</a></li>
           <li><a href="Keluar.php" style="background-color: #007BFF; color: white; border: none; padding: 10px 20px; cursor: pointer;">Keluar</a></li>
        </ul>
        </div>
    </header>
    
    <!-- content -->
    <div class="section">
        <div class="container">    
                <h3>Selamat Datang <?php echo $_SESSION['a_global']->admin_name ?> di Website Galeri Foto</h3>
            </div>
        </div>
    
 <!-- new product -->
 <div class="container">
       <h3>Foto Terbaru</h3>
       <div class="box">
          <?php
              $foto = mysqli_query($conn, "SELECT * FROM tb_image WHERE image_status = 1 ORDER BY image_id DESC LIMIT 8");
			  if(mysqli_num_rows($foto) > 0){
				  while($p = mysqli_fetch_array($foto)){
		  ?>
          <a href="detail-image.php?id=<?php echo $p['image_id'] ?>">
          <div class="col-4">
              <img src="foto/<?php echo $p['image'] ?>" height="150px" />
              <p class="nama"><?php echo substr($p['image_name'], 0, 30)  ?></p>
              <p class="admin">Nama User : <?php echo $p['admin_name'] ?></p>
              <p class="nama"><?php echo $p['date_created']  ?></p>
          </div>
          </a>
          <?php }}else{ ?>
              <p>Foto tidak ada</p>
          <?php } ?>
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