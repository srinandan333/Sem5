<?php
	include('conn.php');
	
	$schedule_id=$_POST['schedule_id'];
	$admin_id=$_POST['admin_id'];
	$doctor_id=$_POST['doctor_id'];
	$start_time=$_POST['start_time'];
	$end_time=$_POST['end_time'];
	$break_time=$_POST['break_time'];
	$shift=$_POST['shift'];
		
	mysqli_query($conn,"insert into `schedule` (schedule_id, admin_id, doctor_id, start_time, end_time, break_time, shift) values ('$schedule_id','$admin_id','$doctor_id','$start_time','$end_time','$break_time','$shift')");
	header('location:read_schedules.php');
?>