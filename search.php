<?php
$s = $_GET['q'];
$action = $_GET['action'];
require_once('flickr.php'); 
$Flickr = new Flickr; 

if($action == 'id'){
$data =$Flickr->search($s); 
 // print_r($data);
// print_r($data['items']['media']);
$i=0;
foreach($data[items] as $photo) { 
 if($i==12)
break;
	// the image URL becomes somthing like 
	// http://farm{farm-id}.static.flickr.com/{server-id}/{id}_{secret}.jpg  
	 echo '<li class="qq-upload-success-flickr"><div class="select"></div><a class="check" href="#"><img height="80" width="80" class="imagedropshadow" src="'.$photo[m_url].'"/></a></li>'; 
$i++;
}
}

if($action == 'keyword')
{

$data2 = $Flickr->keywordSearch($s); 

 

$i=0;
foreach($data2['photos']['photo'] as $photo) { 
 

	// the image URL becomes somthing like 
	// http://farm{farm-id}.static.flickr.com/{server-id}/{id}_{secret}.jpg  
	$src =  'http://farm' . $photo["farm"] . '.static.flickr.com/' . $photo["server"] . '/' . $photo["id"] . '_' . $photo["secret"] . '.jpg"'; 
	 echo '<li class="qq-upload-success-flickr"><div class="select"></div><a class="check" href="#"><img height="80" width="80" class="imagedropshadow" src="'.$src.'"/></a></li>'; 
	
	$i++;
}
}



if($action=="web")
{

$url = "https://ajax.googleapis.com/ajax/services/search/images?" .
       "v=1.0&rsz=8&q=$s&userip=".$_SERVER['REMOTE_ADDR'];
 

// sendRequest
// note how referer is set manually
$i=0;
 $result = json_decode(@file_get_contents($url)); 
 //print_r($result);
 foreach($result->responseData->results as $item)
 {
//print_r($item);
	
	 if($i==12)
break;
	// the image URL becomes somthing like 
	// http://farm{farm-id}.static.flickr.com/{server-id}/{id}_{secret}.jpg  
	 echo '<li class="qq-upload-success-flickr"><div class="select"></div><a class="check" href="#"><img height="80" width="80" class="imagedropshadow" src="'.$item->unescapedUrl.'"/></a></li>'; 
$i++;
 }
 

}


?>