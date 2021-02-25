<?php 
	#Connected to DB
	$conn = mysqli_connect('localhost', 'root', '', 'sample_db');
	// $conn = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE);

	if (!$conn) {
		exit('Connection Error!');
	}

 ?>