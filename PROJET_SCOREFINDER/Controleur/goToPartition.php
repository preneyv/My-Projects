<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

			$urlImage = $_POST['urlImage'];
			$nomArtiste = $_POST['nomArtiste'];
			$nomAlbum = $_POST['nomAlbum'];
			$nomTrack = $_POST['nomTrack'];
		if(isset($_SESSION['user']['musiqueCourante'])) unset($_SESSION['user']['musiqueCourante']);
		$_SESSION['user']['musiqueCourante'] = array($urlImage,$nomArtiste,$nomAlbum,$nomTrack);

	return true;
	

?>