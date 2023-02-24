<?php
	include('conn.php');
	$id=$_GET['id'];
	
	$patient_id=$_POST['patient_id'];
	$name=$_POST['name'];
	$gender=$_POST['gender'];
	$dob=$_POST['dob'];

	mysqli_query($conn,"update `patient` set patient_id='$patient_id', name='$name', gender='$gender', dob='$dob' where patient_id='$id'");
	header('location:read_patients.php');
?>