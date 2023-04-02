
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
		}.add a{border:1px  solid;width:150px; border:none; float:right; margin-right:105px;}
	</style>
</head>
<body>
<div class="lap">
<h4>Data Admin & Petugas</h4>
    
	<div class="add">
	  <a class="waves-effect waves-light btn modal-trigger blue" href="#modal1"><i class="material-icons">add</i></a>
	</div>
        <table>
          <thead>
              <tr>
			  <th><center>No</center></th>
					<th><center>Nama</center></th>
					<th><center>Username</center></th>
					<th><center>Telp</center></th>
					<th><center>Level</center></th>
                	<th><center>Opsi</center></th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$tampil = mysqli_query($koneksi,"SELECT * FROM petugas ORDER BY nama_petugas ASC");
		while ($r=mysqli_fetch_assoc($tampil)) { ?>
		<tr>
			<td><center><?php echo $no++; ?></center></td>
			<td><center><?php echo $r['nama_petugas']; ?></center></td>
			<td><center><?php echo $r['username']; ?></center></td>
			<td><center><?php echo $r['telp_petugas']; ?></center></td>
			<td><center><?php echo $r['level']; ?></center></td>
			<td><center><a class="btn blue modal-trigger" href="#user_edit<?php echo $r['id_petugas'] ?>">Edit</a> <a class="btn blue lighten-2"  style="color:#333; font-weight:500;" onclick="return confirm('Anda Yakin Ingin Menghapus Y/N')" href="index.php?p=user_hapus&id_petugas=<?php echo $r['id_petugas'] ?>">Hapus</a></center></td>

<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- Modal Structure -->
        <div id="user_edit<?php echo $r['id_petugas'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="detailh4">Edit</h4>
			<form method="POST">
				<div class="col s12 input-field">
					<label for="nama">Nama</label>
					<input hidden type="text" name="id_petugas" value="<?php echo $r['id_petugas']; ?>">
					<input id="nama" type="text" name="nama" value="<?php echo $r['nama_petugas']; ?>">
				</div>
				<div class="col s12 input-field">
					<label for="username">Username</label>		
					<input id="username" type="text" name="username" value="<?php echo $r['username']; ?>"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="telp">Telp</label>
					<input id="telp" type="number" name="telp" value="<?php echo $r['telp_petugas']; ?>"><br><br>
				</div>
				<div class="col s12 input-field">
					<p>
						<label>
						  <input value="admin" class="with-gap" name="level" type="radio" <?php if($r['level']=="admin"){echo "checked";} ?> />
						  <span>Admin</span>
						</label>
						<label>
						  <input value="petugas" class="with-gap" name="level" type="radio" <?php if($r['level']=="petugas"){echo "checked";} ?> />
						  <span>Petugas</span>
						</label>
					</p>
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="Update" value="Simpan" class="btn right">
				</div>
			</form>

			<?php 
				if(isset($_POST['Update'])){
					// echo $_POST['nama'].$_POST['username'].$_POST['telp'].$_POST['level'];
					$update=mysqli_query($koneksi,"UPDATE petugas SET nama_petugas='".$_POST['nama']."',username='".$_POST['username']."',telp_petugas='".$_POST['telp']."',level='".$_POST['level']."' WHERE id_petugas='".$_POST['id_petugas']."' ");
					if($update){
						echo "<script>alert('Data di Update')</script>";
						echo "<script>location='index.php?p=user'</script>";
					}
				}
			 ?>
          </div>
          <div class="modal-footer">
      
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
					<select class="default" name="level">
						<option selected disabled="">Pilih Level</option>
						<option value="admin">Admin</option>
						<option value="petugas">Petugas</option>
					</select>
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="input" value="Simpan" class="btn right">
				</div>
			</form>

			<?php 
				if(isset($_POST['input'])){
					$password = md5($_POST['password']);

					$query=mysqli_query($koneksi,"INSERT INTO petugas VALUES (NULL,'".$_POST['nama']."','".$_POST['username']."','".$password."','".$_POST['telp']."','".$_POST['level']."')");
					if($query){
						echo "<script>alert('Data Ditambahkan')</script>";
						echo "<script>location='index.php?p=user'</script>";
					}
				}
			 ?>
          </div>
          <div class="modal-footer">
           
          </div>
        </div>
			</body>
			</html>