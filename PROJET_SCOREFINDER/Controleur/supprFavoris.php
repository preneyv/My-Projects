<?php

	if(!isset($_SESSION))
	{
		session_start();
	}

	$urlImage = $_POST['url'];
	$artiste = $_POST['art'];
	$album = $_POST['alb'];
	$track = $_POST['tr'];
	$data = array();
	$newEntry = array($urlImage, $artiste, $album, $track);
	$exist = false;
	$res=null;
	if(isset($_COOKIE['favoris']))
	{
			$data = json_decode($_COOKIE['favoris']);
				
	}
	
	$tabCourant=null;
	foreach ($data as $key=> $value) {
		
		$tabCourant = $value;
		
		if(strcmp(strtoupper($value[1]), strtoupper($newEntry[1]))==0 && strcmp(strtoupper($value[2]), strtoupper($newEntry[2]))==0 && strcmp(strtoupper($value[3]), strtoupper($newEntry[3]))==0)
		{
			$res= $value[3]." + ".$newEntry[1]." + ".$key;
			echo "mem";
			unset($data[$key]);

			
		}
	}
	$data = array_values($data);
	
	setcookie('favoris', json_encode($data),time()+(365*24*3600));


	
	
	
	



	
?>
