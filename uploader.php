<!DOCTYPE html>
<head><title>Uploader</title></head>
<body>
<?php
session_start();
 
// Get the filename and make sure it is valid
$filename = basename($_FILES['uploadedfile']['name']);
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename";
	exit;
}
$username = @$_SESSIOR['user'];
 /*
// Get the username and make sure it is valid
$username = $_SESSION['username'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}*/
 
$full_path = sprintf("/upload/%s/%s", $username, $filename);
 
if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
	echo("Location: upload_success.html");
	exit;
}else{
	echo("Location: upload_failure.html");
	exit;
}
 
?>

</body>
</html>