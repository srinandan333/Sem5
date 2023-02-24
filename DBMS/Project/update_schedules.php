<?php
	include('conn.php');
	$id=$_GET['id'];
	
	$schedule_id=$_POST['schedule_id'];
	$admin_id=$_POST['admin_id'];
	$doctor_id=$_POST['doctor_id'];
	$start_time=$_POST['start_time'];
	$end_time=$_POST['end_time'];
	$break_time=$_POST['break_time'];
	$shift=$_POST['shift'];

	mysqli_query($conn,"update `schedule` set schedule_id='$schedule_id', admin_id='$admin_id', doctor_id='$doctor_id', start_time='$start_time', end_time='$end_time', break_time='$break_time', shift='$shift' where schedule_id='$id'");
	header('location:read_schedules.php');
?>