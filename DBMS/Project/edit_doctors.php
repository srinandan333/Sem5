<?php
	include('conn.php');
	$id=$_GET['id'];
	$query=mysqli_query($conn,"select * from `doctor` where doctor_id='$id'");
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
                                <a href="read_doctors.php" class="btn btn-primary" > BACK </a>
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
			<h2 align="center" class="card-header"> EDIT DOCTOR </h2>
			<form method="POST" action="update_doctors.php?id=<?php echo $id; ?>" class="card-body">
				<div class="input-group input-group-sm mb-3" style="padding-left:250px; padding-right:250px">
					<span class="input-group-text" id="inputGroup-sizing-sm" >doctor_id</span>
					<input type="number" class="form-control" name="doctor_id" value="<?php echo $row['doctor_id']; ?>" aria-describedby="inputGroup-sizing-sm">
				</div>
				
				<div class="input-group input-group-sm mb-3" style="padding-left:250px; padding-right:250px">
					<span class="input-group-text" id="inputGroup-sizing-sm">name</span>
					<input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" aria-describedby="inputGroup-sizing-sm">
				</div>
				
				<div class="input-group input-group-sm mb-3" style="padding-left:250px; padding-right:250px">
					<span class="input-group-text" id="inputGroup-sizing-sm">experience</span>
					<input type="number" class="form-control" name="experience" value="<?php echo $row['experience']; ?>" aria-describedby="inputGroup-sizing-sm">
				</div>
				
				<div class="input-group input-group-sm mb-3" style="padding-left:250px; padding-right:250px">
					<span class="input-group-text" id="inputGroup-sizing-sm">specialization</span>
					<input type="text" class="form-control" name="specialization" value="<?php echo $row['specialization']; ?>" aria-describedby="inputGroup-sizing-sm">
				</div>
				
				<div style="padding-left:600px">
					<button type="submit" class="btn btn-primary" >Update</button>
				</div>
			</form>
		</div>
	</body>
</html>