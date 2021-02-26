<?php require_once('includes/connection.php'); ?>
<?php 
	$error = $success = null;
	if (isset($_POST['addBtn'])) {
		
		$empno = $_POST['empno'];
		$empname = $_POST['empname'];
		$empdept = $_POST['empdept'];
		$empstatus = $_POST['empstatus'];

		$query = "INSERT INTO `employee` VALUES (null, '$empno', '$empname', $empdept, '$empstatus')";
		$res = mysqli_query($conn, $query);
		$err = mysqli_error($conn);

		if ($err) {
			$error = $err;
		} else {
			$success = true;
		}

	}


	$query = "SELECT `employee_number` FROM `employee` ORDER BY `employee_id` DESC LIMIT 1";
	$res = mysqli_query($conn, $query);
	$row = mysqli_fetch_object($res);
	$new_empno = $row->employee_number;
	$new_empno = ++$new_empno;

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Employee</title>
	<?php require_once('includes/header.php'); ?>
</head>
<body>


	<div class="row mt-5">
		<div class="col-lg-4">
			<div class="bg-primary p-2 font-weight-bold text-center text-white shadow">
				Add Employee
			</div>
			<div class="p-3 border">

				<?php 
					if ($error != null) {
						echo "<div class='alert alert-danger'>$error</div>";
					} 
					if ($success == true) {
						echo "<div class='alert alert-success'>Employee added successfully!</div>";
					}
				 ?>


				<form action="" method="POST">
					
					<label>EMP NO</label>
					<input type="text" name="empno" class="form-control form-control-sm rounded-0 mb-2" placeholder="Enter employee number" value="<?php echo $new_empno; ?>" readonly>


					<label>EMP NAME</label>
					<input type="text" name="empname" class="form-control form-control-sm rounded-0 mb-2" placeholder="Enter employee name">

					<label>EMP DEPT</label>
					<select name="empdept" class="form-control form-control-sm rounded-0 mb-2">
						<option value selected disabled>--Select Department--</option>
						<?php 
							$query = "SELECT * FROM `employee_department_master` WHERE `dept_status`='active' ORDER BY `dept_name`";
							$res = mysqli_query($conn, $query);
							while ($row = mysqli_fetch_object($res)) {
								echo "<option value='$row->dept_id'>$row->dept_name</option>";
							}
						 ?>
					</select>
					
					<label>EMP STATUS</label>
					<select name="empstatus" class="form-control form-control-sm rounded-0 mb-2">
						<option value selected disabled>--Select Status--</option>
						<option value="active">Active</option>
						<option value="inactive">Inactive</option>
					</select>

					<button type="submit" name="addBtn" class="btn btn-primary btn-sm">+ Add</button>
				</form>
			</div>
		</div>
		<div class="col-lg-7">
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
							`employee_id`
						LIMIT 10
						";


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
	</div>


	<?php require_once('includes/footer.php'); ?>
</body>
</html>