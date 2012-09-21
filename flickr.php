<?php
class Flickr { 
	private $apiKey = 'b3a024f687b0b67a04ae8928580d064a'; 
 
	public function __construct() {
	} 
 
	public function search($query = null) { 
	
	$search ='http://api.flickr.com/services/feeds/photos_public.gne?id=' . urlencode($query) . '&lang=en-us&api_key=b3a024f687b0b67a04ae8928580d064a&per_page=12&format=php_serial';
 
		$result = @file_get_contents($search); 
		
		if($result==FALSE){
		echo "Nothing found";
		die();
		}
		$result = unserialize($result); 
		return $result; 
	} 
	
		public function keywordSearch($query = null) { 
		$search = 'http://flickr.com/services/rest/?method=flickr.photos.search&api_key=' . $this->apiKey . '&text=' . urlencode($query) . '&per_page=12&format=php_serial';
		//echo $search;
		$result = file_get_contents($search); 
		 
		return ( unserialize($result)); 
	}
}
?>