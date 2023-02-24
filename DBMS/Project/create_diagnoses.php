<?php
	include('conn.php');
	
	$diagnosis_id=$_POST['diagnosis_id'];
	$doctor_id=$_POST['doctor_id'];
	$patient_id=$_POST['patient_id'];
	$ailment=$_POST['ailment'];
	$severity=$_POST['severity'];
	$medication=$_POST['medication'];
	$surgery=$_POST['surgery'];
		
	mysqli_query($conn,"insert into `diagnosis` (diagnosis_id, doctor_id, patient_id, ailment, severity, medication, surgery) values ('$diagnosis_id','$doctor_id','$patient_id','$ailment','$severity','$medication','$surgery')");
	header('location:read_diagnoses.php');
?>