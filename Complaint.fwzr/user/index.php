<?php 
	session_start();
	error_reporting(0);
	include '../conn/koneksi.php';
	if(!isset($_SESSION['username'])){
		header('location:../index.php');
	}
	elseif($_SESSION['level'] != "masyarakat"){
		header('location:../index.php');
	}
 ?>
  <!DOCTYPE html >
  <html class="h-100" lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="description" content="A growing collection of ready to use components for the CSS framework Bootstrap 5">
      <title>COMMUNITY COMPLAINTS.</title>
      <!-- Font google -->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Tilt+Neon&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="../css/..css">
      <!-- package -->  
      <link rel="stylesheet" href="../css/theme.min.css">
     
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixion.css">
      <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    
      <!-- STYLE -->

    </head>
    <body>
       
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="
#add8e6" fill-opacity="1" d="M0,96L12.6,128C25.3,160,51,224,76,218.7C101.1,213,126,139,152,117.3C176.8,96,202,128,227,122.7C252.6,117,278,75,303,85.3C328.4,96,354,160,379,176C404.2,192,429,160,455,128C480,96,505,64,531,74.7C555.8,85,581,139,606,154.7C631.6,171,657,149,682,149.3C707.4,149,733,171,758,160C783.2,149,808,107,834,106.7C858.9,107,884,149,909,144C934.7,139,960,85,985,101.3C1010.5,117,1036,203,1061,202.7C1086.3,203,1112,117,1137,106.7C1162.1,96,1187,160,1213,181.3C1237.9,203,1263,181,1288,197.3C1313.7,213,1339,267,1364,250.7C1389.5,235,1415,149,1427,106.7L1440,64L1440,0L1427.4,0C1414.7,0,1389,0,1364,0C1338.9,0,1314,0,1288,0C1263.2,0,1238,0,1213,0C1187.4,0,1162,0,1137,0C1111.6,0,1086,0,1061,0C1035.8,0,1011,0,985,0C960,0,935,0,909,0C884.2,0,859,0,834,0C808.4,0,783,0,758,0C732.6,0,707,0,682,0C656.8,0,632,0,606,0C581.1,0,556,0,531,0C505.3,0,480,0,455,0C429.5,0,404,0,379,0C353.7,0,328,0,303,0C277.9,0,253,0,227,0C202.1,0,177,0,152,0C126.3,0,101,0,76,0C50.5,0,25,0,13,0L0,0Z"></path></svg>
        <header>
          
          <a href="#" class="logo"><span>Hi, <?php echo $_SESSION['username'];  ?> </span></a>
          <ul class="navbar">
            <li><a href="#" class="active">Dashboard</a></li>
            <li><a href="detail.php">Detail Laporan</a></li>
          </ul>

          <div class="main">
          <a href="../index.php"><img src="../img/logout.png" alt=""></a>
            <div class="bx bx-menu" id="menu-icon"></div>
          </div>
        </header>
        
   
        
	<?php 
		if(@$_GET['p']==""){
			include_once 'dashboard.php';
		}
		elseif(@$_GET['p']=="dashboard"){
			include_once 'dashboard.php';
		}
		elseif(@$_GET['p']=="pengaduan_hapus"){
			$query=mysqli_query($koneksi,"SELECT * FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
			$data=mysqli_fetch_assoc($query);
			unlink('../img/'.$data['foto']);
			if($data['status']=="proses"){
				$delete=mysqli_query($koneksi,"DELETE FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
				header('location:index.php?p=dashboard');
			}
			elseif($data['status']=="selesai"){
				$delete=mysqli_query($koneksi,"DELETE FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
				if($delete){
					$delete2=mysqli_query($koneksi,"DELETE FROM tanggapan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
					header('location:index.php?p=dashboard');
				}	
			}

		}
		elseif(@$_GET['p']=="more"){
			include_once 'more.php';
		}
	 ?>
     






      <!--JavaScript at end of body for optimized loading-->


    </body>
  </html>