<?php
	require_once 'db/db_connect.php';
	session_start();
	if(isset($_SESSION['loggedInUser']))
	{
		$loggedInUserId = $_SESSION['loggedInUser'];
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register - Todo</title>
	<script type="text/javascript" src="script/jquery-min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
	<script type="text/javascript" src="script/signup.js"></script>
	<link rel="stylesheet" type="text/css" href="css/signup.css">
</head>
<body class="indigo lighten-1">

	<header>
		<nav>
		    <div class="nav-wrapper indigo darken-1">
		      <a href="#!" class="brand-logo">ToDo</a>
		      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
		      <ul class="right hide-on-med-and-down">
		        <li><a href="login.php">Login</a></li>
		      </ul>
		      <ul class="side-nav" id="mobile-demo">
		        <li><a href="login.php">Login</a></li>
		      </ul>
		    </div>
	  	</nav>
	</header>

	<main>
		<div id="main-container" class="row" >
			<div class="col s12 m8 l6 offset-m2 offset-l3">
				<div class="card-panel ">
					<div class="card-content indigo-text">
		              <h4 class="card-title center-align">Register</h4>
		            </div>
		            <form id="register-form" method="post">
		            	<div class="input-field">
		            		<label for="name">Name</label>
							<input type="text" name="name" id="name" required>
		            	</div>
						<div class="input-field">
							<label for="email">Email</label>
							<input type="email" name="email" id="email" required>
						</div>
						<div class="input-field">
							<label for="Password">Password</label>
							<input type="password" name="password" id="password" required>
						</div>
						<input type="submit" class="btn indigo waves-effect waves-light" value="Register">
					</form>
				</div>
			</div>
		</div>
	</main>

</body>
</html>