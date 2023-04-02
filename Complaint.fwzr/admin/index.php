<?php 
	session_start();
	include '../conn/koneksi.php';
	if(!isset($_SESSION['username'])){
		header('location:../index.php');
	}
	elseif($_SESSION['data']['level'] != "admin"){
		header('location:../index.php');
	}
 ?>

 
  <!DOCTYPE html>
  <html>
    <head>
    	<title>Aplikasi Pengaduan masyarakat</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 

      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Tilt+Neon&display=swap" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
  
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixion.css">
     <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css"> 
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  

      
     <style>
      @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');
*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
    text-decoration: none;
    list-style:none;
    font-family:'Poppins', sans-serif;
    
}:root{
    --bg-color:#4287ff;
    --text-color:#222327;
    --main-color:#0c3c52;  
}

body{
    min-height: 100vh;
    background: var(--bg-color);
    color: var(--text-color);
    background-color:aliceblue
    
}
svg{position: fixed;}
header{
    position: fixed;
    width: 100%;
    top: 0;
    right: 0;
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 28px 5% 28px 5%;
    transition: all .50s ease;
    height: 80px;
   background-repeat:no-repeat;
}
.logo{
    display: flex;
    align-items: center;

}.logo i{
    color: var(--main-color);
    font-size: 28px;
    margin-right: 3px;
}.logo span{
    color: var(--text-color);
    font-size: 1.7rem;
    font-weight: 400; font-family:'Fredoka One', cursive;
    
}header a{
    text-decoration: none;
    
}
.navbar{
    display: flex;
    margin-top: 10px;
    margin-right:50px;
    
}.navbar a{
    color: var(--text-color);
    font-size: 1.1rem;
    font-weight: 600;
    padding: 5px 0;
    margin: 0px 30px;
    transition: all .50s ease;
    text-decoration: none;
}
.navbar a:hover{
    color: var(--main-color);
    letter-spacing: 2px;
}
.navbar a.active{
    color: var(--main-color);
}
.main{
    display: flex;
    align-items: center;
}.main a{
    margin-left: -70px;
    color: var(--text-color);
    font-size: 1.1rem;
    font-weight: 500;
    transition: all .50s ease;
    margin-top:20px;
}
.user{
    display: flex;
    align-items: center;
}
.user i{
    color: var(--main-color);
    font-size: 28px;
    margin-right: 7px;
}
.main a:hover{
    color: var(--main-color);
    
}
#menu-icon{
    font-size: 35px;
    color: var(--text-color);
    cursor: pointer;
    z-index: 10001;
    display: none;
}
@media (max-width:1280px){
    header{
    padding: 14px 2%;
    transition: .2s;
    }
    .navbar a{
        padding: 5px 0;
        margin: 0px 20px;

    }
}

