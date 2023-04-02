
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		*{
			
		}
		.sub{font-size:28px; text-transform:uppercase; letter-spacing:0.3px; text-align:center;}
		textarea{width:850px; resize:none; height:100px; border-radius:3px; font-size:16px; border:2px dashed #0c3c52; transition:0.9s;}
		textarea:hover{transform:scale(1.027); transition:0.9s;}
		textarea:focus{outline: none !important; border-color: #0c3c52; }
		.tulislap{padding:20px;}
		.logo-i{width:70px; height:70px;}
		 input[type="file"] { cursor: pointer;background-color: lightblue; color: #146c94; padding: 10px 20px; width:140px;  border:none; }
      	#upload { opacity: 0;   position: absolute;  z-index: -1;      }
	  	.btn-sub{padding: 12px; border: 1px solid; width: 265px; background-color:lightblue; color:#146c94; border:none; transition:0.9s; }
	  	.btn-sub:hover{ transition:0.9s; cursor:default; border-radius:20px 0px 20px 0px; box-shadow:3px 3px 3px 0 #146c94;}
		input[type="file"] {  display: none;}
		.upload {border: 1px solid #ccc;display: inline-block;   padding: 6px 22px; cursor: pointer; background-color:lightblue;}
		.tulis{ margin-top:80px;}
	</style>
</head>
<body>
	

<br><br><br><br><br>
<center>
	<div class="tulis">
<table class="tablaporan" style="width: 50%;">

	<tr><td><h4 class="sub"><img class ="logo-i" src="../img/notebook.gif" alt="">Laporan</h4></td></tr>
	
	<tr>
		<td class="tulislap"  >
			<form method="POST" enctype="multipart/form-data">
				<textarea class="" name="laporan" placeholder="Tulis Laporan"></textarea><br><br>
				<span>Pilih gambar →</span>
				<label class="upload">
				<input type="file" name="foto">Upload files</label><br><br>
				<input type="submit" name="kirim" value="Kirim" class="btn-sub">
			</form>
		</td>

	</tr>

	</div>
			<tr>
				<td>
			<table  class="responsive-table highlight" style="  border:none; height:100px; width:100%;  "  ><br><br>
			<hr>
			<h4 class="sub" style="padding-bottom:30px;"><img class ="logo-i" src="../img/list.gif" alt="">laporan</h4>
			
				<tr >
					<td><center>NO</center></td>
					<td><center>NIK</center></td>
					<td><center>NAMA</center></td>
					<td><center>TANGGAL MASUK</center></td>
					<td><center>STATUS</center></td>
					<td><center>OPSI</center></td>
				</tr>
				<?php 
					$no=1;
					$pengaduan = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik INNER JOIN tanggapan ON pengaduan.id_pengaduan=tanggapan.id_pengaduan INNER JOIN petugas ON tanggapan.id_petugas=petugas.id_petugas WHERE pengaduan.nik='".$_SESSION['data']['nik']."' ORDER BY pengaduan.id_pengaduan DESC");
					while ($r=mysqli_fetch_assoc($pengaduan)) { ?>
					<tr>
						<td><center><?php echo $no++; ?></center></td>
						<td><center><?php echo $r['nik']; ?></center></td>
						<td><center><?php echo $r['nama']; ?></center></td>
						<td><center><?php echo $r['tgl_pengaduan']; ?></center></td>
						<td><center><?php echo $r['status']; ?></center></td>
						<td><center>
				
							<a class="btn red" onclick="return confirm('Anda Yakin Ingin Menghapus Y/N')" href="index.php?p=pengaduan_hapus&id_pengaduan=<?php echo $r['id_pengaduan'] ?>">Hapus</a></center></td>


         <!-- <div id="tanggapan&id_pengaduan=<?php echo $r['id_pengaduan'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="orange-text">Detail</h4>
            <div class="col s12">
				<p>NIK : <?php echo $r['nik']; ?></p>
            	<p>Dari : <?php echo $r['nama']; ?></p>
            	<p>Petugas : <?php echo $r['nama_petugas']; ?></p>
				<p>Tanggal Masuk : <?php echo $r['tgl_pengaduan']; ?></p>
				<p>Tanggal Ditanggapi : <?php echo $r['tgl_tanggapan']; ?></p>
				<?php 
					if($r['foto']=="kosong"){ ?>
						<img src="../img/noImage.png" width="100">
				<?php	}else{ ?>
					<img width="100" src="../img/<?php echo $r['foto']; ?>">
				<?php }
				 ?>
				<br><b>Pesan</b>
				<p><?php echo $r['isi_laporan']; ?></p>
				<br><b>Respon</b>
				<p><?php echo $r['tanggapan']; ?></p>
            </div>

          </div>
          <div class="modal-footer col s12">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>  -->


					</tr>
				<?php	}
				 ?>
			</table>

		</td>
	</tr>
</table></center>
<?php 
	
	 if(isset($_POST['kirim'])){
	 	$nik = $_SESSION['data']['nik'];
	 	$tgl = date('Y-m-d');


	 	$foto = $_FILES['foto']['name'];
	 	$source = $_FILES['foto']['tmp_name'];
	 	$folder = './../img/';
	 	$listeks = array('jpg','png','jpeg');
	 	$pecah = explode('.', $foto);
	 	$eks = $pecah['1'];
	 	$size = $_FILES['foto']['size'];
	 	$nama = date('dmYis').$foto;

		if($foto !=""){
		 	if(in_array($eks, $listeks)){
		 		if($size<=1000000){
					move_uploaded_file($source, $folder.$nama);
					$query = mysqli_query($koneksi,"INSERT INTO pengaduan VALUES (NULL,'$tgl','$nik','".$_POST['laporan']."','$nama','proses')");

		 			if($query){
			 			echo "<script>alert('Pengaduan Akan Segera di Proses')</script>";
			 			echo "<script>location='index.php';</script>";
		 			}

		 		}
		 		else{
		 			echo "<script>alert('Ukuran Gambar Tidak Lebih Dari 1MB')</script>";
		 		}
		 	}
		 	else{
		 		echo "<script>alert('Format File Tidak Di Dukung')</script>";
		 	}
		}
		else{
			$query = mysqli_query($koneksi,"INSERT INTO pengaduan VALUES (NULL,'$tgl','$nik','".$_POST['laporan']."','noImage.png','proses')");
			if($query){
			 	echo "<script>alert('Pengaduan Akan Segera Ditanggapi')</script>";
	 			echo "<script>location='index.php';</script>";
 			}
		}

	 }

 ?>

</body>
</html>