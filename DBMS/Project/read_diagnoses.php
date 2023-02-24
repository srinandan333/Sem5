<!DOCTYPE html>
<html>
	<head>
		<title> DBMS Project </title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	</head>

	<body>
		<div class="logo" style="background-color: #31d2f2; position: sticky; top: 0;">
            <div>
                <table>
                    <tr>
						<td style="padding-left:50px; padding-bottom:40px"> <br> <br>
                            <font size="4px">
                                <a href="home.html" class="btn btn-primary" >BACK</a>
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
            <h2 align="center" class="card-header"> DIAGNOSIS TABLE </h2>
            <form method="POST" action="create_diagnoses.php" class="card-body">
                <div class="input-group input-group-sm mb-3" style="padding-left:250px; padding-right:250px">
                    <span class="input-group-text" id="inputGroup-sizing-sm" >diagnosis_id</span>
                    <input type="number" class="form-control" name="diagnosis_id" aria-describedby="inputGroup-sizing-sm">
                </div>
                
                <div class="input-group input-group-sm mb-3" style="padding-left:250px; padding-right:250px">
                    <span class="input-group-text" id="inputGroup-sizing-sm">doctor_id</span>
                    <input type="number" class="form-control" name="doctor_id" aria-describedby="inputGroup-sizing-sm">
                </div>

				<div class="input-group input-group-sm mb-3" style="padding-left:250px; padding-right:250px">
                    <span class="input-group-text" id="inputGroup-sizing-sm">patient_id</span>
                    <input type="number" class="form-control" name="patient_id" aria-describedby="inputGroup-sizing-sm">
                </div>
                
                <div class="input-group input-group-sm mb-3" style="padding-left:250px; padding-right:250px">
                    <span class="input-group-text" id="inputGroup-sizing-sm">ailment</span>
                    <input type="text" class="form-control" name="ailment" aria-describedby="inputGroup-sizing-sm">
                </div>

				<div class="input-group input-group-sm mb-3" style="padding-left:250px; padding-right:250px">
                    <span class="input-group-text" id="inputGroup-sizing-sm">severity</span>
                    <input type="text" class="form-control" name="severity" aria-describedby="inputGroup-sizing-sm">
                </div>
                
                <div class="input-group input-group-sm mb-3" style="padding-left:250px; padding-right:250px">
                    <span class="input-group-text" id="inputGroup-sizing-sm">medication</span>
                    <input type="text" class="form-control" name="medication" aria-describedby="inputGroup-sizing-sm">
                </div>

				<div class="input-group input-group-sm mb-3" style="padding-left:250px; padding-right:250px">
                    <span class="input-group-text" id="inputGroup-sizing-sm">surgery</span>
                    <input type="text" class="form-control" name="surgery" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div style="padding-left:600px">
                    <button type="submit" class="btn btn-primary" >Insert</button>
                </div>
            </form>
        </div>
		<br>
		<div>
			<table border="1" style="width:90%" align="center">
				<thead>
					<th>diagnosis_id</th>
					<th>doctor_id</th>
					<th>patient_id</th>
					<th>ailment</th>
					<th>severity</th>
					<th>medication</th>
					<th>surgery</th>
					<th></th>
					<th></th>
				</thead>
				<tbody>
					<?php
						include('conn.php');
						$query=mysqli_query($conn,"select * from `diagnosis`");
						while($row=mysqli_fetch_array($query))
						{
							?>
							<tr>
								<td><?php echo $row['diagnosis_id']; ?></td>
								<td><?php echo $row['doctor_id']; ?></td>
								<td><?php echo $row['patient_id']; ?></td>
								<td><?php echo $row['ailment']; ?></td>
								<td><?php echo $row['severity']; ?></td>
								<td><?php echo $row['medication']; ?></td>
								<td><?php echo $row['surgery']; ?></td>
								<td><a href="edit_diagnoses.php?id=<?php echo $row['diagnosis_id']; ?>" class="btn btn-warning btn-sm">Edit</a></td>
								<td><a href="delete_diagnoses.php?id=<?php echo $row['diagnosis_id']; ?>" class="btn btn-danger btn-sm">Delete</a></td>
							</tr>
							<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</body>
</html>