<?php

include 'config.php';
$email  = $_GET['email'];


$q="SELECT * FROM images order by id Desc  limit 1";
 

if($email !="")
{
$q="SELECT * FROM images where email like '$email' order by id desc limit 1";
 
}
$result = mysql_query($q);	
$row = mysql_fetch_array($result);

$row[images1]  = rtrim($row[images1],',');
$images1 = explode(',',$row[images1]);

$row[images2]  = rtrim($row[images2],',');
$images2 = explode(',',$row[images2]);
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>In Art</title>
<link rel="stylesheet" href="css/dd-styles.css" />
<link href="fileuploader.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="fileuploader.js" type="text/javascript"></script>
<script type="text/javascript" src="jquery-ui.min.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script>
var slectedImages = new Array(); 
$(document).ready(function(){ 
 $('#submit').bind('click',function(){	
 
 	var email = $('#email').val();
	
	window.location = 'images.php?email='+email;
 
 });  
	
});




</script>
</head>
<body>
<div class="dd_container">
  <div class="clear"></div>
  <div class="dd_box_12 logobar">
    <div class="logo floatleft"></div>
    <div class="dd_box_8 floatright logodesc">
      <ul>
        <li><img src="images/1.jpg" height="80"></li>
        <li><img src="images/2.jpg" height="80"></li>
        <li><img src="images/3.jpg" height="80"></li>
        <li><img src="images/4.jpg" height="80"></li>
      </ul>
      <!--<h2>Helpfulnote, Instructions,tip</h2>-->
    </div>
  </div>
  <div class="clear"></div>
  <div class-="navadress">
    <ul id="breadcrumbs-one" style="float:left">
      <li><a href="index.php"  >Home</a></li>
      <li><a href="#"  class="active">My Images</a></li>
      
    </ul>
  </div>
  <div class="clear"></div>
  
  <div id="wrapper3" style="display:block;padding:10px">
    <div id="note" class="fl note" style="" >
      
	  
	  Enter your email address to view your selected images: <br/> <br/>  <input type="text" name="email" id="email" /> <input id="submit" type="button" value="Submit" />
	   
	   <h1>Your selected images:</h1>
    </div>
    
    <div class="cl"></div>
    
    <div class="cl"></div>
	<div class="groups" id="groupsall">
		<div class="group ui-droppable g1" id="1"><span class="groupname1"><?php echo $row[group1] ?></span>
			<div style="display:none;" class="add" id="added1">
				<img width="25" height="25" src="images/green.jpg">
			</div>
			<div style="display:none;" class="remove" id="removed1">
				<img width="25" height="25" src="images/red.jpg">
			</div>
			<ul>
	<?php 
	
	foreach($images1 as $key=> $img)
	{
	?>	
		
		 <li>
		 
		 <img width="80" height="80" rel="0" src="<?php echo $img ?>" class="imagedropshadow selimages ui-draggable">
		 
		 </li>
		 
	<?php } ?>	 
		
		
			</ul>
		</div>
    
      		<div class="group ui-droppable g2" id="2"><span class="groupname2"><?php echo $row[group2] ?></span>
			<div style="display:none;" class="add" id="added2">
				<img width="25" height="25" src="images/green.jpg">
			</div>
			<div style="display:none;" class="remove" id="removed2">
				<img width="25" height="25" src="images/red.jpg">
			</div>
			<ul>
			
				<?php 
	
	foreach($images2 as $key=> $img)
	{
	?>	
		
		 <li>
		 
		 <img width="80" height="80" rel="0" src="<?php echo $img ?>" class="imagedropshadow selimages ui-draggable">
		 
		 </li>
	<?php } ?> 
			</ul>
		</div>
 
    </div>
    <div class="cl"></div>
 
    <span style="font-weight:bold;" id="msg"></span> </div>
  <div class="clear"></div>
</div>
<div class="footer"></div>
 
<div style="display: none;">
  <div id="inline1" style="width:400px;height:100px;overflow:auto;font-size:16px;line-height:1em;"> Thanks your image  slection has been submitted and your Insightful Art is on it's way! Please be sure that you have submitted any other pieces (signature etc. per prior instructions) </div>
</div>
<a title=""  style="display:none;" href="#inline1" id="various1">Submit</a>
</div>
</body>
</html>
