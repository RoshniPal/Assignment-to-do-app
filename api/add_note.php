<?php
	require_once '../db/db_connect.php';
	session_start();
	$response = array();
	if(isset($_POST['title'])&&isset($_POST['description'])&&isset($_SESSION['loggedInUser']))
	{
		$user_id = $_SESSION['loggedInUser'];
		$title = $_POST['title'];
		$description = $_POST['description'];
		if($stmt = mysqli_prepare($conn,"INSERT INTO notes (user_id,title,description,finished,created_at,updated_at) VALUES (?,?,?,False,NOW(),NOW())"))
		{
			mysqli_stmt_bind_param($stmt,"iss",$user_id,$title,$description);
			$result = mysqli_stmt_execute($stmt);
			$last_id = mysqli_insert_id($conn);
			if($result)
			{
				$response['success'] = 1;
				$response['last_id'] = $last_id;
				$response['message'] = "Note added successfully!";
			}
			else
			{
				$response['success'] = 0;
				$response['message'] = "Error occured while adding!";
			}
		}
		else
		{
			$response['success'] = 0;
			$response['message'] = "Error occured while adding!";	
		}
	}
	else
	{
		$response['success'] = 0;
		$response['message'] = "Missing required fields!";
	}

	echo json_encode($response);
?>