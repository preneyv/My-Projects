<?php
   if(!isset($_SESSION))session_start();
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ScoreFinder - Récupération des données Deezer réussie</title>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" type="text/css" href="../CSS/logonPage.css">
        <link rel="stylesheet" media="(min-width : 100px) and (max-width: 1200px)" href="../CSS/pageErreur100a700.css" >
        <link rel="stylesheet" media="(min-width : 1200px) and (max-width: 1920px)" href="../CSS/pageErreur700a1920.css" >
</head>
<body>
    
        <div id="insc" class="log_on">
			<p id="msgErreur">Les données Deezer ont bien été mises à jour.</p>
			<input type="submit" id="redirectPagePrincipale"  class="connect" name="redirectPagePrincipale" value="OK" onclick="closeCurrentWindow()" />
        </div>
    
	<script src="../JS/closeWindow.js"></script>
</body>
</html>


