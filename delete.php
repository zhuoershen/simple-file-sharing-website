<!DOCTYPE html>
<html>
<head>
<title>view</title>
</head>
<body>

<?php
session_start();
$username = @$_SESSION['user'];
$filename = $_GET['file'];
printf("%s",$username);
printf("%s",$filename);
$filepath = "/upload/".$username."/".$filename;
unlink($filepath);
?>

</body>
</html>