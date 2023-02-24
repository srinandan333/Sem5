<?php
	include('conn.php');
	
	$patient_id=$_POST['patient_id'];
	$name=$_POST['name'];
	$gender=$_POST['gender'];
	$dob=$_POST['dob'];
		
	mysqli_query($conn,"insert into `patient` (patient_id, name, gender, dob) values ('$patient_id','$name','$gender','$dob')");
	header('location:read_patients.php');
?>