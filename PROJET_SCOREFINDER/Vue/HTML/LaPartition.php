<?php


	require_once(realpath(dirname(__FILE__)) . '/../../Modele/DAO/CompteID.php');
	require_once(realpath(dirname(__FILE__)) . '/../../Controleur/traitementInfoCompte.php');

	require_once(realpath(dirname(__FILE__)) . '/../../Controleur/genererPartitions.php');



	if(!isset($_SESSION))
	{
		session_start();
	}

	if(isset($_SESSION['id']))
	{

			
			$aTrack = $_SESSION['user']['musiqueCourante'];
			$aTrackToSend = array(mb_strtoupper($aTrack[1]), mb_strtoupper($aTrack[3]));
			$aCompte = $_SESSION['user']['compte'];
			if(!isset($_SESSION['user']['part']))
			{
				$generateurPart = new genererPartitions();
				$_SESSION['user']['part']= $generateurPart->remplirTableauRes($aTrackToSend);
			}
			$tabRes =$_SESSION['user']['part'];

			
			
			
	}else{
		header("Location: pageConnexion.php");
	}
	


?>

<!DOCTYPE html>
<html>
	<head>
		<title>ScoreFinder/Login</title>
		<meta charset="UTF-8">
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
 		<script src="../JS/changeURLPDF.js"></script>
 		<script src="../JS/hoverTracks.js"></script>
 		<script src="../JS/setPseudo.js"></script>
 		<script src="../JS/verifFormulaire.js"></script>
 		<script src="../JS/ajouterFavoris.js"></script>
 		
		<script>
		  $(function() {
		    $(".rslides").responsiveSlides();
		  });
		</script>

		
	</head>
	<body onload='chargePart(<?php echo json_encode($tabRes);?>)'>
			<?php 
				include_once("parametres.php");
				include_once("enTete.php");
			?>

			<div id="content_pageLaPartition">
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
							
						</div>
					</div>
					<div id="liste_partitions">

						<div id="titre_courant" class="titre_courant">
							
							<figure id="album_et_titre">
									<img src= <?php echo $aTrack[0];?>  >
									<figcaption><?php echo $aTrack[3];?></figcaption>
									<figcaption><?php echo $aTrack[2];?></figcaption>
									<figcaption><?php echo $aTrack[1];?></figcaption>
							</figure>
							
							<div id="ajoutFavBtn">
								<input type="button" onclick="ajouterFavoris(this)" id="ajoutFav" name="ajoutFav" value=" Ajouter aux favoris">
							</div>
							
							
						</div>
						<div id="tabEtPartitions">
							<div id="tabTypeScore">
								<div id="Piano" onclick='changePDF(this,<?php echo json_encode($tabRes);?> )'>
									<span>Piano</span>
								</div><div id="Guitare" onclick='changePDF(this,<?php echo json_encode($tabRes);?> )'>
									<span>Guitare</span>
								</div><div id="Basse" onclick='changePDF(this,<?php echo json_encode($tabRes);?> )'>
									<span>Basse</span>
								</div>
								
								
							</div>
							<div id="pdfPartition">

							</div>

						</div>
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
		

	</body>
	<script type="text/javascript" src="../JS/slideParam.js"></script>
		
</html>









