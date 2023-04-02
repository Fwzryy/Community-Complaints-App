
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN USER</title>
	<link rel="stylesheet" href="../css/login.css">
</head>


<body>
<div class="container">
<div class="title">LOGIN</div>
<div class="content">
	<form method="POST">
	<div class="user-details">

		<div class="input-box">
			<label for="username" class="details" >Username</label>
			<input type="text"  placeholder="Enter your username" name="username" required>
		</div>
		<div class="input-box">
			<label for="password" class="details">Password</label>
			<input type="password" placeholder="Enter your password" name="password" required>
		</div>
		<input type="submit" name="login"  value="Login" class="button">

	</form>
	</div>
</div>
</div>

<?php 
		include '../conn/koneksi.php';
		if(@$_GET['p']==""){
			include_once 'login.php';
		}
		elseif(@$_GET['p']=="login"){
			include_once 'login.php';
		}
		elseif(@$_GET['p']=="logout"){
			include_once 'logout.php';
		}
	?>
	
<?php 
	if(isset($_POST['login'])){
		$username = mysqli_real_escape_string($koneksi,$_POST['username']);
		$password = mysqli_real_escape_string($koneksi,md5($_POST['password']));
	
		$sql = mysqli_query($koneksi,"SELECT * FROM masyarakat WHERE username='$username' AND password='$password' ");
		$cek = mysqli_num_rows($sql);
		$data = mysqli_fetch_assoc($sql);


		if($cek>0){
			session_start();
			$_SESSION['username']=$username;
			$_SESSION['data']=$data;
			$_SESSION['level']='masyarakat';
			header('location:../user/index.php');
		}
		else{
			echo "<script>alert('Gagal Login Sob')</script>";
		}

	}
	
    ?>


</body>
</html>