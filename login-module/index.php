<?php 
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Homepage</title>
	<?php require_once('includes/header.php'); ?>
</head>
<body>
	<nav>
		<li></li>
		<li></li>
		<li></li>
	</nav>
	<div class="row">
		<div class="col-lg-1">
			<br>
		</div>
		<div class="col-lg-10">
			
			<div class="m-5 p5">
				
				<?php 
					if (isset($_SESSION['username']) && isset($_SESSION['is_logged_in'])) {
				 ?>

					<div class="p-2 bg-danger text-white text-center shadow">
						Welcome: <?php echo $_SESSION['username']; ?>
						<a href="logout.php" class="float-right text-white border">Logout</a>
					</div>
					<img src="../images/scenery.jpg" class="" style="width:100%" alt="">

				<?php 
					} else {
				 ?>

				 	<div class="alert alert-danger">Please login to access this image.</div>

				<?php } ?>

			</div>


		</div>
		<div class="col-lg-1">
			<br>
		</div>
	</div>

	<?php require_once('includes/footer.php'); ?>
</body>
</html>




