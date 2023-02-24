<?php
	$id=$_GET['id'];
	include('conn.php');
	mysqli_query($conn,"delete from `doctor` where doctor_id='$id'");
	header('location:read_doctors.php');
?>