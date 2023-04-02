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
		}
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
				<th><center>Petugas</center></th>
				<th><center>Tanggal Masuk</center></th>
				<th><center>Tanggal Ditanggapi</center></th>
				<th><center>Status</center></th>
				<th><center>Opsi</center></th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$query = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik INNER JOIN tanggapan ON pengaduan.id_pengaduan=tanggapan.id_pengaduan INNER JOIN petugas ON tanggapan.id_petugas=petugas.id_petugas ORDER BY tanggapan.id_pengaduan DESC");
		while ($r=mysqli_fetch_assoc($query)) { ?>
		<tr>
			<td><center><?php echo $no++; ?></center></td>
			<td><center><?php echo $r['nik']; ?></center></td>
			<td><center><?php echo $r['nama']; ?></center></td>
			<td><center><?php echo $r['nama_petugas']; ?></center></td>
			<td><center><?php echo $r['tgl_pengaduan']; ?></center></td>
			<td><center><?php echo $r['tgl_tanggapan']; ?></center></td>
			<td><center><?php echo $r['status']; ?></center></td>
			<td><center><a class="btn blue modal-trigger" href="#more?id_tanggapan=<?php echo $r['id_tanggapan'] ?>">More</a> <a class="btn blue lighten-2" style="color:#333; font-weight:500;" onclick="return confirm('Anda Yakin Ingin Menghapus Y/N')" href="index.php?p=tanggapan_hapus&id_tanggapan=<?php echo $r['id_tanggapan'] ?>">Hapus</a></center></td>
		

<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- Modal Structure -->
        <div id="more?id_tanggapan=<?php echo $r['id_tanggapan'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="detailh4">Detail</h4>
			<br>
			<img class="imgg" src="../img/done.jpg" alt="">
            <div class="col s12" id="detaildata">
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
				 ?><br><br><br><br>
				<br>
				<p><b>Pesan  :</b> <?php echo $r['isi_laporan']; ?></p>
				<br>
				<p><b>Respon  :</b> <?php echo $r['tanggapan']; ?></p>
            </div>

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