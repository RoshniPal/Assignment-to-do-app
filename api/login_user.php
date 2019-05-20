<?php
	
	require_once '../db/db_connect.php';
	session_start();
	$response = array();

	if(isset($_POST['email'])&&isset($_POST['password']))
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
		$salt = NULL;
		$userid = NULL;
		if($stmt = mysqli_prepare($conn,"SELECT salt FROM users WHERE email = ?"))
		{
			mysqli_stmt_bind_param($stmt,"s",$email);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt,$salt);
			while(mysqli_stmt_fetch($stmt))
			{
				//stores value in salt
			}
			if(is_null($salt))
			{
				//no user exist
				$response['success'] = 0;
				$response['message'] ="No user with this mail found!";
			}
			else
			{
				$encrypted = base64_encode(sha1($password . $salt));
				if($stmt1 = mysqli_prepare($conn,"SELECT id FROM users WHERE email = ? AND password = ?"))
				{
					mysqli_stmt_bind_param($stmt1,"ss",$email,$encrypted);
					mysqli_stmt_execute($stmt1);
					mysqli_stmt_bind_result($stmt1,$userid);
					while(mysqli_stmt_fetch($stmt1))
					{
						//stores value in id
					}
					if(is_null($userid))
					{
						$response['success'] = 0;
						$response['message'] ="Invalid credentials!";
					}
					else
					{
						$response['success'] = 1;
						$response['id'] = $userid;
						$response['message'] ="Login Successful!";
						$_SESSION['loggedInUser'] = $userid;
						$_SESSION['loggedInUserEmail'] = $email;
					}
				}
			}
		}
		else
		{
			$response['success'] = 0;
			$response['message'] ="Error while authenticating!";
		}

	}
	else
	{
		$response['success'] = 0;
		$response['message'] ="Missing required fields!";
	}

	echo json_encode($response);	
?>