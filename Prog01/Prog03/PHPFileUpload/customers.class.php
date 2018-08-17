<?php

class Customers {
    
    public $id;
    
    public $name;
    public $email;
    public $mobile;
    
    private $nameError = null;
    private $emailError = null;
    private $mobileError = null;
    
    private $title = "Customer";
 
 //******************************************************************************************************************************
    function create_record() { // display create form
        echo "
        <html>
            <head>
                <title>Create a $this->title</title>
                    ";
        echo "
                <meta charset='UTF-8'>
                <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css' rel='stylesheet'>
                <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js'></script>
                    "; 
        echo "
            </head>
 
            <body>
                <div class='container'>

                    <div class='span10 offset1'>
                        <p class='row'>
                            <h3>Create a $this->title</h3>
                        </p>
                        <form class='form-horizontal' action='customer.php?fun=11' method='post'>                        
                    ";
        $this->control_group("name", $this->nameError, $this->name);
        $this->control_group("email", $this->emailError, $this->email);
        $this->control_group("mobile", $this->mobileError, $this->mobile);
        echo " 
                            <div class='form-actions'>
                                <button type='submit' class='btn btn-success'>Create</button>
                                <a class='btn' href='customer.php'>Back</a>
                            </div>
                        </form>
                    </div>

                </div> <!-- /container -->
            </body>
        </html>
                    ";
    }//End of create_record
    //******************************************************************************************************************************
	
	//******************************************************************************************************************************
    function read_record() { //displays a single record for viewing

	$id = $_GET['id'];
        $pdo = Database::connect();
        $sql = "SELECT * FROM customers WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
		
	echo "
		<html>
            <head>
                <title>Create a $this->title</title>
	";
	echo "
			<meta charset='utf-8'>
			<link   href='css/bootstrap.min.css' rel='stylesheet'>
			<script src='js/bootstrap.min.js'></script>
			";
	echo "
		</head>
	<body>
    <div class='container'>
     
                <div class='span10 offset1'>
                    <div class='row'>
                        <h3>Read a Customer</h3>
                    </div>
                     
                    <div class='form-horizontal' >
                      <div class='control-group'>
                        <label class='control-label'>Name</label>
                        <div class='controls'>
                            <label class='checkbox'>";
							echo $data['name'];
                               
    echo "	
							</label>
                        </div>
                      </div>
                      <div class='control-group'>
                        <label class='control-label'>Email Address</label>
                        <div class='controls'>
                            <label class='checkbox'>";
                                echo $data['email'];
    echo "                  </label>
                        </div>
                      </div>
                      <div class='control-group'>
                        <label class='control-label'>Mobile Number</label>
                        <div class='controls'>
                            <label class='checkbox'>";
                                 echo $data['mobile'];
    echo"                       </label>
                        </div>
                      </div>
                        <div class='form-actions'>
                          <a class='btn' href='customer.php'>Back</a>
                       </div>  
                    </div>
                </div>                 
		     </div> <!-- /container -->
		</body>
	</html>";
	}//End of read_record
	//******************************************************************************************************************************
	
	//******************************************************************************************************************************
	function update_record(){ //displays the form for updating a record

	$id = $_GET['id'];

	echo"
		<html lang='en'>
			<head>
				<meta charset='utf-8'>
                <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css' rel='stylesheet'>
                <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js'></script>
		</head>
		";
		
	echo "
        </head>
 
            <body>
                <div class='container'>

                    <div class='span10 offset1'>
                        <p class='row'>
                            <h3>Update a $this->title</h3>
                        </p>
                        <form class='form-horizontal' action='customer.php?fun=33&id=".$id."' method='post'> 
						<input type='hidden' name='id' value='". $id.";'/>
                    ";
        $this->control_group("name", $this->nameError, $this->name);
        $this->control_group("email", $this->emailError, $this->email);
        $this->control_group("mobile", $this->mobileError, $this->mobile);
        echo " 
                            <div class='form-actions'>
                                <button type='submit' class='btn btn-success'>Update</button>
                                <a class='btn' href='customer.php'>Back</a>
                            </div>
                        </form>
                    </div>

                </div> <!-- /container -->
            </body>
        </html>
                    ";
	}// End of update_record
	//******************************************************************************************************************************
	
