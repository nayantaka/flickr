<h1>Galeri Mobil</h1>
<hr>
<h3>Kategori Mobil</h3>
<a href="index.php?mobil=car">Semua Tipe</a> |
<a href="index.php?mobil=mobilio">Mobilio</a> | Agya | Civic
<br>
<?php
	if(isset($_REQUEST['mobil'])){
		$mobil = $_REQUEST['mobil'];
	}
	else {
		$mobil = 'car';
	}
	
	$url='https://www.flickr.com/services/rest/?method=flickr.photos.search&api_key=c627991fc2b2f4372196745eabd2a86a&text='.$mobil;
	
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
		echo "<img src='$alamat' width=300px height=300px>";
		echo '<hr><br>';
	}
?>