<!DOCTYPE html>
<html>
<head><title>Files</title>

<style type="text/css">
a.myLink
{
position:absolute;
left:400px;
}
a.nextLink
{
position:absolute;
left:450px;
}
text.filesize
{
position:absolute;
left:300px;
}
</style>
</head>
<body>


<?php 
ini_set('display_errors',1);
session_start();

$username = @$_SESSION['user'];

$userfile=fopen("/var/www/users.txt", "r");
while(!feof($userfile))
{
	if(trim(fgets($userfile))==$username)
	{
		$result=true;
		break;
	}
	else
		$result=false;
}
fclose($userfile);

if(!$result)
{
	exit("please log in.....");
}


printf("<p>Welcome <strong>%s</strong>,</p>", $username);
printf("<p>Your files:</p>");
$dir = "/upload/".$username;

if(!file_exists($dir))
{
	mkdir($dir);
	chmod($dir,0777);
}

$files = scandir($dir);

function FileSizeConvert($bytes)
{
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );
	$result;
    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "." , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}

foreach($files as $a)
{
	if (!in_array($a,array(".",".."))) 
	{
		$fullpath = $dir."/".$a;
		$bytes = filesize($fullpath);
		$myfilesize = FileSizeConvert($bytes);
		echo "
		<p>
		$a
		<text class=\"filesize\">$myfilesize</text>
		<a class=\"myLink\" href=\"view.php?file=$a\">view</a>
		<a class=\"nextLink\" href=\"delete.php?file=$a\">delete</a>
		</p>
		";
	}
	
}
echo "<br>";
?>
<br/>
<form enctype="multipart/form-data" action="uploader.php" method="POST">
	<p>
		<input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
	</p>
	<p>
		<label for="uploadfile_input">Choose a file to upload:</label> 
	</p>
	<p>
		<input name="uploadedfile" type="file" id="uploadfile_input" />
	</p>
	<p>
		<input type="submit" value="Upload File" />
	</p>
</form>



</body>
</html>