<?php
    include 'db.php';
	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 2");
	$a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Irsyad Galery's</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
        <ul>
            <li><a href="galeri.php" style="background-color: #007BFF; color: white; border: none; padding: 10px 20px; cursor: pointer;">Galeri</a></li>
           <li><a href="registrasi.php" style="background-color: #007BFF; color: white; border: none; padding: 10px 20px; cursor: pointer;">Registrasi</a></li>
           <li><a href="login.php" style="background-color: #007BFF; color: white; border: none; padding: 10px 20px; cursor: pointer;">Login</a></li>
        </ul>
        </div>
    </header>
    
    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="galeri.php">
                <input type="text" name="search" placeholder="Cari Foto" />
                <input type="submit" name="cari" value="Cari Foto" style="background-color: #007BFF; color: white; border: none; padding: 10px 20px; cursor: pointer;">
            </form>
        </div>
    </div>
    
    <!-- category -->
     <div class="section">
        <div class="container">
            <h3>Kategori</h3>
            <div class="box">
                                    <a href="galeri.php?kat=23">
                        <div class="col-5">
                            <img src="img/9.png" width="50px" style="margin-bottom:5px;" />
                        <p>Arsitektur</p>
                        </div>
                    </a>
                                    <a href="galeri.php?kat=22">
                        <div class="col-5">
                            <img src="img/8.png" width="50px" style="margin-bottom:5px;" />
                        <p>Dokumenter</p>
                        </div>
                    </a>
                                    <a href="galeri.php?kat=21">
                        <div class="col-5">
                            <img src="img/7.png" width="50px" style="margin-bottom:5px;" />
                        <p>Seni Rupa</p>
                        </div>
                    </a>
                                    <a href="galeri.php?kat=20">
                        <div class="col-5">
                            <img src="img/6.png" width="50px" style="margin-bottom:5px;" />
                        <p>Fashion</p>
                        </div>
                    </a>
                                    <a href="galeri.php?kat=19">
                        <div class="col-5">
                            <img src="img/5.png" width="50px" style="margin-bottom:5px;" />
                        <p>Olahraga</p>
                        </div>
                    </a>
                                    <a href="galeri.php?kat=18">
                        <div class="col-5">
                            <img src="img/1.png" width="50px" style="margin-bottom:5px;" />
                        <p>Makanan</p>
                        </div>
                    </a>
                                    <a href="galeri.php?kat=17">
                        <div class="col-5">
                            <img src="img/10.png" width="50px" style="margin-bottom:5px;" />
                        <p>Satwa Liar</p>
                        </div>
                    </a>
                                    <a href="galeri.php?kat=16">
                        <div class="col-5">
                            <img src="img/4.png" width="50px" style="margin-bottom:5px;" />
                        <p>Hewan Peliharaan</p>
                        </div>
                    </a>
                                    <a href="galeri.php?kat=15">
                        <div class="col-5">
                            <img src="img/3.png" width="50px" style="margin-bottom:5px;" />
                        <p>Bawah Air</p>
                        </div>
                    </a>
                                    <a href="galeri.php?kat=14">
                        <div class="col-5">
                            <img src="img/2.png" width="50px" style="margin-bottom:5px;" />
                        <p>Perjalanan</p>
                        </div>
                    </a>
                            </div>
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