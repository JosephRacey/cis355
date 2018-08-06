<?php
session_start();
require "database.php";
if($_GET) $errorMessage = $_GET['errorMessage'];
else $errorMessage = '';
if($_POST) {
	$success = false;
	$username = $_POST['username'];
	$password = $_POST['password'];
	                                  //   echo $username . " " . $password; exit();
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM users WHERE email = '$username' AND password = '$password' LIMIT 1";
	$q = $pdo->prepare($sql);
	$q->execute(array());
	$data = $q->fetch(PDO::FETCH_ASSOC);
	
	
	if($data)  {
		$_SESSION["username"] = $username;
		header("Location: success.php?id=$username ");
	}
	else{
		header("location: login.php?errorMessage=Invalid Credentials");
		exit();
	}
	
	
}
//else show empty login form
?>

<link   href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/bootstrap.min.js"></script>

<h1>Log In</h1>
	Don't have an account? <a href='createuser.php'>Create one here!</a>
	
<form class="form-horizontal" action="login.php" method="post">

	<input name="username" type="text" placeholder="me@email.com" required>
	<input name="password" type="password" placeholder="password" required>
	<br><br>
	<button type="submit" class="btn btn-success">Sign In</button>
	<a href='logout.php' class="btn btn" > Log Out </a> <br><br>
	<p style='color :red'><?php echo $errorMessage; ?></p>
		
</form>
