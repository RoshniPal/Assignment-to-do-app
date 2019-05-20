<?php
    require_once '../db/db_connect.php';
	session_start();
    $response = array();
    
    if(isset($_POST['title'])&&isset($_POST['description'])&&isset($_POST['id']))
    {

        // $sql = "UPDATE notes SET finished="+$_POST['finished']+" WHERE id="+$_POST['note_id'];
        if($stmt = mysqli_prepare($conn,"UPDATE notes SET title = ? , description = ? , updated_at =  NOW() where id= ?"))
		{
			mysqli_stmt_bind_param($stmt,"ssi",$_POST['title'],$_POST['description'],$_POST['id']);
			$result = mysqli_stmt_execute($stmt);
			if($result)
			{
                $response['success'] = 1;
                $response['note_id'] = $_POST['id'];
                $response['title'] = $_POST['title'];
                $response['description'] = $_POST['description'];
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