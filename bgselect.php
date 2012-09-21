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

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>InArt</title>
<meta name="description" content="">
<meta name="author" content="">
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
			if(c1%5==0)
			{		 
				c2++;
				$('.scrollContainer').append('<ul class="qq-upload-list panels" id="panel_'+c2+'" style="width:510px;display:none;"></ul>');
			}
			if(c1==0)
			{
				$('#view').attr('src',item);
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
		$(".selimages").draggable({
	
			containment: 'document',
			opacity: 0.6,
			revert: 'invalid',
			helper: 'clone',
			zIndex: 100
	
		});

		 
		$("div.droparea").droppable({
				drop:
						function(e, ui)
						{
							var param = $(ui.draggable).attr('src');
						//alert(param)
							var droppedId =   $(ui.draggable).attr('id');
							 
							// if(!$(this).find('li.'+droppedId))
							 // {
							 $('#'+droppedId).parent().parent().remove();
							$(this).html('<li class="qq-upload-success-flickr grouplist '+droppedId+'"><div class="noselect"></div><a class="nocheck" href="#"><img class="imagedropshadow selimages" width="300" height="280" src="'+param+'"/></a></li>');
							if($.browser.msie && $.browser.version=='6.0')
							{
								param = $(ui.draggable).attr('style').match(/src=\"([^\"]+)\"/);
								param = param[1];
							}
				 
 

						}	
		});
			  
				 
	});

	});	 
	
 
	 
 
</script>
</head>
<body>
<div id="wrapper">
<div class="personal">
  <div class="m10 ml0">
    <div id="logo" class="fl"><a href=""><img src="images/logo.png"/></a></div>
    <div class="cl"></div>
  </div>
  <div class="fr mt10"></div>
  <!--  <div class="separator"></div>-->
  <div class="cl"></div>
  <div id='searchpanel' style="">
    <div class="basic leo-module mod-util" id="refine-search">
      <div class="cl"></div>
      <div id="wrapper2" style="display:block;">
	  
	  <div class="fl" id="note">Note: Click on the images to select. </div> <div class="cl"></div>
        <div id="slider22">
	
          <ul class="qq-upload-list panels" style="width: 950px; display: block;">

<?php
 foreach($images as $key=>$img){
?>
	            <li class="qq-upload-success-flickr">
              <div class="select"></div>
              <a class="check" href="#"><img width="150" height="120" class="imagedropshadow selimages ui-draggable" id="item0" src="uploads/<?php echo $img ?>"></a> </li>
<?php			              
  }
?>          </ul>
          <div class="cl"></div>
           <input type="button" id="selectimages" name="selectimages" value="Confirm"/> 
          <span style="font-weight:bold;" id="msg"></span> <span style="padding-left:20px;">Please select the image that will be the background of their insightful art</span> </div>
      </div>
	  
	    <div id="wrapper3" style="display:none;">
		<div class="" style="width:610px;float:left;">
		            <div class="slider-wrapper theme-default" style="width:500px;">
						 <div id="slider" class="nivoSlider">
       
           				 </div>
			   
					</div>
		
          	 <div id="sliders"> <img class="scrollButtons left" src="images/leftarrow.png">
            <div class="scrollContainer" style="display: inline-block; width: 510px;"> </div>
            	<img class="scrollButtons right" src="images/rightarrow.png">
		    </div>
        
		</div>
			<div id="dropback" class="qq-upload-drop-area droparea" style="width:330px;height:auto;float:right;"><span style="font-size: 20px;" class="groupname1">Drop Your Image Choice Here</span></div>
          
		    
		    
        </div>
	  
    </div>
  </div>
 
 
  <script>(function($){var a=$.ui.mouse.prototype._mouseMove;$.ui.mouse.prototype._mouseMove=function(b){b.button=1;a.apply(this,[b]);}}(jQuery));</script>
  
</div>
</body>
</html>
