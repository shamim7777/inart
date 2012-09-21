<?php
include 'config.php';

$q=$_POST['q'];

if($q=='save'){
$name1 = $_POST['name1'];
$name2 = $_POST['name2'];
$images1 = $_POST['images1'];
$images2 = $_POST['images2'];
$email = $_POST['email'];
$q = "INSERT INTO `images` ( `id` ,`email`, `group1` , `group2` , `images1` , `images2` , `postdate` )
VALUES (
NULL ,'$email', '$name1', '$name2', '$images1', '$images2', NOW()
);";
//echo $q;
if(mysql_query($q))
echo "Successfully Submitted";
else
echo "Error";
}

if($q=='backimages'){
$images = $_POST['images'];
$email = $_POST['email'];
$q = "INSERT INTO `backgrounds` ( `id` , `email`, `images` , `date` )
VALUES (
NULL , '$email','$images', NOW()
);
";
//echo $q;
if(mysql_query($q))
echo "Successfully Submitted";
else
echo "Error";
}


if($q=="web")
{

$url = "https://ajax.googleapis.com/ajax/services/search/images?" .
       "v=1.0&q=barack%20obama&userip=".$_SERVER['REMOTE_ADDR'];
echo $url;

die();
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, /* Enter the URL of your site here */);
$body = curl_exec($ch);
curl_close($ch);

// now, process the JSON string
$json = json_decode($body);
print_r($json);
}

if($q=='mail')
{

	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	$subject = "Insightfull Art Backbround selection";
	// More headers
	$headers .= 'From: < kbhailstock@web-emerse.com >' . "\r\n";
	$headers .= 'Cc: shamim@coderangers.com' . "\r\n";
	$to = "kbhailstock@web-emerse.com, shamim@coderangers.com";
	
	$message = "Your selected background <br/><img src=''/>";
	if( mail($to,$subject,$message,$headers))
	{
		echo "Successfully submitted.";
	}else
	{
		echo "Failed";
	}
}


?>