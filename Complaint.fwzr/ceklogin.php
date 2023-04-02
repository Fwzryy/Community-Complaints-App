<?php 
// aktifkan session


// koneksi database
include 'conn/koneksi.php';
// menangkap data yang dikirim dari form 
if(isset($_POST['login'])){
	$username = mysqli_real_escape_string($koneksi,$_POST['username']);
	$password = mysqli_real_escape_string($koneksi,md5($_POST['password']));



$login = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username='$username' and password='$password'");
$cek = mysqli_num_rows($login);
$data = mysqli_fetch_assoc($login);

if($cek > 0){
	
	if($data['level']=="admin"){
		session_start();
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		header("location:admin/pageAdmin.php");
 
	}else if($data['level']=="petugas"){
		session_start();
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "petugas";
		header("location:petugas/index.php");
		}
	}else{
		header("location:index.php?pesan=gagal");

	}
}
 
?>