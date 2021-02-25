<?php  require_once('includes/connection.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Employee</title>
	<?php require_once('includes/header.php'); ?>
</head>
<body>


	<div class="row mt-5">
		<div class="col-lg-3"><br></div>
		<div class="col-lg-6">
			<div class="bg-success p-2 font-weight-bold text-center text-white shadow">
				Employee details
			</div>
			<table class="table table-sm table-bordered">
				<tr class="thead-dark">
					<th>EMP ID</th>
					<th>EMP NO</th>
					<th>EMP NAME</th>
					<th>EMP DEPT</th>
				</tr>
				<?php 
					$query = "
						SELECT
							`employee`.*,
							`employee_department_master`.`dept_name`
						FROM
							`employee`,
							`employee_department_master`
						WHERE
							`employee_department_master`.`dept_id` = `employee`.`employee_department`
						ORDER BY
							`employee_id`";


					$res = mysqli_query($conn, $query);
					$err = mysqli_error($conn);
					
					if ($err) {
						echo $err;
					}

				
					while ($row = mysqli_fetch_object($res)) {
						echo "
							<tr>
								<td>$row->employee_id</td>
								<td>$row->employee_number</td>
								<td>$row->employee_name</td>
								<td>$row->dept_name</td>
							</tr>
						";
					}


					// $row = mysqli_fetch_array($res); // array
					// $row = mysqli_fetch_assoc($res); // associative

					// echo $row->employee_name;

				 ?>
			</table>
		</div>	
		<div class="col-lg-3"><br></div>
	</div>


	<?php require_once('includes/footer.php'); ?>
</body>
</html>