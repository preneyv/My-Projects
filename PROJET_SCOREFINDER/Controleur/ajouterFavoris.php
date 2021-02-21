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
	$res="";
	if(isset($_COOKIE['favoris']))
	{
			$data = json_decode($_COOKIE['favoris']);
			$exist = exist($data, $newEntry);
			
	}

	if($exist==false)
	{
		$data[]=$newEntry;
		setcookie('favoris', json_encode($data),time()+(365*24*3600));
		$res="ajouter";
	}else{
		$res="nonAjouter";
	}
	
	echo $res;
	
	

	function exist($tabCookie, $nouvelleEntree)
	{
		$res = false;
		
		if($tabCookie!==null)
		{


			foreach($tabCookie as  $value) 
			{
				
				
				if(strcmp(strtoupper($value[1]), strtoupper($nouvelleEntree[1]))==0 && strcmp(strtoupper($value[2]), strtoupper($nouvelleEntree[2]))==0 && strcmp(strtoupper($value[3]), strtoupper($nouvelleEntree[3]))==0)
				{
					$res = true;
				}
			}
		}
		return $res;
	}


	
?>
