<?php

	if(!isset($_SESSION))
	{
		session_start();
	}
	if(isset($_SESSION['deconnexion']))
	{
		session_destroy();
	}
	
	

?>
<!DOCTYPE html>
<html>
	<head>
		<title>ScoreFinder - Connexion</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="../CSS/loginPage.css">
		<link rel="stylesheet" media="(min-width : 100px) and (max-width: 700px)" href="../CSS/loginPage100a700px.css" >
		<link rel="stylesheet" media="(min-width : 700px) and (max-width: 1920px)" href="../CSS/loginPage700a1920px.css" >
	</head>
	<body>
		<div id="log_in_log_on" class="log">

			<div id="log_in" class="log_in">
				<h2>Se connecter</h2>
				<?php
					if(isset($_SESSION['notConnected']))
					{
						echo '<p style="color : #03abd5; font-size : 12px;text-align : center">Compte inconnu</p>';
						unset($_SESSION['notConnected']);
					}
				?>
				<form method="post" action="../../Controleur/verifConnection.php">
					<input type="text" id="identifiant" class="id" name="identifiant" placeholder="Identifiant"/><br>
					<input type="password" id="mdp" class="passWord" name="mdp" placeholder="Mot de passe"/><br>
					<input type="submit" id="seConnecter" class="connect" name="seConnecter" value="Connexion" />
				</form>

			</div>

			

			<div id="log_on" class="log_on">
				<h2>Inscription</h2>
				<p>
					Vous êtes apprentis guitariste ou un maître 
					en piano et vous voulez acceder le plus vite possible 
					à un grand nombre de partition ou de tablature ? 
					Alors n'attendez pas et inscrivez vous sur notre site.
				</p>
				<form method="post" action="pageInscription.php">
					<input type="submit" id="nouveauCompte" class="newAccount" name="nouveauCompte" value="Creer compte" />
				</form>
			<div>
		</div>

	</body>
</html>