<?php
	$host_name = 'localhost';
	$database_name = 'admin_mapin';
	$username = 'root';
	$password = '';
	
	$koneksi = mysqli_connect($host_name,$username,$password,$database_name);
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
	}
?>