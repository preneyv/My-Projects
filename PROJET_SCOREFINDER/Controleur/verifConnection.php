<?php

	require 'connexionBDD.php';
	require_once '../Modele/DAO/CompteID.php';

	$bd = new bdd();
	
	global $bd;
	if (!isset($_SESSION))
	{
			session_start();
	} 


	if(isset($_POST['seConnecter']))
	{
		
		if(isset($_SESSION['notConnected']))
		{
			unset($_SESSION['notConnected']);
		}
		
		if(isset($_POST['identifiant']) && isset($_POST['mdp']))
		{
			$res = false;
			$motDePassCrypte=sha1($_POST['mdp']);
			$user = $bd->getDB()->prepare("SELECT * FROM compte WHERE userName=:username AND mdp=:pw");
			$user->execute(array(
					'username'=>$_POST['identifiant'],
					'pw'=>$motDePassCrypte
					
			));
			$res = $user->fetchAll();
			
			if($user->rowCount()==1)
			{
			
				$aCompte = new CompteID($res[0][0],$res[0][3], $res[0][4], $res[0][5], $res[0][2], null, $res[0][6], $res[0][7]);
				
				$_SESSION['id']=session_id();
				$_SESSION['user'] = array(
				'compte' => $aCompte, //TODO : remplacer les deux derniers paramètres par la playlist et les favoris de l'utilisateur
				);
				$_SESSION['connected']=true;
				header("Location: ../Vue/HTML/Mes_partitions.php");
			}
			else{
				$_SESSION['notConnected']=true;
				header("Location: ../Vue/HTML/pageConnexion.php");
			}

		}else{
			header("Location: ../Vue/HTML/pageConnexion.php");
		}
		

	}else{
			header("Location: ../Vue/HTML/pageConnexion.php");
	}
?>