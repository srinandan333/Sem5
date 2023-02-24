<?php
	include('conn.php');
	
	$appointment_id=$_POST['appointment_id'];
	$admin_id=$_POST['admin_id'];
	$patient_id=$_POST['patient_id'];
	$date=$_POST['date'];
	$time=$_POST['time'];
	$symptoms=$_POST['symptoms'];
	$cost=$_POST['cost'];
		
	mysqli_query($conn,"insert into `appointment` (appointment_id, admin_id, patient_id, date, time, symptoms, cost) values ('$appointment_id','$admin_id','$patient_id','$date','$time','$symptoms','$cost')");
	header('location:read_appointments.php');
?>