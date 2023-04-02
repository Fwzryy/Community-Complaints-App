<?php include 'conn/koneksi.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registrasi</title>
	<link rel="stylesheet" href="css/signup.css">
</head>

<body>
	
		<div class="container">
		<div class="title">Daftar</div>
		<div class="content">
		<form method="POST">
		<div class="user-details">
            
		<div class="input-box">
			<label for="nik">NIK</label>
			<input id="nik" type="number" name="nik">
		</div>
		<div  class="input-box">
			<label for="nama">Nama</label>
			<input id="nama" type="text" name="nama">
		</div>
		<div  class="input-box">
			<label for="username">Username</label>		
			<input id="username" type="text" name="username"><br><br>
		</div>
		<div class="input-box">
			<label for="password">Password</label>
			<input id="password" type="password" name="password"><br><br>
		</div>
		<div  class="input-box">
			<label for="telp">Telp</label>
			<input id="telp" type="number" name="telp"><br><br>
		</div>
		<div  class="input-box">
			<input type="submit" name="simpan" value="Simpan" class="button">
		</div>

		</form>

        <!-- Modal Structure -->
        <div id="modal1" class="modal">
          <div class="modal-content">
            <h4 class="detailh4">
			<marquee behavior="" direction=""
			style="font-size:20px; font-weight:600; color:#142429;">
			REGISTRASI MASYARAKAT
			</marquee></h4>
		
		
			<?php 
				if(isset($_POST['simpan'])){
					$password = md5($_POST['password']);

					$query=mysqli_query($koneksi,"INSERT INTO masyarakat VALUES ('".$_POST['nik']."','".$_POST['nama']."','".$_POST['username']."','".$password."','".$_POST['telp']."')");
					if($query){
						echo "<script>alert('Data Tesimpan')</script>";
						echo "<script>location='location:index.php?p=registrasi';</script>";
					}
				}
			 ?>
          </div>
          <div class="modal-footer col s12">
            
          </div>
        </div>

			</body>
			</html>