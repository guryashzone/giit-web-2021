<?php
session_start();
$error = null;

if (isset($_POST['submitbtn'])) {

	$credentials = array('email' => 'user@gmail.com', 'password' => 'user1234', 'name' => 'Developer');

	$email = $_POST['useremail'];
	$password = $_POST['userpassword'];

	if ($email == $credentials['email'] && $password == $credentials['password']) {
		
		$_SESSION['username'] = $credentials['name'];
		$_SESSION['is_logged_in'] = true;
		header('location: index.php');

	} else {
		$error = "Invalid credentials. Please try again!";
	}
}

?>			

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<?php require_once('includes/header.php'); ?>
</head>
<body>
	<div class="row mt-5">
		<div class="col-lg-4">
			<br>
		</div>
		<div class="col-lg-4">
			
			<div class="m-5 p5">
				<div class="bg-secondary text-white font-weight-bold text-center p-3 mb-3">
					USER LOGIN
				</div>

				<?php 
					if ($error != null) {
						echo "<div class='alert alert-danger'>$error</div>";
					}
				 ?>

				<form action="" method="POST">
					
					<label for="">Enter Email</label>
					<input type="email" name="useremail" class="form-control" placeholder="Enter email">

					<br>

					
					<label for="">Enter Password</label>
					<input type="password" name="userpassword" class="form-control" placeholder="Enter email">

					<br>

					<button type="submit" name="submitbtn" class="btn btn-primary">Submit</button>

				</form>


			</div>


		</div>
		<div class="col-lg-4">
			<br>
		</div>
	</div>

	<?php require_once('includes/footer.php'); ?>
</body>
</html>




