<?php
	$id=$_GET['id'];
	include('conn.php');
	mysqli_query($conn,"delete from `patient` where patient_id='$id'");
	header('location:read_patients.php');
?>