	//******************************************************************************************************************************
    function list_records() { //Generates the home page and lists all records
		
        echo "
        <html>
            <head>
                <title>$this->title" . "s" . "</title>
                    ";
        echo "
                <meta charset='UTF-8'>
                <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css' rel='stylesheet'>
                <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js'></script>
                    ";  
        echo "
            </head>
            <body>
                <div class='container'>
                    <p class='row'>
                        <h3>$this->title" . "s" . "</h3>
                    </p>
                    <p>
                        <a href='customer.php?fun=1' class='btn btn-success'>Create</a>
						<a href='https://github.com/JosephRacey/cis355/tree/master/Prog03' class='btn btn-success'>View Source on Github</a>
                                                <br><br>
                                                <a href='customer.php?fun=5' class='btn btn-success'>Upload File (Method 1)</a>
                                                <a href='upload01\uploads' class='btn btn-success'>View Directory (Method 1)</a>
                                                <br><br>
                                                <a href='customer.php?fun=6' class='btn btn-success'>Upload File (Method 2)</a>
                                                <a href='customer.php?fun=7' class='btn btn-success'>View Directory (Method 2)</a>
                                                <br><br>
                                                <a href='customer.php?fun=8' class='btn btn-success'>Upload File (Method 3)</a>
                                                <a href='customer.php?fun=9' class='btn btn-success'>View Directory (Method 3)</a>
                    <div class='row'>
                        <table class='table table-striped table-bordered'>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Action</th>                                  
                                </tr>
                            </thead>
                            <tbody>
                    ";
        $pdo = Database::connect();
        $sql = "SELECT * FROM customers ORDER BY id DESC";
        foreach ($pdo->query($sql) as $row) {
            echo "<tr>";
            echo "<td>". $row["name"] . "</td>";
            echo "<td>". $row["email"] . "</td>";
            echo "<td>". $row["mobile"] . "</td>";
            echo "<td width=250>";
            echo "<a class='btn' href='customer.php?fun=2&id=".$row["id"]."'>Read</a>";
            echo "&nbsp;";
            echo "<a class='btn btn-success' href='customer.php?fun=3&id=".$row["id"]."'>Update</a>";
            echo "&nbsp;";
            echo "<a class='btn btn-danger' href='customer.php?fun=4&id=".$row["id"]."'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
        Database::disconnect();        
        echo "
                            </tbody>
                        </table>
                    </div>
                </div>

            </body>

        </html>
                    ";  
    } // end list_records()
    //******************************************************************************************************************************
    
    //******************************************************************************************************************************
    function upload_file1() {
      header("Location: upload01/upload01.html");  
    }
   
    function upload_file2() {
      header("Location: upload02/upload02.html");  
    }
    
    function upload_file3() {
      header("Location: upload03/upload03.html");  
    }
    
    function display_list() {
      
        
    echo "  
      <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css' rel='stylesheet'>
      <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js'></script>";  
    
    echo  "<div class='container'>"; 
    echo "<div class='row'>
                        <table class='table table-striped table-bordered'>
                            <thead>
                                <tr>
                                    <th> File Name</th>
                                    <th>File Type</th>
                                    <th>File Size</th>
                                    <th>Description</th>
                                    <th>PATH</th>
                                    <th>Preview</th>
                                </tr>
                            </thead>
                            <tbody>";  
        
      $pdo = Database::connect();
      $sql = "SELECT * FROM upload02 ORDER BY id DESC";  
      foreach ($pdo->query($sql) as $row) {
            echo "<tr>";
            echo "<td>". $row["filename"] . "</td>";
            echo "<td>". $row["filetype"] . "</td>";
            echo "<td>". $row["filesize"] . "</td>";
            echo "<td>". $row["description"] . "</td>";
            echo "<td>". $row["PATH"] . "</td>";
            echo "<td> <img  class='img' src='upload02/uploads/$row[filename]' alt='' height='auto' width='400'</img> </td>";
           
    }
    echo "</div>";
    echo "</div>";

    echo "<br><a href='customer.php?fun=0' class='btn btn-success'>Return to Customers</a>";

    }
    
    function display_list2() {
        
    echo "  
      <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css' rel='stylesheet'>
      <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js'></script>";  
    
    echo  "<div class='container'>"; 
    echo "<div class='row'>
                        <table class='table table-striped table-bordered'>
                            <thead>
                                <tr>
                                    <th>File Name</th>
                                    <th>File Type</th>
                                    <th>File Size</th>
                                    <th>Description</th>
                                    <th>Preview</th>
                                </tr>
                            </thead>
                            <tbody>";  
        
      $pdo = Database::connect();
      $sql = "SELECT * FROM upload03 ORDER BY id DESC";  
      foreach ($pdo->query($sql) as $row) {
            echo "<tr>";
            echo "<td>". $row["filename"] . "</td>";
            echo "<td>". $row["filetype"] . "</td>";
            echo "<td>". $row["filesize"] . "</td>";
            echo "<td>". $row["description"] . "</td>";
            echo "<td>";
            echo '<img width=400 src="data:image/jpeg;base64,'
                  . base64_encode( $row['content'] ).'"/>'
                  . '<br><br>';
            echo "</td>"; 
           
    }
    echo "</div>";
    echo "</div>";

    echo "<a href='customer.php?fun=0' class='btn btn-success'>Return to Customers</a>";

    }
    
    
    //******************************************************************************************************************************
    //control_group function generates form for both create and update.
    function control_group ($label, $labelError, $val) {
        echo "<div class='control-group";
        echo !empty($labelError) ? 'error' : '';
        echo "'>";
        echo "<label class='control-label'>$label</label>";
        echo "<div class='controls'>";
        echo "<input name='$label' type='text' placeholder='$label' value='";
        echo !empty($val) ? $val : '';
        echo "'>";
        if (!empty($labelError)) {
            echo "<span class='help-inline'>";
            echo $labelError;
            echo "</span>";
        }
        
        echo "</div>";
    } // End control_group
	//******************************************************************************************************************************
    
	//******************************************************************************************************************************
	// insert_record function, creates new record
    function insert_record () {
        // validate input
        $valid = true;
        if (empty($this->name)) {
            $this->nameError = 'Please enter Name';
            $valid = false;
        }

        if (empty($this->email)) {
            $this->emailError = 'Please enter Email Address';
            $valid = false;
        } 
        /*
        else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        
            $this->emailError = 'Please enter a valid Email Address';
            $valid = false;
        }
         */

        if (empty($this->mobile)) {
            $this->mobileError = 'Please enter Mobile Number';
            $valid = false;
        }

        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO customers (name,email,mobile) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($this->name,$this->email,$this->mobile));
            Database::disconnect();
            header("Location: customer.php");
        }
        else {
            $this->create_record();
        }
    }//End insert_record
    //******************************************************************************************************************************
	
	//******************************************************************************************************************************
	//update_data function validates user input and updates record in database
	function update_data() {
	  
		$id = $_GET['id'];
	    // keep track post values
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
	  
	  
	   // validate input
        $valid = true;
        if (empty($this->name)) {
            $this->nameError = 'Please enter Name';
            $valid = false;
        }

        if (empty($this->email)) {
            $this->emailError = 'Please enter Email Address';
            $valid = false;
        } 
        /*
        else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        
            $this->emailError = 'Please enter a valid Email Address';
            $valid = false;
        }
         */

        if (empty($this->mobile)) {
            $this->mobileError = 'Please enter Mobile Number';
            $valid = false;
        }	//End update_data
		
		// Update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE customers  set name = ?, email = ?, mobile =? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$email,$mobile,$id));
            Database::disconnect();
            header("Location: customer.php");
        }
        else {
            $this->update_record();
        }
	}//End of update_data
	//******************************************************************************************************************************
	
	//******************************************************************************************************************************
	//delete_record function, generates the html for the confirmation page before delete
	function delete_record() {
	
	$id = $_GET['id'];

	echo "	
		<html lang='en'>
			<head>
				<meta charset='utf-8'>
				<link   href='css/bootstrap.min.css' rel='stylesheet'>
				<script src='js/bootstrap.min.js'></script>
			</head>
 
			<body>
				<div class='container'>
     
							<div class='span10 offset1'>
								<div class='row'>
									<h3>Delete a Customer</h3>
								</div>
                     
								<form class='form-horizontal' action='customer.php?fun=44&?id=".$id."' method='post'>
								<input type='hidden' name='id' value='". $id.";'/>
								<p class='alert alert-error'>Are you sure to delete ?</p>
								<div class='form-actions'>
									<button type='submit' class='btn btn-danger'>Yes</button>
									<a class='btn' href='customer.php'>No</a>
									</div>
								</form>
							</div>
                 
				</div> <!-- /container -->
			</body>
			</html>";
		
	}// End delete_record
	//******************************************************************************************************************************
	
	//******************************************************************************************************************************
	//delete_data function deletes the record form the database
	function delete_data() {
		
		$id = $_POST['id'];
		
		// delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM customers  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: customer.php");	
	}//End delete_data
	//******************************************************************************************************************************
	
	
} // end class Customers