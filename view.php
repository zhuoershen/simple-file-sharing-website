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

$pos = strripos($filename,".");

if($pos === false)
{
	exit("invalid file name");
}

$postfix = substr($filename, $pos);
printf("lala%s",$postfix);

if($postfix == ".txt")
{
$h = fopen($filepath,"r");
$linenum = 1;
echo "<ul>\n";
while(!feof($h))
{
printf("\t<li> %s</Li>\n",fgets($h));
}
echo"</ul>\n";
fclose($h);
}
else if($postfix == ".jpg")
{
printf("%s",$filepath);
$type = 'image/jpeg';
header('Content-Type:'.$type);
header('Content-Length: ' . filesize($filepath));
echo "$filepath";
}
?>

</body>
</html>