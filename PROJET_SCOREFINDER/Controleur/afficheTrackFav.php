<?php
	
	
	
	if(isset($_COOKIE['favoris']))
	{	$cookie = $_COOKIE['favoris'];
		$variable = JSON_decode($cookie);
		
		if($variable!=null)
		{


			foreach ($variable as $key=> $value) 
			{
				$tabCourant = $value;
				
				echo'
					<li class="titre_courant">
						<figure id="album_et_titre">
							<div id="divImageTrack" onmouseleave=filtreFavQuit(this) onmouseenter="filtreFav(this)">
								<div id="conteneurFade" class="conteneurFadeFav" >
									<div id="supprFavImg" onclick="supprimerFavoris(this)" ></div>
								</div>
								<img  src='.$tabCourant[0].'>	
							</div>
							<a href="LaPartition.php" onclick="goToPartition(this)">
								<figcaption>'.$tabCourant[3].'</figcaption>
								<figcaption>'.$tabCourant[2].'</figcaption>
								<figcaption>'.$tabCourant[1].'</figcaption>
							</a>
						</figure>
					</li>';
			}
		}
	}
?>