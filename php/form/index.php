<!DOCTYPE HTML>
<html>
    <head>
	        <title>Register</title>
			    </head>
				    <body>
					        <form action="register.php" method="POST">
							            Username: <input type="text" name="username">
										            <br/>
													            Password: <input type="password" name="password">
																            <br/>
																			            Confirm Password: <input type="password" name="confirmPassword">
																						            <br/>
																									            Email: <input type="text" name="email">
																												            <br/>
																															            <input type="submit" name="submit" value="Register"> or <a href="login.php">Log in</a>
																																		        </form>
																																				    </body>
																																					</html>
<?php
    require('connect.php');
    $username = $_POST['username'];
	    $password = $_POST['password'];
	    $confirmPassword = $_POST['confirmPassword'];
		    $email = $_POST['email'];

		    if(isset($_POST["submit"])){
				        if($query = mysql_query("INSERT INTO users ('id', 'username', 'password', 'email') VALUES('', '".$username."', '".$password."', '".$email."')")){
							            echo "Success";
										        }else{
													            echo "Failure" . mysql_error();
																        }
						    }
?>
