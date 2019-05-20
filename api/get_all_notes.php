<?php
	require_once '../db/db_connect.php';
	session_start();
	$response = array();
	if(isset($_SESSION['loggedInUser']))
	{
		$user_id = $_SESSION['loggedInUser'];
		if($stmt = mysqli_prepare($conn,"SELECT id,title,description,finished,updated_at FROM notes WHERE user_id = ?"))
		{
			mysqli_stmt_bind_param($stmt,"i",$user_id);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			$response['notes'] = array();
			while($row = mysqli_fetch_array($result))
			{
				$note = array();
				$note['id'] = $row['id'];
				$note['title'] = $row['title'];
				$note['description'] = $row['description'];
				$note['finished'] = $row['finished'];
				$note['updated_at'] = $row['updated_at'];
				array_push($response['notes'], $note);
			}

			$response['success'] = 1;
			$response['message'] = "Retrieved notes successfully!";
		}
		else
		{
			$response['success'] = 0;
			$response['message'] = "Error occured while getting your notes!";
		}
	}
	else
	{
		$response['success'] = 0;
		$response['message'] = "Missing required fields!";
	}

	echo json_encode($response);
?>