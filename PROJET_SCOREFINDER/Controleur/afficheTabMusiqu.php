<?php


require_once '../Modele/DAO/AlbumID.php';
require_once '../Modele/DAO/TrackID.php';
require_once '../Modele/DAO/ArtisteID.php';

	if(!isset($_SESSION))
	{
		session_start();
	}


$toSearch = mb_strtoupper($_GET['word']);

if(strlen($toSearch)!=0)
{


	$playlist = $_SESSION['user']['playlist'];

	$listAlb = array();
	$listeTrack = array();
	$res=array();
	foreach($playlist as $artiste)
	{	
		$estTrack = false;
		$estAlbum = false;
		$nomArtiste = str_replace(" ","-",mb_strtoupper($artiste->getNom()));

		$listeAlbum = $artiste->getAlbums();
		$art = new ArtisteID($artiste->getNom(), null, $artiste->getID());
		
		foreach($listeAlbum as $album)
		{
			$nomAlbum = str_replace(" ","-",mb_strtoupper($album->getTitre()));
			$listeTracks = $album->getTracks();
			$alb = new AlbumID($album->getTitre(), $album->getURLImage(), null, $album->getID());
			
			foreach ($listeTracks as $track) 
			{	
				$nomTrack = str_replace(" ","-",mb_strtoupper($track->getNom()));
				if(strpos($nomArtiste,$toSearch)!==false||strpos($nomAlbum,$toSearch)!==false || strpos($nomTrack,$toSearch)!==false )
				{
						
						$tr= new TrackID( $track->getNom(), $track->getTrackDate(),$track->getGenre(), $track->getID());
						
						$listeTrack[] = $tr;
						$estTrack = true;	
				}
				
			}
					
			if(strpos($nomArtiste,$toSearch)!==false||strpos($nomAlbum,$toSearch)!==false || $estTrack )
			{
				
				$alb->ajouterTrack($listeTrack);
				
				
				$listAlb[]=$alb;

				$estAlbum = true;
				
			}
			$listeTrack = array();	

		}
		
			if(strpos($nomArtiste,$toSearch)!==false|| $estAlbum || $estTrack )
			{
				$art->setAlbums($listAlb);
				$res[] = $art;
			}

			
	$listAlb = array();
	
			
	}
			
	$tab = $res;

	
}else{
	$tab = $_SESSION['user']['playlist'];
}
	
 	if(count($tab)>0)
 	{

	 	foreach($tab as $artiste)
		{
			
			$listeAlbum = $artiste->getAlbums();
			
			foreach($listeAlbum as $album)
			{
				
				$listeTracks = $album->getTracks();
				foreach ($listeTracks as $track)
				{
					
					echo'
							<li class="titre_courant">
								<figure id="album_et_titre">
									<div id="divImageTrack" onmouseleave=filtreFavQuit(this) onmouseenter="filtreFav(this)">
										<div id="conteneurFade" class="conteneurFadeTracks" >
											<div id="ajoutFavImg" onclick="ajouterFavoris(this)" ></div>
										</div>
										<img  src='.$album->getURLImage().'>	
									</div>
									<a href="LaPartition.php" onclick="goToPartition(this)">
										<figcaption>'.$track->getNom().'</figcaption>
										<figcaption>'.$album->getTitre().'</figcaption>
										<figcaption>'.$artiste->getNom().'</figcaption>
									</a>
								</figure>
							</li>
						';
								 
				}
			}
		}
	}
 

?>