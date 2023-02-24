<?php
	include('conn.php');
	
	$admin_id=$_POST['admin_id'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
		
	mysqli_query($conn,"insert into `admin` (admin_id, name, email, password) values ('$admin_id','$name','$email','$password')");
	header('location:read_admins.php');
?>