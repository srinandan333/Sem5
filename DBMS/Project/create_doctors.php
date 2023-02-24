<?php
	include('conn.php');
	
	$doctor_id=$_POST['doctor_id'];
	$name=$_POST['name'];
	$experience=$_POST['experience'];
	$specialization=$_POST['specialization'];
		
	mysqli_query($conn,"insert into `doctor` (doctor_id, name, experience, specialization) values ('$doctor_id','$name','$experience','$specialization')");
	header('location:read_doctors.php');
?>