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
<script>
var images="";
$(document).ready(function(){ 
  
  $('#submit').bind('click',function(){
  var email = $('#email').val();
   $.ajax({
					url: "process.php",
					type: "POST",            
					cache	: false,
					data: 'q=backimages&images='+images+'&email='+email,
					success: function(data) {
						//$('#msg').html(data);
						
						 window.location='select.php?email='+email;
					}
		 });
  
  });
  
  });
</script>
</head>
<body>


<div class="dd_container">

    <div class="clear"></div>
   

<div class="dd_box_12 logobar">

<div class="logo floatleft"></div>
<div class="dd_box_8 floatright logodesc"><ul><li><img src="images/1.jpg" height="80"></li><li><img src="images/2.jpg" height="80"></li><li><img src="images/3.jpg" height="80"></li><li><img src="images/4.jpg" height="80"></li></ul><!--<h2>Helpfulnote, Instructions,tip</h2>--></div>


</div>
<div class="clear"></div>

<div class-="navadress">
 <ul id="breadcrumbs-one" style="float:left">
     
        <!-- <li><a href="index.php" >Home</a></li> -->
         <li><a href="upload.php" class="active home">Home</a></li>
		 <li><a href="#" class="upload">Upload</a></li>
         <li><a class="select" href="select.php">Image Selection</a></li>
       
        
        
        </ul></div>
		  <h1 style="text-align:left;padding:20px;"> Upload your own image(s)</h1>
<div class="clear"></div>


  <div id="wrapper2">
    <div class=" floatleft imageupload">
      <div class="imageuploadinner">
	  	<div style="padding-bottom:10px;padding-left: 35px;"> <div style="width:66px;display:inline-block;">Email:</div><input style="padding-left: 4px;" type="text" name="email" id="email"/></div> 
        <div id="file-upload">
	 
          <div class="qq-uploader">
            <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;left: 95px!important;">Upload
              <input type="file" multiple="multiple" name="file" style="position: absolute; right: 0px; top: 0px; font-family: Arial; font-size: 118px; margin: 0px; padding: 0px; cursor: pointer; opacity: 0;">
            </div>
            <ul class="qq-upload-list whitearea" style="width: 300px;">
            </ul>
          </div>
        </div>
        <div class="clear"></div>
     <div style="text-align:center">   <input type="submit" id="submit" class="centered bigbutton" value="Submit"></div>
        <span style="font-weight:bold;" id="msg"></span> </div>
    </div>
   <div style="padding:100px;">Need to send in your signature ? <a href="#" style="color: black;">Click here</a></div>
    <script>        
 function createUploader(){            
 			var uploader = new qq.FileUploader({
            element: document.getElementById('file-upload'),
            params: {type:'album'},
            action: "php.php",
            debug: false,
            allowedExtensions: ['jpg', 'jpeg', 'png', 'gif', 'bmp'],
            onProgress: function(id, fileName, loaded, total){
                var progress;
                progress = Math.floor(loaded/total)*100;
            },
            onComplete: function(id, fileName, responseJSON){
           			images = images+ fileName+','; 
           			 $('.qq-upload-success').last().html('');
					 $('.qq-upload-success').last().html('<div class="select"></div><a class="check" href="#"><img class="imagedropshadow" width="80" height="80" src="uploads/'+fileName+'"/></a>');
                $('.home').removeClass('active');
				$('.upload').addClass('active');
			 }
			 });      
        }
        
        // in your app create uploader as soon as the DOM is ready
        // don't wait for the window to load  
        window.onload = createUploader;     
    </script>
    <!-- end .dd_container -->
  </div>
 
 
<!-- end .dd_container -->
<div class="clear"></div></div>
<div class="footer"></div>
</body>
</html>