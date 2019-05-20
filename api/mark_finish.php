<?php
    require_once '../db/db_connect.php';
	session_start();
    $response = array();
    
    if(isset($_POST['note_id'])&&isset($_POST['finished']))
    {

        // $sql = "UPDATE notes SET finished="+$_POST['finished']+" WHERE id="+$_POST['note_id'];
        if($stmt = mysqli_prepare($conn,"UPDATE notes SET finished = ? where id= ?"))
		{
			mysqli_stmt_bind_param($stmt,"ii",$_POST['finished'],$_POST['note_id']);
			$result = mysqli_stmt_execute($stmt);
			if($result)
			{
                $response['success'] = 1;
                $response['note_id'] = $_POST['note_id'];
				$response['message'] = "Note updated successfully!";
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
            $response['message'] = "Error Occured!";
        }
    }
    else
    {
        $response['success'] = 0;
        $response['message'] = "Missing required fields!";
    }
    echo json_encode($response);
?>