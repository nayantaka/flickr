<?php
	$url='https://www.flickr.com/services/rest/?method=flickr.photos.search&api_key=c627991fc2b2f4372196745eabd2a86a&text=beautiful%20mountain';
	
	$url = file_get_contents($url);
	$xml = simplexml_load_string($url);
	//print_r($xml);
	foreach($xml->photos->photo as $foto){
		echo $foto['title'];
		$alamat = 'https://farm' . $foto['farm'] . '.staticflickr.com/' . 
		$foto['server'] . '/' .
		$foto['id'] . '_' .
		$foto['secret'] . '.jpg'
		;

		echo '<br>';
		echo "<img src='$alamat'>";
		echo '<hr><br>';
	}
?>