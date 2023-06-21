<?php
/*
Author: Javed Ur Rehman
Website: http://www.allphptricks.com/
*/
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
	require('dbconn.php');
	session_start();
    // If form submitted, insert values into the database.
    if (isset($_POST['email']))
	{
		$email = stripslashes($_REQUEST['email']); // removes backslashes
		$email = mysqli_real_escape_string($conn,$email); //escapes special characters in a string
		//echo $email;
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($conn,$password);
		//echo $password;

		//Checking is user existing in the database or not
        $query = "SELECT * FROM users WHERE email='$email' and password='".md5($password)."' ";
		//echo $query;
		$result = mysqli_query($conn,$query) or die(mysql_error());
		$rows = mysqli_num_rows($result);
        if($rows){
			$_SESSION['email'] = $email;
			header("Location: index.php"); // Redirect user to index.php
        }
		else
		{
			echo "<div class='form'><h3>Email/password is incorrect.";
			echo "</h3><br/>Click here to <a href='login.php'>Login</a></div>";
		}
    }
	else
	{
?>

<div class="form">
<h1>Log In</h1>
<form action="" method="post" name="login">
	<input type="text" name="email" placeholder="Email" required />
	<input type="password" name="password" placeholder="Password" required />
	<input name="submit" type="submit" value="Login" />
</form>
<p>Not registered yet? <a href='registration.php'>Register Here</a></p>

<br /><br />
<a href="http://www.allphptricks.com/simple-user-registration-login-script-in-php-and-mysqli/">Tutorial Link</a> <br /><br />
For More Web Development Tutorials Visit: <a href="http://www.allphptricks.com/">AllPHPTricks.com</a>
</div>
<?php } ?>


</body>
</html>
