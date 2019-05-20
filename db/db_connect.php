<?php

	require_once 'db_config.php';
	$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
	if(!$conn)
	{
		die("Error occured");
	}
	// else
	// {
	// 	echo "Database connection successful" . PHP_EOL;
	// }
?>