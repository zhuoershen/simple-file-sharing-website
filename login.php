<!DOCTYPE html>
<html>
<head><title>User Login</title></head>

<body>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
<p>
<label for="name"> Username:</label>
<input type="text" name="name" id="name"/>
</p>
<p>
<input type="submit" value="Submit"/>
<input type="submit" value="Reset"/>
</p>
</form>
<?php
	$name=$_POST['name'];
	if(isset($name))
	{
		$username=fopen("/var/www/html/users.txt", "r");

		echo "<ul>\n";
		while(!feof($username))
		{
			if(trim(fgets($username))==$name)
			{
				$result=true;
				break;
			}
			else
				$result=false;
		}
		echo "</ul>\n";
		fclose($username);

		if($result==true)
			header("Location: http://ec2-54-218-53-191.us-west-2.compute.amazonaws.com/upload.php");
		else
			echo "<text color=\"red\">You are not allowed to login!!!!!!!!</text>";
	}
	session_start();
	$_SESSION['user']=$name;
?>
</body>
</html>