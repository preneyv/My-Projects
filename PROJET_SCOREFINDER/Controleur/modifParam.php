<?php 
		require_once '../Modele/DAO/CompteDAO.php';
		require_once '../Modele/DAO/CompteID.php';
		require_once '../Modele/ScoreFinder/Compte.php';
		
		if (!isset($_SESSION))
		{
			session_start();
		} 
		
		
		$deezer;
		$spotify;
		$compteid = $_SESSION['user']['compte'];
		
		$compteDAO = new CompteDAO();

		if(isset($_POST['newPseudo']))
		{
			$aUserName = htmlspecialchars($_POST['newPseudo']);
			
			if(strcmp($compteid->getUserName(),$aUserName)!=0)
			{
				$compteDAO->update($compteid,'userName',$aUserName);
				$compteid->setUserName($aUserName);
			}
		}
		
		if(isset($_POST['onoffDeezer']))
		{
			if($_POST['onoffDeezer']=="true")
			{
				$deezer =1;
			}else{

			 	$deezer=0;
			 }

			 if($compteid->getAutorisationDeezer()!=$deezer)
			{
				$compteDAO->update($compteid,'playlistDeezer',$deezer);
				$compteid->setAutorisationDeezer($deezer);
			}
		}
			

		

		if(isset($_POST['onoffSpotify']))
		{
			if($_POST['onoffSpotify']=="true")
			{
				$spotify =1;
			}else{

			 	$spotify=0;
			 }

			 if($compteid->getAutorisationSpotify()!=$spotify)
			{
			$compteDAO->update($compteid,'playlistSpotify',$spotify);
			$compteid->setAutorisationSpotify($spotify);
			}
		}

		if(isset($_POST['newMotDePasse']))
		{
			$aUserMdp = sha1($_POST['newMotDePasse']);

			$compteDAO->update($compteid,'mdp',$aUserMdp);
			
		}
		
		
		
	echo true;
		
		

		
		

	
		

?>