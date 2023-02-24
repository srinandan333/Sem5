<?php
	$id=$_GET['id'];
	include('conn.php');
	mysqli_query($conn,"delete from `schedule` where schedule_id='$id'");
	header('location:read_schedules.php');
?>