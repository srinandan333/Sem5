<?php
	$id=$_GET['id'];
	include('conn.php');
	mysqli_query($conn,"delete from `appointment` where appointment_id='$id'");
	header('location:read_appointments.php');
?>