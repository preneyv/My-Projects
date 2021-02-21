<?php
	
	
	require_once(realpath(dirname(__FILE__)) . '/../../Modele/DAO/CompteID.php');
	require_once(realpath(dirname(__FILE__)) . '/../../Controleur/traitementInfoCompte.php');


	if(!isset($_SESSION))
	{
		session_start();

	}


	if(isset($_SESSION['id']))
	{


			$aCompte = $_SESSION['user']['compte'];
			
			
				$_TrecupPlaylist= new traitementPlaylistCompte();
				$_SESSION['user']['playlist'] = $_TrecupPlaylist-> recupDataPlaylist($aCompte);

			
			

		$_tabPlaylist = $_SESSION['user']['playlist'] ;
		if(isset($_SESSION['user']['part']))
		{
				
				unset($_SESSION['user']['part']);
		}
		
		

	}else{
		header("Location: pageConnexion.php");
	}

	

?>


<!DOCTYPE html>

<html>
	<head>
		<title>ScoreFinder/Mes_Partitions</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, target-densitydpi=device-dpi"/>
		<link rel="stylesheet" type="text/css" href="../CSS/enTete.css">
		<link rel="stylesheet" media="(min-width : 100px) and (max-width: 1000px)" href="../CSS/MesPartitions100a700px.css" >
		<link rel="stylesheet" media="(min-width : 1000px) and (max-width: 1920px)" href="../CSS/MesPartitions700a1920px.css" >
		<link rel="icon" type="image/png" href="../Images/logoSF.png"/>
		
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

 		<script src="../JS/responsiveslides.min.js"></script>
 		<script src="../JS/scriptChangePseudo.js"></script>
 		<script src="../JS/setPseudo.js"></script>
 		<script src="../JS/hoverTracks.js"></script>
 		<script src="../JS/ajouterFavoris.js"></script>
 		<script src="../JS/goToPartitionPage.js"></script>
 		<script src="../JS/verifFormulaire.js"></script>
 		

 		
 		
		<script>
		  $(function() {
		    $(".rslides").responsiveSlides();
		  });
		</script>

		
	</head>
	<body  >

			
			<?php 
				
				include_once("parametres.php");
				include_once("enTete.php");
			?>

			<div id="content" >
				<div id="partieGauche_page" class="partieGauche_page">

					<div id="barreParamFav">
						<div id="btnParam100a1000px">
							<input type="button" id="param" class="param" value="Paramètres">
						</div><div id="btnPFavoris100a1000px">
							<input type="button" id="favoris" class="favoris" value="Favoris">
						</div>
					</div>
					<div id="barre_de_trie">
						<div id="partie_droite_barre_trie">
							<img src = "../Images/loupe.jpg"  id="loupe">
							<input type="text" id="recherche" >
						</div>
					</div>

					<div id="liste_partitions">

						
						
							<ul>
							<script type='text/javascript'>
								$(document).ready(function(){
									$('#liste_partitions ul').load('../../Controleur/afficheTabMusiqu.php?word='+$('#recherche').val().replace(/\s/g,'-'));
									$("#recherche").keyup(function(event){

										$('#liste_partitions ul').load('../../Controleur/afficheTabMusiqu.php?word='+$('#recherche').val().replace(/\s/g,'-'));
									});
								});
								
							</script>
						</div>
					

				</div>

				<div id="partieDroite_page" class="partieDroite_page nonafficheFav">

					<div id="enTeteFavoris">
						<h2>Mes favoris :</h2>
					</div>
					<div id="liste_Favoris">
						<ul>
							<script type='text/javascript'>
							$(document).ready(function(){
								$('#liste_Favoris ul').load('../../Controleur/afficheTrackFav.php?cookie='+$.cookie('favoris'));
								});
							</script>
						</ul>
					</div>
					
				</div>
			</div>
		<script type="text/javascript" src="../JS/slideParam.js"></script>

	</body>
	

		
</html>









