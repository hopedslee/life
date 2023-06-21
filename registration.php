<?php
/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com/
*/
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
	//include_once('../dbconn.php');
	require('dbconn.php');
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['email'])){
		$email = stripslashes($_REQUEST['email']);
		$email = mysqli_real_escape_string($conn,$email);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($conn,$password);
		$printname = stripslashes($_REQUEST['printname']); // removes backslashes
		$printname = mysqli_real_escape_string($conn,$printname); //escapes special characters in a string
		$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (email, printname, password, trn_date) VALUES ('$email', '$printname', '".md5($password)."',  '$trn_date')";
		echo $query.'<br />';
        $result = mysqli_query($conn,$query);
        if($result){
            echo "<div class='form'><h3>You are registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
        }
    }else{
?>
<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post">
<input type="email" name="email" placeholder="Email" required />
<input type="text" name="printname" placeholder="Print name" required />
<input type="password" name="password" placeholder="Password" required />
<input type="submit" name="submit" value="Register" />
</form>
<br /><br />
<a href="https://www.allphptricks.com/insert-view-edit-and-delete-record-from-database-using-php-and-mysqli/">Tutorial Link</a> <br /><br />
For More Web Development Tutorials Visit: <a href="https://www.allphptricks.com/">AllPHPTricks.com</a>
</div>
<?php } ?>
</body>
</html>
