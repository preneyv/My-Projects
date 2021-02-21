<?php
	require 'connexionBDD.php';
	require_once(realpath(dirname(__FILE__)) . '/../Modele/DAO/CompteID.php');

	$bd = new bdd();
	
	global $bd;
	if (!isset($_SESSION))
	{
			session_start();
	} 

			$res = false;
			$pseudo = $_SESSION['pseudo'];
			$motDePassCrypte=$_SESSION['mdp'];

			$user = $bd->getDB()->prepare("SELECT * FROM compte WHERE userName=:username AND mdp=:pw");
			$user->execute(array(
					'username'=>$pseudo,
					'pw'=>$motDePassCrypte
					
			));
			unset($_SESSION['pseudo']);
			unset($_SESSION['mdp']);
			$res = $user->fetchAll();
			
			if($user->rowCount()==1)
			{
			
				$aCompte = new CompteID($res[0][0],$res[0][3], $res[0][4], $res[0][5], $res[0][2], null, null, $res[0][6], $res[0][7]);
				
				$_SESSION['id']=session_id();
				$_SESSION['user'] = array(
				'compte' => $aCompte, //TODO : remplacer les deux derniers paramètres par la playlist et les favoris de l'utilisateur
				);
				$_SESSION['connected']=true;
				header("Location: ../Vue/HTML/Mes_partitions.php");
			}
			else{

				$_SESSION['notConnected']=true;
				header("Location: ../Vue/HTML/pageInscription.php");
			}
?>