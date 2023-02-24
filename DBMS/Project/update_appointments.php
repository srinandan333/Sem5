<?php
	include('conn.php');
	$id=$_GET['id'];
	
	$appointment_id=$_POST['appointment_id'];
	$admin_id=$_POST['admin_id'];
	$patient_id=$_POST['patient_id'];
	$date=$_POST['date'];
	$time=$_POST['time'];
	$symptoms=$_POST['symptoms'];
	$cost=$_POST['cost'];

	mysqli_query($conn,"update `appointment` set appointment_id='$appointment_id', admin_id='$admin_id', patient_id='$patient_id', date='$date', time='$time', symptoms='$symptoms', cost='$cost' where appointment_id='$id'");
	header('location:read_appointments.php');
?>