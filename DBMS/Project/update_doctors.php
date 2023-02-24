<?php
	include('conn.php');
	$id=$_GET['id'];
	
	$doctor_id=$_POST['doctor_id'];
	$name=$_POST['name'];
	$experience=$_POST['experience'];
	$specialization=$_POST['specialization'];

	mysqli_query($conn,"update `doctor` set doctor_id='$doctor_id', name='$name', experience='$experience', specialization='$specialization' where doctor_id='$id'");
	header('location:read_doctors.php');
?>