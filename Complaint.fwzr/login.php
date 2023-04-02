<?php include 'conn/koneksi.php' ?>
<link rel="stylesheet" href="css/theme.min.css">
<link rel="stylesheet" href="css/styleAdmin.css">

<style>

/* inter-300 - latin */
@font-face {
  font-family: 'Inter';
  font-style: normal;
  font-weight: 300;
  font-display: swap;
  src: local(''),
       url('./fonts/inter-v12-latin-300.woff2') format('woff2'), /* Chrome 26+, Opera 23+, Firefox 39+ */
       url('./fonts/inter-v12-latin-300.woff') format('woff'); /* Chrome 6+, Firefox 3.6+, IE 9+, Safari 5.1+ */
}

@font-face {
  font-family: 'Inter';
  font-style: normal;
  font-weight: 500;
  font-display: swap;
  src: local(''),
       url('./fonts/inter-v12-latin-500.woff2') format('woff2'), /* Chrome 26+, Opera 23+, Firefox 39+ */
       url('./fonts/inter-v12-latin-500.woff') format('woff'); /* Chrome 6+, Firefox 3.6+, IE 9+, Safari 5.1+ */
}
@font-face {
  font-family: 'Inter';
  font-style: normal;
  font-weight: 700;
  font-display: swap;
  src: local(''),
       url('./fonts/inter-v12-latin-700.woff2') format('woff2'), /* Chrome 26+, Opera 23+, Firefox 39+ */
       url('./fonts/inter-v12-latin-700.woff') format('woff'); /* Chrome 6+, Firefox 3.6+, IE 9+, Safari 5.1+ */
}
</style>
<div class="h-100 container-fluid">
      <div class="h-100 row d-flex align-items-stretch">
          <div class="col-12 col-md-7 col-lg-6 d-flex align-items-start flex-column px-vw-5">
          
            <header class="mb-auto py-vh-2 col-12">
              <a class="navbar-brand pe-4 fs-4" href="../index.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-layers-half" viewbox="0 0 16 16">
              <path d="M8.235 1.559a.5.5 0 0 0-.47 0l-7.5 4a.5.5 0 0 0 0 .882L3.188 8 .264 9.559a.5.5 0 0 0 0 .882l7.5 4a.5.5 0 0 0 .47 0l7.5-4a.5.5 0 0 0 0-.882L12.813 8l2.922-1.559a.5.5 0 0 0 0-.882l-7.5-4zM8 9.433 1.562 6 8 2.567 14.438 6 8 9.433z"/>
              </svg>
              <span class="ms-1 fw-bolder">fwzryy</span>
              </a>
            </header>

            <main class="mb-auto col-12" >
              <h1>Login</h1>
              
          <form  method="POST">
            <div class="col-12 col-lg-10 col-xl-8">
              <div class="mb-3">
                <label class="form-label" for="username">Username</label>
                <input type="text" class="form-control form-control-lg" name="username" id="username" required>
              </div>

              <div class="mb-3">
                <label class="form-label" for="password">Password</label>
                 <input type="password" class="form-control form-control-lg" name="password" id="password" required>
              </div>

			  <input type="submit" name="login" value="Submit" style="width: 40%;" class="btn btn-primary btn-xl">
           </div> 
         </form>

            </main>
        </div>
            <div class="col-12 col-md-5 col-lg-6 bg-cover" style="background-image: url('img/webp/anime.jpg'); "></div>
        </div>

      </div>
 <!-- <h3>Login!</h3>
	<form method="POST">
		<div class="input_field">
			<label for="username">Username</label>
			<input id="username" type="text" name="username" required>
		</div>
		<div class="input_field">
			<label for="password">Passowrd</label>
			<input id="password" type="password" name="password" required>
		</div>
		<input type="submit" name="login" value="Login" class="btn orange" style="width: 100%;">
	</form>  -->

<?php 

	if(isset($_POST['login'])){
		$username = mysqli_real_escape_string($koneksi,$_POST['username']);
		$password = mysqli_real_escape_string($koneksi,md5($_POST['password']));
	
		$sql = mysqli_query($koneksi,"SELECT * FROM masyarakat WHERE username='$username' AND password='$password' ");
		$cek = mysqli_num_rows($sql);
		$data = mysqli_fetch_assoc($sql);
	
		$sql2 = mysqli_query($koneksi,"SELECT * FROM petugas WHERE username='$username' AND password='$password' ");
		$cek2 = mysqli_num_rows($sql2);
		$data2 = mysqli_fetch_assoc($sql2);

		// if($cek>0){
		// 	// session_start();
		// 	// // $_SESSION['username']=$username;
		// 	// // $_SESSION['data']=$data;
		// 	// // $_SESSION['level']='masyarakat';
		// 	// header('location:masyarakat/');
		// }
		if($cek2>0){
			if($data2['level']=="admin"){
				session_start();
				$_SESSION['username']=$username;
				$_SESSION['data']=$data2;
				header('location:admin/index.php');
			}
			elseif($data2['level']=="petugas"){
				session_start();
				$_SESSION['username']=$username;
				$_SESSION['data']=$data2;
				header('location:petugas/');
			}
		}
		else{
			echo "<script>alert('Gagal Login Sob')</script>";
		}

	}
 ?>