@media (max-width: 1090px){
    #menu-icon{
        display: block;
    }
    .navbar{
        position: absolute;
        top: 100%;
        right: -100%;
        width: 200px;
        height: 29vh;
        background: var(--main-color);
        display: flex;
        flex-direction: column;
        justify-content:flex-start;
        border-radius: 10px;
        transition: all .50s ease;
    }
    .navbar a{
        display: block;
        margin: 10px 0;
        padding: 0px 25px;
        transition: all .50s ease;
      
    }
    .navbar a:hover{
        color: var(--text-color);
        transform: translateY(5px);
    }
    .navbar a.active{
        color: var(--text-color);
    }
    .navbar.open{
        right: -2%;
    }
}
/* scrollbar */
::-webkit-scrollbar {
    width: 5px;
  }
  
  /* Track */
  ::-webkit-scrollbar-track {
    background: #f1f1f1; 
  }
   
  /* Handle */
  ::-webkit-scrollbar-thumb {
    background: #add8e6; 
  }
  
  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
    background: #0c3c52; 
  }
   
     </style>
    </head>

    <body >
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="
#c1dbfe" fill-opacity="1" d="M0,96L12.6,128C25.3,160,51,224,76,218.7C101.1,213,126,139,152,117.3C176.8,96,202,128,227,122.7C252.6,117,278,75,303,85.3C328.4,96,354,160,379,176C404.2,192,429,160,455,128C480,96,505,64,531,74.7C555.8,85,581,139,606,154.7C631.6,171,657,149,682,149.3C707.4,149,733,171,758,160C783.2,149,808,107,834,106.7C858.9,107,884,149,909,144C934.7,139,960,85,985,101.3C1010.5,117,1036,203,1061,202.7C1086.3,203,1112,117,1137,106.7C1162.1,96,1187,160,1213,181.3C1237.9,203,1263,181,1288,197.3C1313.7,213,1339,267,1364,250.7C1389.5,235,1415,149,1427,106.7L1440,64L1440,0L1427.4,0C1414.7,0,1389,0,1364,0C1338.9,0,1314,0,1288,0C1263.2,0,1238,0,1213,0C1187.4,0,1162,0,1137,0C1111.6,0,1086,0,1061,0C1035.8,0,1011,0,985,0C960,0,935,0,909,0C884.2,0,859,0,834,0C808.4,0,783,0,758,0C732.6,0,707,0,682,0C656.8,0,632,0,606,0C581.1,0,556,0,531,0C505.3,0,480,0,455,0C429.5,0,404,0,379,0C353.7,0,328,0,303,0C277.9,0,253,0,227,0C202.1,0,177,0,152,0C126.3,0,101,0,76,0C50.5,0,25,0,13,0L0,0Z"></path></svg>
        <header>
          
          <a href="#" class="logo"><span>Hi, <?php echo ucwords($_SESSION['data']['nama_petugas']); ?> </span></a>

          <ul class="navbar" >
            <li><a href="index.php?p=dashboard">Dashboard</a></li>
            <li><a href="index.php?p=pengaduan">Pengaduan</a></li>
            <li><a href="index.php?p=respon">Respon</a></li>
            <li><a href="index.php?p=registrasi">Registrasi</a></li>
            <li><a href="index.php?p=user">User</a></li>
            <li><a href="index.php?p=laporan">Laporan</a></li>
            
          </ul>

          <div class="main">
          <a href="../index.php"><img src="../img/logout.png" alt=""></a>
            <div class="bx bx-menu" id="menu-icon"></div>
          </div>
        </header>
        
    <div class="row">
      
      <div class="col s12 m9">
        
      <?php 
		if(@$_GET['p']==""){
			include_once 'dashboard.php';
		}
		elseif(@$_GET['p']=="dashboard"){
			include_once 'dashboard.php';
		}
		elseif(@$_GET['p']=="registrasi"){
			include_once 'registrasi.php';
		}
		elseif(@$_GET['p']=="regis_hapus"){
			$query = mysqli_query($koneksi,"DELETE FROM masyarakat WHERE nik='".$_GET['nik']."'");
			if($query){
				header('location:index.php?p=registrasi');
			}
		}
		elseif(@$_GET['p']=="pengaduan"){
			include_once 'pengaduan.php';
		}
		elseif(@$_GET['p']=="pengaduan_hapus"){
			$query=mysqli_query($koneksi,"SELECT * FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
			$data=mysqli_fetch_assoc($query);
			unlink('../img/'.$data['foto']);
			if($data['status']=="proses"){
				$delete=mysqli_query($koneksi,"DELETE FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
				header('location:index.php?p=pengaduan');
			}
			elseif($data['status']=="selesai"){
				$delete=mysqli_query($koneksi,"DELETE FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
				if($delete){
					$delete2=mysqli_query($koneksi,"DELETE FROM tanggapan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
					header('location:index.php?p=pengaduan');
				}	
			}

		}
		elseif(@$_GET['p']=="more"){
			include_once 'more.php';
		}
		elseif(@$_GET['p']=="respon"){
			include_once 'respon.php';
		}
		elseif(@$_GET['p']=="tanggapan_hapus"){
			
			$query = mysqli_query($koneksi,"DELETE FROM tanggapan WHERE id_tanggapan='".$_GET['id_tanggapan']."'");
			if($query){
				header('location:index.php?p=respon');
			}
		}
		elseif(@$_GET['p']=="user"){
			include_once 'user.php';
		}
		elseif(@$_GET['p']=="user_input"){
			include_once 'user_input.php';
		}
		elseif(@$_GET['p']=="user_edit"){
			include_once 'user_edit.php';
		}
		elseif(@$_GET['p']=="user_hapus"){
			$query = mysqli_query($koneksi,"DELETE FROM petugas WHERE id_petugas='".$_GET['id_petugas']."'");
			if($query){
				header('location:index.php?p=user');
			}
		}
		elseif(@$_GET['p']=="laporan"){
			include_once 'laporan.php';
		}
	 ?>
      </div>


    </div>




      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="../js/materialize.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

      <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('.sidenav');
          var instances = M.Sidenav.init(elems);
        });

        document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('.modal');
          var instances = M.Modal.init(elems);
        });

      </script>

    </body>
  </html>