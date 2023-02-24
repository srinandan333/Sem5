<?php
	$id=$_GET['id'];
	include('conn.php');
	mysqli_query($conn,"delete from `diagnosis` where diagnosis_id='$id'");
	header('location:read_diagnoses.php');
?>