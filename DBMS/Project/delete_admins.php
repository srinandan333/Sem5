<?php
	$id=$_GET['id'];
	include('conn.php');
	mysqli_query($conn,"delete from `admin` where admin_id='$id'");
	header('location:read_admins.php');
?>