<?php
	include('conn.php');
	$id=$_GET['id'];
	$query=mysqli_query($conn,"select * from `diagnosis` where diagnosis_id='$id'");
	$row=mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>
	<head>
		<title> DBMS Project </title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	</head>

	<body>
		<div class="logo" style="background-color: #31d2f2;">
            <div>
                <table>
                    <tr>
                        <td style="padding-left:50px; padding-bottom:40px"> <br> <br>
                            <font size="4px">
                                <a href="read_diagnoses.php" class="btn btn-primary" > BACK </a>
                            </font>
                        </td>
                        
                        <td width="1200px" style="font-size:50px" align="center">
                            <font color="#000"> Hospital Management System </font>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
		
		<div class="card card-sm">
			<h2 align="center" class="card-header"> EDIT DIAGNOSIS </h2>
			<form method="POST" action="update_diagnoses.php?id=<?php echo $id; ?>" class="card-body">
				<div class="input-group input-group-sm mb-3" style="padding-left:250px; padding-right:250px">
					<span class="input-group-text" id="inputGroup-sizing-sm" >diagnosis_id</span>
					<input type="number" class="form-control" name="diagnosis_id" value="<?php echo $row['diagnosis_id']; ?>" aria-describedby="inputGroup-sizing-sm">
				</div>
				
				<div class="input-group input-group-sm mb-3" style="padding-left:250px; padding-right:250px">
					<span class="input-group-text" id="inputGroup-sizing-sm" >doctor_id</span>
					<input type="number" class="form-control" name="doctor_id" value="<?php echo $row['doctor_id']; ?>" aria-describedby="inputGroup-sizing-sm">
				</div>

				<div class="input-group input-group-sm mb-3" style="padding-left:250px; padding-right:250px">
					<span class="input-group-text" id="inputGroup-sizing-sm" >patient_id</span>
					<input type="number" class="form-control" name="patient_id" value="<?php echo $row['patient_id']; ?>" aria-describedby="inputGroup-sizing-sm">
				</div>

				<div class="input-group input-group-sm mb-3" style="padding-left:250px; padding-right:250px">
					<span class="input-group-text" id="inputGroup-sizing-sm">ailment</span>
					<input type="text" class="form-control" name="ailment" value="<?php echo $row['ailment']; ?>" aria-describedby="inputGroup-sizing-sm">
				</div>
				
				<div class="input-group input-group-sm mb-3" style="padding-left:250px; padding-right:250px">
					<span class="input-group-text" id="inputGroup-sizing-sm">severity</span>
					<input type="text" class="form-control" name="severity" value="<?php echo $row['severity']; ?>" aria-describedby="inputGroup-sizing-sm">
				</div>
				
				<div class="input-group input-group-sm mb-3" style="padding-left:250px; padding-right:250px">
					<span class="input-group-text" id="inputGroup-sizing-sm">medication</span>
					<input type="text" class="form-control" name="medication" value="<?php echo $row['medication']; ?>" aria-describedby="inputGroup-sizing-sm">
				</div>

				<div class="input-group input-group-sm mb-3" style="padding-left:250px; padding-right:250px">
					<span class="input-group-text" id="inputGroup-sizing-sm">surgery</span>
					<input type="text" class="form-control" name="surgery" value="<?php echo $row['surgery']; ?>" aria-describedby="inputGroup-sizing-sm">
				</div>

				<div style="padding-left:600px">
					<button type="submit" class="btn btn-primary" >Update</button>
				</div>
			</form>
		</div>
	</body>
</html>