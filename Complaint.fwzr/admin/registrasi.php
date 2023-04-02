

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registrasi</title>
	<!-- STYLING CSS -->
	<style>
		 @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');
		.lap{margin-top:300px; width:1200px; text-align:center; margin-left:10%; border:2px dashed #0c3c52;}
		
		 h4{margin-top:-100px; font-family:'Fredoka One', cursive; letter-spacing:1.2px; margin-left:20px; color:#0c3c52;}
		.detailh4{ font-size:35px; font-weight:500;  font-family:'Fredoka One', cursive;  letter-spacing:1.2px;  color:#0c3c52;}
		#detaildata p{padding:3px; text-align:left;}
		#detaildata img{float:left;}
		#btnkirim{width:327px;}
		.modal-content .imgg{
			width:300px; float:right;
		
		}
		.modal-content #detaildata{
			margin-top:-290px;
		}.add a{border:1px  solid;width:150px; border:none; float:right; margin-right:85px;}
	</style>
</head>
<body>
	
		<div class="lap">

		  <h4>Data Masyarakat</h4>
    
          <div class="add">
            <a class="waves-effect waves-light btn modal-trigger blue" href="#modal1"><i class="material-icons">add</i></a>
          </div>
        <table>
          <thead>
              <tr>
					<th><center>No</center></th>
					<th><center>NIK</center></th>
					<th><center>Nama</center></th>
					<th><center>Username</center></th>
					<th><center>Telp</center></th>
                	<th><center>Opsi</center></th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$query = mysqli_query($koneksi,"SELECT * FROM masyarakat ORDER BY nik ASC");
		while ($r=mysqli_fetch_assoc($query)) { ?>
		<tr>
			<td><center><?php echo $no++; ?></center></td>
			<td><center><?php echo $r['nik']; ?></center></td>
			<td><center><?php echo $r['nama']; ?></center></td>
			<td><center><?php echo $r['username']; ?></center></td>
			<td><center><?php echo $r['telp']; ?></center></td>
			<td><center><a class="btn blue modal-trigger" href="#regis_edit?nik=<?php echo $r['nik'] ?>">Edit</a>
			 <a onclick="return confirm('Anda Yakin Ingin Menghapus Y/N')" class="btn blue lighten-2" style="color:#333; font-weight:500;"  href="index.php?p=regis_hapus&nik=<?php echo $r['nik'] ?>">Hapus</a></center></td>

<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- Modal Structure -->
        <div id="regis_edit?nik=<?php echo $r['nik'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="detailh4">Edit</h4>
			<form method="POST">
				<div class="col s12 input-field">
					<label for="nik">NIK</label>
					<input id="nik" type="number" name="nik" value="<?php echo $r['nik']; ?>">
				</div>
				<div class="col s12 input-field">
					<label for="nama">Nama</label>
					<input id="nama" type="text" name="nama" value="<?php echo $r['nama']; ?>">
				</div>
				<div class="col s12 input-field">
					<label for="username">Username</label>		
					<input id="username" type="text" name="username" value="<?php echo $r['username']; ?>"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="telp">Telp</label>
					<input id="telp" type="number" name="telp" value="<?php echo $r['telp']; ?>"><br><br>
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="Update" value="Simpan" class="btn right">
				</div>
			</form>

			<?php 
				if(isset($_POST['Update'])){
					$update=mysqli_query($koneksi,"UPDATE masyarakat SET nik='".$_POST['nik']."',nama='".$_POST['nama']."',username='".$_POST['username']."',telp='".$_POST['telp']."' WHERE nik='".$r['nik']."' ");
					if($update){
						echo "<script>alert('Data Tersimpan')</script>";
						echo "<script>location='location:index.php?p=registrasi';</script>";
					}
				}
			 ?>
          </div>
          <div class="modal-footer col s12">
         
          </div>
        </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->

		</tr>
            <?php  }
             ?>

          </tbody>
        </table> 
			</div>     

        <!-- Modal Structure -->
        <div id="modal1" class="modal">
          <div class="modal-content">
            <h4 class="detailh4">Add</h4>
			<form method="POST">
				<div class="col s12 input-field">
					<label for="nik">NIK</label>
					<input id="nik" type="number" name="nik">
				</div>
				<div class="col s12 input-field">
					<label for="nama">Nama</label>
					<input id="nama" type="text" name="nama">
				</div>
				<div class="col s12 input-field">
					<label for="username">Username</label>		
					<input id="username" type="text" name="username"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="password">Password</label>
					<input id="password" type="password" name="password"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="telp">Telp</label>
					<input id="telp" type="number" name="telp"><br><br>
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="simpan" value="Simpan" class="btn right">
				</div>
			</form>

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