<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard</title>
	<!-- STYLING DASHBOARD -->
	<style>
		   @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');
		*{
			padding: 0;
			margin: 0;
		}body{background-color:#fff;}
		h3{
			font-weight:400;
			margin-top:200px;
			font-family:'Fredoka One', cursive;
			color:#00213a;	
		}
		.bgdashboard{
			margin-top:170px; border:none; width:650px; height:655px; background:url('../img/layerr.png'); background-size:cover;  margin-right:200px; margin-bottom:250px;
			
		}.bgdashboard h3{margin-top:70px;margin-left:180px; 
		}
		.lap-status{
			width:400px;
			margin-left:145px;
		}
		.ilu img{
			width:525px;
			height:525px;
			margin-top:-320px;
			margin-left:800px;
		}
		span{
			font-family:'Fredoka One', cursive; 
			color:#00213a; 
			letter-spacing:1.2px; 
			font-size:35px;
		}
		.dashed{ width:300px; border:2px dashed #00213a; }
		.row{ height:800px	;}
	</style>
</head>
<body>

	<div class="row">
		<div class="bgdashboard">
		<br><br><br><br><br>
		<h3>Dashboard !</h3>
		<div class="lap-status">
		  <div>
		    <div class="card-content">
			<?php 
				$query = mysqli_query($koneksi,"SELECT * FROM pengaduan");
				$jlmmember = mysqli_num_rows($query);
				if($jlmmember<1){
					$jlmmember=0;
				}
			 ?>
		      <span>Laporan Masuk <?php echo $jlmmember; ?></span>
		      <p></p>
		    </div>
		  </div>
		</div>	

		<div class="lap-status">
		    <div>
		    <div class="card-content">
			<?php 
				$query = mysqli_query($koneksi,"SELECT * FROM pengaduan WHERE status='selesai'");
				$jlmmember = mysqli_num_rows($query);
				if($jlmmember<1){
					$jlmmember=0;
				}
			 ?>
		      <span>Laporan Selesai <?php echo $jlmmember; ?></span>
		      <p></p>
		    </div>
		  </div>
		  <br>
		  <p class="dashed"></p>
		</div>
		 <div class="ilu"><img src="../img/ilust.jpg" alt=""></div> 
	</div>
	</div>

</body>
</html>