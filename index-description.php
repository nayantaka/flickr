<!DOCTYPE html>
<html lang="en">
<head>
  <title>Wallpaper Bunga dengan Flickr</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
  <h1>Wallpaper Bunga Dengan Flickr</h1>
  <p>Project Web Service</p> 
</div>
  
<div class="container">
  <div class="row">
    <div class="col-sm-3">
      <h3>Kategori</h3>
	  <ul>
	  <li>
		<a href="index.php?bunga=flower">Semua Bunga</a>
	  </li>
	  <li>
		<a href="index.php?bunga=rose">Mawar</a>
	  </li>
	  </ul>
    </div>
    <div class="col-sm-9">
      <h3>Gambar</h3>        
      <?php
	if(isset($_REQUEST['bunga'])){
		$bunga = $_REQUEST['bunga'];
	}
	else {
		$bunga = 'flower';
	}
	
	$url='https://www.flickr.com/services/rest/?method=flickr.photos.search&api_key=c627991fc2b2f4372196745eabd2a86a&text='.$bunga.'&per_page=9';
	
	
	$url = file_get_contents($url);
	$xml = simplexml_load_string($url);
	$numOfCols = 3;
	$rowCount = 0;
	$bootstrapColWidth = 12 / $numOfCols;
	?>
	<div class="row">

	<?php
	//print_r($xml);
	foreach($xml->photos->photo as $foto){
	?>  
        <div class="col-sm-<?php echo $bootstrapColWidth; ?>">
		<?php
		echo $foto['title'];
		$alamat = 'https://farm' . $foto['farm'] . '.staticflickr.com/' . 
		$foto['server'] . '/' .
		$foto['id'] . '_' .
		$foto['secret'] . '.jpg'
		;
		echo '<br>';
		echo "<img src='$alamat' class='img-thumbnail'>";
		$urldesc='https://www.flickr.com/services/rest/?method=flickr.photos.getInfo&api_key=c627991fc2b2f4372196745eabd2a86a&photo_id='.$foto['id'];
		$urldesc = file_get_contents($urldesc);
		$xmldesc = simplexml_load_string($urldesc);
		echo $xmldesc->photo->description;
		?>
		</div>
		<?php
		$rowCount++;
		if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
	}
?>
	</div>
    </div>
  </div>
</div>

</body>
</html>
