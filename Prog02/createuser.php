<?php
session_start();

//include_once "customers.php";
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $fnameError = null;
		$lnameError = null;
        $emailError = null;
        $passwordError = null;
         
        // keep track post values
        $fname = $_POST['fname'];
		$lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
         
        // validate input
        $valid = true;
        if (empty($fname)) {
            $fnameError = 'Please enter First Name';
            $valid = false;
        }
		
		if (empty($lname)) {
            $lnameError = 'Please enter Last Name';
            $valid = false;
        }
         
        if (empty($email)) {
            $emailError = 'Please enter Email Address';
            $valid = false;
			
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }
         
		$pdo = Database::connect();
		$sql = "SELECT * FROM users";
		foreach($pdo->query($sql) as $row) {
			
			if($email == $row['email']) {
				$emailError = 'Email has already been registered!';
				$valid = false;
			}
		}
		
        if (empty($password)) {
            $passwordError = 'Please enter Password';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO users (fname,lname,email,password) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($fname,$lname,$email,$password));
            Database::disconnect();
            header("Location: login.php");
        }
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Create a new account</h3>
                    </div>
             
                    <form class="form-horizontal" action="createuser.php" method="post">
                      <div class="control-group <?php echo !empty($fnameError)?'error':'';?>">
                        <label class="control-label">First Name</label>
                        <div class="controls">
                            <input name="fname" type="text"  placeholder=" First Name" value="<?php echo !empty($fname)?$fname:'';?>">
                            <?php if (!empty($fnameError)): ?>
                                <span class="help-inline"><?php echo $fnameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  <div class="control-group <?php echo !empty($lnameError)?'error':'';?>">
                        <label class="control-label"> Last Name</label>
                        <div class="controls">
                            <input name="lname" type="text"  placeholder=" Last Name" value="<?php echo !empty($lname)?$lname:'';?>">
                            <?php if (!empty($lnameError)): ?>
                                <span class="help-inline"><?php echo $lnameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
                        <label class="control-label">Create Password</label>
                        <div class="controls">
                            <input name="password" type="password"  placeholder="Password" value="<?php echo !empty($password)?$password:'';?>">
                            <?php if (!empty($passwordError)): ?>
                                <span class="help-inline"><?php echo $passwordError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button> 
                          <a class="btn" href="login.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>