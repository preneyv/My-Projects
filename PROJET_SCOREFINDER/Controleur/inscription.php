<?php

    if(!isset($_SESSION))session_start();

require(__DIR__.'/../Modele/ScoreFinder/Compte.php');
require(__DIR__.'/../Modele/DAO/CompteDAO.php');

if(isset($_POST)){

	if (isset($_POST['pseudo']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['mdp']) && isset($_POST['mdpConf'])){
		
		$pseudo = htmlspecialchars($_POST['pseudo']);			//Transformation des caractères spéciaux
		$nom = htmlspecialchars($_POST['nom']);
		$prenom = htmlspecialchars($_POST['prenom']);
		$mail = htmlspecialchars($_POST['mail']);
		$mdp = sha1(htmlspecialchars($_POST['mdp']));
		$mdpConf = sha1(htmlspecialchars($_POST['mdpConf']));
		
		if(strcmp($mdp, $mdpConf) != 0){
			
				$_SESSION['erreurMdp']=true;		//Ceci sera géré plus tard dans les fichiers JS
				
				if(isset($_SESSION['user']))
					unset ($_SESSION['user']);
				header("Location: ../Vue/HTML/pageInscription.php");
		}
		else if (strcmp($_POST['pseudo'], "")==0 || strcmp($_POST['nom'], "")==0 || strcmp($_POST['prenom'], "")==0 || strcmp($_POST['mail'], "")==0 || strcmp($_POST['mdp'], "")==0 || strcmp($_POST['mdpConf'], "")==0){
				
				$_SESSION['erreurSaisies']=true;				//De même, ceci sera aussi géré dans les fichiers JS	
				if(isset($_SESSION['user']))
					unset ($_SESSION['user']);
				header("Location: ../Vue/HTML/pageInscription.php");
			
		}
		else {
			
			if(isset($_POST['deezerData']))
			{
				$deezer =1;
			}else{
				$deezer=0;
			}

			if(isset($_POST['spotifyData']))
			{
				$spotify =1;
			}else{
				$spotify=0;
			}

			$compteUser = new Compte($pseudo, $prenom, $nom, $mail,null, null, $spotify, $deezer);
			$compteDao = new CompteDAO();
			if($compteDao->exists($compteUser,$mdp))
			{
				$_SESSION['compteExistant']=true;
				unset($compteUser);
				unset($compteDao);
				header("Location:".$_SERVER['HTTP_REFERER']);
			}
			$compteDao->add($compteUser, $mdp);
			
			$_SESSION['mdp']=$mdp;
			$_SESSION['pseudo']=$pseudo;
			header("Location: connexionApresInscription.php");
		}
	}
}

?>