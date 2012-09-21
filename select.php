<?php

include 'config.php';
$email  = $_GET['email'];


$q="SELECT * FROM backgrounds order by id Desc  limit 1";
 

if($email !="")
{
$q="SELECT * FROM backgrounds where email like '$email' order by id desc limit 1";
 
}
$result = mysql_query($q);	
$row = mysql_fetch_array($result);

$row[images]  = rtrim($row[images],',');
$images = explode(',',$row[images]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>In Art</title>
<link rel="stylesheet" href="css/dd-styles.css" />
<link href="fileuploader.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css">
 <link href="fileuploader.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="fileuploader.js" type="text/javascript"></script>
<script type="text/javascript" src="jquery-ui.min.js"></script>
 <link rel="stylesheet" href="themes/default/default.css" type="text/css" media="screen" />
 <link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />
 <script type="text/javascript" src="jquery.nivo.slider.js"></script>
<script>
$(document).ready(function(){ 
    var slectedImages = new Array(); 
 
 $('.tick').next().find('img').each( function(){
 			var src = $(this).attr('src');
			//console.log(src)
			 slectedImages.push(src);
   });
	
			
 	var cur = 1;
	var c2 = 0;
 
	 	$('.check').live('click',function(){
	
		$(this).prev().toggleClass('tick');
		
		if($(this).prev().hasClass('tick'))
		{
			var src = $(this).find('img').attr('src');
			slectedImages.push(src);
		}
		//console.log(slectedImages);
	});	
 
 

$('#selectimages').live('click',function(){
 		
		$('#wrapper2').hide();
		$('#wrapper3').show();
	 
		var c1 = 0;
		$.each(slectedImages, function(key,item){
			if(c1%100==0)
			{		 
				c2++;
				$('.scrollContainer').append('<ul class="qq-upload-list panels" id="panel_'+c2+'" style="width:510px;display:none;"></ul>');
			}
			if(c1==0)
			{
			//	$('#view').attr('src',item);
			}
			//console.log('#panel_'+c2);	
			$('#panel_'+c2).append('<li class="qq-upload-success-flickr"><div class="noselect"></div><a class="nocheck" href="#"><img class="imagedropshadow selimages onclick" id="item'+key+'" width="80" height="80" src="'+item+'"/></a></li>');	
			
			$('.nivoSlider').append('<img class="imagedropshadow selimages onclick" id="item'+key+'" width="500" src="'+item+'"/>');	
		c1++;	
		})
		$('#slider').nivoSlider();
		$('.onclick').live('click',function(){
			var src = $(this).attr('src');
			$('#view').attr('src',src);
			$('#sub').show();
		});
		
		$('#panel_1').show();	 
	 	$('.left').live('click',function(){		
			cur --;		
			if(cur ==0)
			cur =c2;		
			$('.panels').hide();
			$('#panel_'+cur).show();
		
		});
	 	
		$('.right').live('click',function(){
		
			cur++;
			
			if(cur ==(c2+1))
			cur =1;
			$('.panels').hide();
			$('#panel_'+cur).show();
		
		});
 
		 
			  
				 
	});
  
		$('#submit').click(function(){
			var img = 'http://coderangers.com/shamim/inart/'+$('#view').attr('src');
			  $.ajax({
                url: "search.php",
                type: "GET",            
                cache	: false,
                data: 'image='+img+'&q=mail',
                success: function(data) {
 					 
					$('#msg').show();
				 
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
     
        <li><a href="upload.php" class="home">Home</a></li>
		 <li><a href="#" class="upload">Upload</a></li>
         <li><a class="select active" href="select.php">Image Selection</a></li>
       
        
        
        </ul></div>
<div class="clear"></div>
 
        <div id="wrapper2" style="display:block;padding: 20px;">
	  
	  <div class="fl" id="note">Hi, (David) here are some handpicked choices to help you make some Insightful Art!<br/>
Select the one(s) you would like to use in you Insightful Artpiece and press "Confirm" </div> <div class="cl"></div>
 
        <div id="slider22">
	
          <ul class="qq-upload-list panels" style="width: 950px; display: block;">

<?php
 foreach($images as $key=>$img){
?>
	            <li class="qq-upload-success-flickr">
              <div class="select tick"></div>
              <a class="check" href="#">
			  <img width="150" height="120" class="imagedropshadow selimages ui-draggable" id="item0" src="uploads/<?php echo $img ?>"></a> </li>
<?php			              
  }
?>          </ul>
          <div class="cl"></div>
           <input class="bigbutton" type="button" id="selectimages" style="display:marker;" name="selectimages" value="Confirm"/> 
          <span style="font-weight:bold;" id="msg"></span> <span style="padding-left:20px;">Please select the images that will be the background choices for this user’s Insightful Art.</span> </div>
      </div>
	  
	    <div id="wrapper3" style="display:none;padding: 20px;">
		<div class="" style="width:950px;">
		            <div class="slider-wrapper theme-default" style="width:400px;float:left;">
						 <div id="slider" class="nivoSlider">
       
           				 </div>
			   
					</div>
		
         
          	  	 <div id="sliders" style="float:right; padding-right:120px;">
				<!--   <img class="scrollButtons left" src="images/leftarrow.png"> -->
				  
           			 <div class="scrollContainer" style="display: inline-block; width: 400px;position: relative;"> </div>
            	<!-- <img class="scrollButtons right" src="images/rightarrow.png"> -->
				<div style="text-align:center"><h3>Your Selected Image</h3></div>
				<div style="margin:auto; padding:10px;"> <img class="imagedropshadow" id="view" width="290" alt="Click on the thumb to pick your backgroud image" src=""/> 
				</div>  
		  <div id="sub" style="text-align:center; display:none;">   <input type="submit" id="submit" class="centered bigbutton" value="Submit"></div>
      		  <span style="font-weight:bold;" id="msg"></span> </div>
    		</div>
		    </div>
			 
	 
          
		
<div class="clear"></div>
		  
				     <div id="note" style="padding-left:20px;">Note:  Please click the image (thumbnail) that you would like to use in your Insightful Art. Also add the two lines of text on the screen  mockup in the original instruction document .</div> <div class="cl"></div> 
        </div>

 
 

<!-- end .dd_container -->
<div class="clear"></div></div>
<div class="footer"></div>
</body>
</html>