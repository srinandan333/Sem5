<?php
	include('conn.php');
	$id=$_GET['id'];
	
	$admin_id=$_POST['admin_id'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];

	mysqli_query($conn,"update `admin` set admin_id='$admin_id', name='$name', email='$email', password='$password' where admin_id='$id'");
	header('location:read_admins.php');
?>