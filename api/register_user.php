<?php
	require_once '../db/db_connect.php';
	
	$response = array();
	if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']))
	{
		$username = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$salt = sha1(rand());
		$salt = substr($salt,0,10);
		$encrypted = base64_encode(sha1($password . $salt));

		if($stmt = mysqli_prepare($conn,"INSERT INTO users (name,email,salt,password) VALUES (?,?,?,?)"))
		{
			mysqli_stmt_bind_param($stmt,"ssss",$username,$email,$salt,$encrypted);
			$result = mysqli_stmt_execute($stmt);
			if($result)
			{
				//data added
				$response['success'] = 1;
				$response['message'] = "User registered successfully!";
			}
			else
			{
				//erro while adding values
				$response['success'] = 0;
				$response['message'] = "This email already exist!";
			}
		}
		else
		{
			$response['success'] = 0;
			$response['message'] = "Error occured while registering!";
		}
	}
	else
	{
		//required field missing
		$response['success'] = 0;
		$response['message'] = "Missing required fields!";
	}

	echo json_encode($response);
?>