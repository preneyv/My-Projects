<?php

	if(!isset($_SESSION))
	{
		session_start();
	}
	$_SESSION['deconnexion']=true;
	header("Location: ../Vue/HTML/pageConnexion.php");
?>