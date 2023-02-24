<?php
	include('conn.php');
	$id=$_GET['id'];
	
	$diagnosis_id=$_POST['diagnosis_id'];
	$doctor_id=$_POST['doctor_id'];
	$patient_id=$_POST['patient_id'];
	$ailment=$_POST['ailment'];
	$severity=$_POST['severity'];
	$medication=$_POST['medication'];
	$surgery=$_POST['surgery'];

	mysqli_query($conn,"update `diagnosis` set diagnosis_id='$diagnosis_id', doctor_id='$doctor_id', patient_id='$patient_id', ailment='$ailment', severity='$severity', medication='$medication', surgery='$surgery' where diagnosis_id='$id'");
	header('location:read_diagnoses.php');
?>