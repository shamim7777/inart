<?php

$admin = $_GET['admin'];

if($admin == "true")
{
	header("Location:upload.php");
}

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
    
	var cur = 1;
	var c2 = 0;
	var save  = false;
	$("#searchweb").click(function(){
	$('#flickr-data').html('Loading.....');
	 var action = 'web';
	  var q = $('#web').val();    
	   $.ajax({
                url: "search.php",
                type: "GET",            
                cache	: false,
                data: 'action='+action+'&q='+q,
                success: function(data) {
 					$('#flickr-data').html(data);
					$('.note').show();
					$('.home').toggleClass('active');
					$('.upload').toggleClass('active');
                }
            });


	});
	
	$(".search").click(function() {
	$('#flickr-data').html('Loading.....');
 
     var q = $('#flickr').val();    
	 var k = $('#keyword').val();
	 
	 
	 var action = 'id';
	 if(q==''){
	 action = 'keyword';
	 q=k;
	 }
	 if(q!=''&&k!=""){
	 action = 'keyword';
	 q=k;
	 }
	 if(q==''&&k==""){
	 action = 'id';
	 
	 }    
            $.ajax({
                url: "search.php",
                type: "GET",            
                cache	: false,
                data: 'action='+action+'&q='+q,
                success: function(data) {
 					$('#flickr-data').html(data);
					$('.note').show();
					$('.home').toggleClass('active');
					$('.upload').toggleClass('active');
                }
            });

            return false;
        });
 
 	$('.check').live('click',function(){
	
		$(this).prev().toggleClass('tick');
		
		if($(this).prev().hasClass('tick'))
		{
			var src = $(this).find('img').attr('src');
			slectedImages.push(src);
		}
		 //console.log(slectedImages);
	});
  	$('#reset').live('click',function(){
	
		 
			slectedImages = null;
			$('.qq-upload-list').empty();
		 
	});
 
 	$('#back').live('click',function(){
		$('#wrapper3').hide();
		$('#wrapper2').show();
		
		$('.nav').toggleClass('active');
		// $('.noactive').addClass('active');
		 
		 cur = 1;
	     c2 = 0;
		$('.scrollContainer').empty();
	});
 	$('#selectimages').live('click',function(){
 		
		
		 $('.home').removeClass('active');
	     $('.upload').removeClass('active'); 
		 $('.final').addClass('active');  
		$('#wrapper2').hide();
		$('#wrapper3').show();
	    console.log(slectedImages);
		var c1 = 0;
		$.each(slectedImages, function(key,item){
		if(c1%8==0)
		{		 
			c2++;
			$('.scrollContainer').append('<ul class="qq-upload-list panels" id="panel_'+c2+'" style="width:850px;display:none;"></ul>');
		}
				
			$('#panel_'+c2).append('<li id="mem'+key+'" class="qq-upload-success-flickr members ui-draggable"><div class="noselect"></div><a class="nocheck" href="#"><img rel="'+key+'" class="imagedropshadow selimages" id="item'+key+'" width="80" height="80" src="'+item+'"/></a></li>');			
		c1++;	
		})
		
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
 		var $gallery = $( ".members, .group" );
		$( "img", $gallery ).live("mouseenter", function(){
			 var $this = $(this);
			  if(!$this.is(':data(draggable)')) {
			    $this.draggable({
			     	helper: "clone",
					containment: $( "#demo-frame" ).length ? "#demo-frame" : "document", 
					cursor: "move"
			    });
			  }
		});
	
		
		$(".group").droppable({
			activeClass: "ui-state-highlight",
			drop: function( event, ui ) {
				var m_id = $(ui.draggable).attr('rel');
				
				if(!m_id)
					{
						casePublic = true;
						var m_id = $(ui.draggable).attr("id");
						m_id = parseInt(m_id.substring(3));
					}					
				var g_id = $(this).attr('id');
				var image_src = $("#mem"+m_id).find("img").attr("src");
				var image_rel = $("#mem"+m_id).find("img").attr("rel");
				$("#mem"+m_id).hide();
				$("#"+g_id+" ul").append("<li><img class='imagedropshadow selimages' width='80' height='80' src='"+image_src+"' rel='"+image_rel+"'</li>");
				$("#added"+g_id).animate({"opacity" : "10" },10);
				$("#added"+g_id).show();
				$("#added"+g_id).animate({"margin-top": "-50px", "z-index":"999"}, 450);
				$("#added"+g_id).animate({"margin-top": "0px","opacity" : "0" }, 450);
			},
			 out: function(event, ui) {
			 	var m_id = $(ui.draggable).attr('rel');
				var g_id = $(this).attr('id');			 	
			 	$(ui.draggable).hide("explode", 1000);
			 	$("#removed"+g_id).animate({"opacity" : "10" },10);
				$("#removed"+g_id).show();
				$("#removed"+g_id).animate({"margin-top": "-50px"}, 450);
				$("#removed"+g_id).animate({"margin-top": "0px","opacity" : "0" }, 450);
			 	$("#mem"+m_id).show();
			 }
		});	  
				 
	});
	
	 $('.groupname1').bind('click',function(){
		var name = $(this).html();
		$(this).html('');		
		$(this).after('<input type="text" name="grpname1" id="grpname1" /><input type="button" value="save" id="save1" />');		
		
	});
 	$('.groupname2').bind('click',function(){
		var name = $(this).html();
		$(this).html('');		
		$(this).after('<input type="text" name="grpname2" id="grpname2" /><input type="button" value="save" id="save2" />');	
	});
	$('#save1').live('click',function(){
		 save1();
	});
	
	$('#save2').live('click',function(){
		 save2();
	});
	
	 $("#various1").fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
	 });
	
	$('#submit').bind('click',function(){	
	 	save1();
		save2();
		var grp1 = $('.groupname1').html();
		var grp2 = $('.groupname2').html();	
		var grpimg1 = "";
		var grpimg2 = "";
		$('.g1 ul li img').each(function(){
		if($(this).is(":visible") == true)
		grpimg1 = grpimg1+ $(this).attr('src')+',';
		
		});

		$('.g2 ul li img').each(function(){
		if($(this).is(":visible") == true)
		 grpimg2 = grpimg2+ $(this).attr('src')+',';
		});
		var email = $('#email').val();
		
		if(email =="")
		{
			 alert('Email address is required');			
		}		
		else{
		
			 $.ajax({
						url: "process.php",
						type: "POST",            
						cache	: false,
						data: 'q=save&name1='+grp1+'&name2='+grp2+'&images1='+grpimg1+'&images2='+grpimg2+'&email='+email,
						success: function(data) {
						
							$('#various1').click();
						
						}
			 });
		
		 
		 }
		
	}); 
	
	function save1(){
		
			var val = $('#save1').prev().val();
			//console.log(val);
			 $('#save1').prev().prev().attr('id','xxxxxxxxxxxxxxxx')
			 $('#save1').prev().prev().html(val);		
			 $('#save1').prev().remove();
			 $('#save1').remove();
		
	}
	
	function save2(){
		  
			var val =  $('#save2').prev().val();
			 $('#save2').prev().prev().html(val);	
			 $('#save2').prev().remove();
			 $('#save2').remove();
		 
	}
	
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
      <li><a href="index.php" class="nav active home">Home</a></li>
      <li><a href="#" class="upload">Upload</a></li> 
      <li><a class="nav noactive final" href="#">Image Finalization</a></li>
	  <li><a href="images.php"  class="nav noactive">My Images</a></li>
    </ul>
  </div>
  <div class="clear"></div>
  <div id="wrapper2">
    <div class=" floatleft imageupload">
      <div class="imageuploadinner">
        <div id="file-upload">
          <div class="qq-uploader">
            <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;left: 95px!important;">Upload
              <input type="file" multiple="multiple" name="file" style="position: absolute; right: 0px; top: 0px; font-family: Arial; font-size: 118px; margin: 0px; padding: 0px; cursor: pointer; opacity: 0;">
            </div>
            <ul class="qq-upload-list whitearea" style="width: 300px;">
            </ul>
			
          </div>
		  
        </div>
		<div class="notes" style="display:none;">Note:Selected images have a green checkmark – click again to deselect </div>
        <div class="clear"></div>
      <div style="margin:auto;text-align:center;">  <input type="submit" id="selectimages" class="centered bigbutton" value="Submit"> <input type="button" id="reset" class="centered bigbutton" value="Reset"></div>
        <span style="font-weight:bold;" id="msg"></span> </div>
    </div>
    <div class=" floatright imageupload2">
	 <h3 style="padding:20px;" class="floatleft">Upload from Flickr</h3>
      <ul class="importfrom">
        <li>
          <label class="floatleft">User ID</label>
          <img src="images/flkr.png">
          <input type="text" id="flickr" class="floatleft">
          <input type="button" value="Search" class="floatleft buttondefault lineheight search">
        </li>
        <div class="clear" style="height:20px"></div>
        <li>
          <label class="floatleft">Keyword(s)</label>
          <img src="images/flkr.png">
          <input type="text" class="floatleft">
          <input id="keyword" type="button" value="Search" class="floatleft buttondefault lineheight search">
        </li>
      </ul>
      <div style="padding-left:10px;">
        <div id="note" class="fl note" style="display:none;" >Note:  Click on the images to select.</div>
        <div class="cl"></div>
        <ul id='flickr-data' class="qq-upload-list">
        </ul>
      </div>
    </div>
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
           			 
           			 $('.qq-upload-success').last().html('');
					 $('.qq-upload-success').last().html('<div class="select tick"></div><a class="check" href="#"><img class="imagedropshadow" width="80" height="80" src="uploads/'+fileName+'"/></a>');
                slectedImages.push('uploads/'+fileName);
				$('.notes').show();
				//$('.qq-upload-success .select').prev().toggleClass('tick');
			 }
			 });      
        }
        
        // in your app create uploader as soon as the DOM is ready
        // don't wait for the window to load  
        window.onload = createUploader;     
    </script>
    <!-- end .dd_container -->
	
	<div id="search-gerenal" style="text-align:center;"><div>
	
	<li>
        
          
          <input type="text" class="floatleft" name="web" id="web" placeholder="Search the web" >
          <input type="button" class="floatleft buttondefault lineheight" value="Search" id="searchweb">
        </li>
	
	</div>
	
	</div>
  </div>
  <div id="wrapper3" style="display:none;padding:10px">
    <div id="note" class="fl note" style="display:none;" >
      <h1>Your selected images:</h1>
    </div>
    <div id="back" class="fr"><a id='back' href="javascript:;">Change selected images</a></div>
    <div class="cl"></div>
    <div id="slider"> <img class="scrollButtons left" style="padding-left: 10px;" src="images/leftarrow.png">
      <div class="scrollContainer" style="display: inline-block; width: 810px;top: 43px;position: relative;"> </div>
      <img class="scrollButtons right" src="images/rightarrow.png"> </div>
    <div class="cl"></div>
	<div class="groups" id="groupsall">
		<div class="group ui-droppable g1" id="1"><span class="groupname1">Group 1</span>
			<div style="display:none;" class="add" id="added1">
				<img width="25" height="25" src="images/green.jpg">
			</div>
			<div style="display:none;" class="remove" id="removed1">
				<img width="25" height="25" src="images/red.jpg">
			</div>
			<ul></ul>
		</div>
    
      		<div class="group ui-droppable g2" id="2"><span class="groupname2">Group 2</span>
			<div style="display:none;" class="add" id="added2">
				<img width="25" height="25" src="images/green.jpg">
			</div>
			<div style="display:none;" class="remove" id="removed2">
				<img width="25" height="25" src="images/red.jpg">
			</div>
			<ul></ul>
		</div>
 
    </div>
    <div class="cl"></div>
    <div style="text-align: center;padding-top:10px;">
	 <div style="width:60px;display:inline-block;">Email:</div><input type="text" name="email" id="email"/> </br>
      <input type="button" id="submit" name="submit" value="Submit">
    </div>
    <span style="font-weight:bold;" id="msg"></span> </div>
  <div class="clear"></div>
</div>
<div class="footer"></div>
<script>(function($){var a=$.ui.mouse.prototype._mouseMove;$.ui.mouse.prototype._mouseMove=function(b){b.button=1;a.apply(this,[b]);}}(jQuery));</script>
<div style="display: none;">
  <div id="inline1" style="width:400px;height:100px;overflow:auto;font-size:16px;line-height:1em;"> Thanks your image  slection has been submitted and your Insightful Art is on it's way! Please be sure that you have submitted any other pieces (signature etc. per prior instructions) </div>
</div>
<a title=""  style="display:none;" href="#inline1" id="various1">Submit</a>
</div>
</body>
</html>
