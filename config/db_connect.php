<?php 

	// connect to the database
	$conn = mysqli_connect('localhost', 'test', '1234', 'pokemon');

	// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}

?>
