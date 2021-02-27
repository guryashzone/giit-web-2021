<?php require_once('includes/connection.php'); ?>
<?php 
	$error = $success = null;
	$empname = $empdept = '';
	$empstatus = 'active';
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
			$success = "Employee added successfully!";
		}

	}

	if (isset($_POST['updateBtn'])) {
		
		$empno = $_POST['empno'];
		$empname = $_POST['empname'];
		$empdept = $_POST['empdept'];
		$empstatus = $_POST['empstatus'];

		$query = "UPDATE `employee` SET `employee_name` = '$empname', `employee_department` = $empdept, `employee_status` = '$empstatus' WHERE `employee_number` = '$empno'";
		$res = mysqli_query($conn, $query);
		$err = mysqli_error($conn);

		if ($err) {
			$error = $err;
		} else {
			$success = "Employee updated successfully!";
			header('location:display.php');
		}

	}


	$query = "SELECT `employee_number` FROM `employee` ORDER BY `employee_id` DESC LIMIT 1";
	$res = mysqli_query($conn, $query);
	$row = mysqli_fetch_object($res);
	$new_empno = $row->employee_number;
	$new_empno = ++$new_empno;

	if (isset($_GET['delete'])) {
		$id = $_GET['id'];
		// $query = "DELETE FROM `employee` WHERE `employee_id`=$id";
		$query = "UPDATE `employee` SET `employee_status` = 'inactive' WHERE `employee_id`=$id";
		$res = mysqli_query($conn, $query);
		$success = "Employee $id deleted successfully!";
	}

	if (isset($_GET['update'])) {
		$id = $_GET['id'];
		$query = "SELECT * FROM `employee` WHERE `employee_id` = $id";
		$res = mysqli_query($conn, $query);
		$row = mysqli_fetch_object($res);
		$new_empno = $row->employee_number;
		$empname = $row->employee_name;
		$empdept = $row->employee_department;
		$empstatus = $row->employee_status;
	}

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
					if ($success != null) {
						echo "<div class='alert alert-success'>$success</div>";
					}
				 ?>


				<form action="" method="POST">
					
					<label>EMP NO</label>
					<input type="text" name="empno" class="form-control form-control-sm rounded-0 mb-2" placeholder="Enter employee number" value="<?php echo $new_empno; ?>" readonly>


					<label>EMP NAME</label>
					<input type="text" name="empname" class="form-control form-control-sm rounded-0 mb-2" placeholder="Enter employee name" value="<?php echo $empname; ?>">

					<label>EMP DEPT</label>
					<select name="empdept" class="form-control form-control-sm rounded-0 mb-2">
						<option value selected disabled>--Select Department--</option>
						<?php 
							$query = "SELECT * FROM `employee_department_master` WHERE `dept_status`='active' ORDER BY `dept_name`";
							$res = mysqli_query($conn, $query);
							while ($row = mysqli_fetch_object($res)) {
								$isSelected = '';

								if ($empdept == $row->dept_id) {
									$isSelected = 'selected';
								}

								echo "<option value='$row->dept_id' $isSelected>$row->dept_name</option>";
							}
						 ?>
					</select>
					
					<label>EMP STATUS</label>
					<select name="empstatus" class="form-control form-control-sm rounded-0 mb-2">
						<option value selected disabled>--Select Status--</option>

						<?php 
							$isInActive = $isActive = '';
							if ($empstatus == 'active') {
								$isActive = 'selected';
							} else {
								$isInActive = 'selected';
							}
						 ?>

						 <option value='active' <?php echo $isActive; ?>>Active</option>
						 <option value='inactive' <?php echo $isInActive; ?>>Inactive</option>

						
						
					</select>

					<?php 
						if (isset($_GET['update'])) {
							echo "<button type='submit' name='updateBtn' class='btn btn-success btn-sm'>Update</button>";
						} else {
							echo "<button type='submit' name='addBtn' class='btn btn-primary btn-sm'>+ Add</button>";
						}
					 ?>

					
					
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
					<th>STATUS</th>
					<th>UPDATE</th>
					<th>DELETE</th>
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
								<td>$row->employee_status</td>
								<td>
									<a href='display.php?update=true&id=$row->employee_id' class='btn btn-sm btn-primary rounded-0'>Update</a>
								</td>
								<td>
									<a href='display.php?delete=true&id=$row->employee_id' class='btn btn-sm btn-danger rounded-0'>Delete</a>
								</td>
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