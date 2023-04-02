<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pengaduan proses</title>
	<!-- STYLING CSS -->
	<style>
		 @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');
		.lap{margin-top:300px; width:800px; text-align:center; margin-left:30%; border:2px dashed #0c3c52;}
		
		 h4{margin-top:-100px; font-family:'Fredoka One', cursive; letter-spacing:1.2px; margin-left:20px; color:#0c3c52;}
		.detailh4{ font-size:35px; font-weight:500;  font-family:'Fredoka One', cursive;  letter-spacing:1.2px;  color:#0c3c52;}
		#detaildata p{padding:3px; text-align:left;}
		#detaildata img{float:left;}
		#btnkirim{width:327px;}
	</style>
</head>
<body>


	<div class="lap">
      <h4>Community Complaints !</h4>
        <table>
          <thead>
              <tr>
				<th><center>No</center></th>
				<th><center>NIK</center></th>
				<th><center>Nama</center></th>
				<th><center>Tanggal Masuk</center></th>
				<th><center>Status</center></th>
				<th><center>Opsi</center></th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$query = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik ORDER BY pengaduan.id_pengaduan DESC");
		while ($r=mysqli_fetch_assoc($query)) { ?>
		<tr>
			<td><center><?php echo $no++; ?></center></td>
			<td><center><?php echo $r['nik']; ?></center></td>
			<td><center><?php echo $r['nama']; ?></center></td>
			<td><center><?php echo $r['tgl_pengaduan']; ?></center></td>
			<td><center><?php echo $r['status']; ?></center></td>
			<td><center><a class="btn modal-trigger blue" href="#more?id_pengaduan=<?php echo $r['id_pengaduan'] ?>">More</a>
			<a class="btn blue lighten-3" style="color:#333; font-weight:500;" onclick="return confirm('Anda Yakin Ingin Menghapus Y/N')" href="index.php?p=pengaduan_hapus&id_pengaduan=<?php echo $r['id_pengaduan'] ?>">Hapus</a>
		</center>
		</td>

<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- Modal Structure -->
        <div id="more?id_pengaduan=<?php echo $r['id_pengaduan'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="detailh4">Detail</h4>
            <div class="col s12 m6" id="detaildata">
				<p>NIK : <?php echo $r['nik']; ?></p>
            	<p>Dari : <?php echo $r['nama']; ?></p>
				<p>Tanggal Masuk : <?php echo $r['tgl_pengaduan']; ?></p>
				<?php 
					if($r['foto']=="kosong"){ ?>
						<img src="../img/noImage.png" width="100">
				<?php	}else{ ?>
					<img width="100" src="../img/<?php echo $r['foto']; ?>">
				<?php }
				 ?><br><br><br><br>
				<br>
				<p><b>Pesan :</b> <?php echo $r['isi_laporan']; ?></p>
				<p>Status : <?php echo $r['status']; ?></p>
            </div>


            <?php 
            	if($r['status']=="proses"){ ?>
	            <div class="col s12 m6">
					<form method="POST">
						<div class="col s12 input-field">
							<label for="textarea">Tanggapan</label>
							<textarea id="textarea" name="tanggapan" class="materialize-textarea"></textarea>
						</div>
						<div class="col s12 input-field">
							<input type="submit" name="tanggapi" value="Kirim" class="btn right blue lighten-2" id="btnkirim">
						</div>
					</form>
	            </div>
            <?php	}
             ?>

			<?php 
				if(isset($_POST['tanggapi'])){
					$tgl = date('Y-m-d');
					$query = mysqli_query($koneksi,"INSERT INTO tanggapan VALUES (NULL,'".$r['id_pengaduan']."','".$tgl."','".$_POST['tanggapan']."','".$_SESSION['data']['id_petugas']."')");
					if($query){
						$update=mysqli_query($koneksi,"UPDATE pengaduan SET status='selesai' WHERE id_pengaduan='".$r['id_pengaduan']."'");
						if($update){
							echo "<script>alert('Tanggapan Terkirim')</script>";
							echo "<script>location='index.php?p=pengaduan';</script>";
						}
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

	</body>
</html>       
