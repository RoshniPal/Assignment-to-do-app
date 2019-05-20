<?php
	require_once 'db/db_connect.php';
	session_start();
	if(isset($_SESSION['loggedInUser'])&&isset($_SESSION['loggedInUserEmail']))
	{
		$loggedInUserId = $_SESSION['loggedInUser'];
		$isLoggedIn = true;
	}
	else
	{
		$isLoggedIn = false;
		header("Location: login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Notes</title>
	<script type="text/javascript" src="script/jquery-min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
	<script type="text/javascript" src="script/index.js"></script>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body >
	<nav>
	    <div class="nav-wrapper teal darken-1">
	      <a href="#!" class="brand-logo">ToDo</a>
	      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
	      <ul class="right hide-on-med-and-down">
		  	<li><a href="#"><?php echo $_SESSION['loggedInUserEmail'] ?></a></li>
	        <li><a href="logout.php">Logout</a></li>
	      </ul>
	      <ul class="side-nav" id="mobile-demo">
		  	<li><a href="#"><?php echo $_SESSION['loggedInUserEmail'] ?></a></li>
	        <li><a href="logout.php">Logout</a></li>
	      </ul>
	    </div>
  	</nav>
	<div id="add-container" class="row hide">
		<div class="col s12 m12 l6 offset-l3">
			<div class="card-panel ">
				<form id="add-form" onkeypress="return event.keyCode != 13;">
					<div class="input-field">
						<input type="text" name="title" id="title" required>
						<label for="title">Title</label>
					</div>
					<div class="input-field">
						<textarea name="description" class="materialize-textarea" id="description"required></textarea>
						<label for="description">Description</label>
					</div>
					<Button type="submit" class="btn" id="add-note" >Add Note
					<i class="material-icons right">add</i></Button>
				</form>
			</div>
		</div>
	</div>
	<div id="edit-container" class="row hide">
		<div class="col s12 m12 l6 offset-l3">
			<div class="card-panel ">
				<form id="edit-form" onkeypress="return event.keyCode != 13;">
					<div class="input-field">
						<input type="text" placeholder="" name="title" id="edit_title" required>
						<label for="edit_title">Title</label>
					</div>
					<div class="input-field">
						<textarea name="description" placeholder="" class="materialize-textarea" id="edit_description"required></textarea>
						<label for="edit_description">Description</label>
					</div>
					<input type="hidden" id="edit_id" name="id" value="">
					<Button type="submit" class="btn" id="edit-note" >Save
					<i class="material-icons right">save</i></Button>
				</form>
			</div>
		</div>
	</div>

	<div id="my-notes" class="row ">
		
	</div>

	<a id="float-add" class="btn-floating btn-large waves-effect waves-light teal hoverable bottom-right"><i class="material-icons" id="floating-icon">add</i></a>
	<a id="float-edit" class="btn-floating btn-large waves-effect waves-light teal hoverable top-right hide"><i class="material-icons" id="floating-icon">close</i></a>
</body>
</html>