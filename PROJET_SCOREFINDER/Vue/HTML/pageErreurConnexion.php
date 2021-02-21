<?php
   if(!isset($_SESSION))session_start();
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ScoreFinder - Erreur de connexion</title>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" type="text/css" href="../CSS/logonPage.css">
        <link rel="stylesheet" media="(min-width : 100px) and (max-width: 1200px)" href="../CSS/pageErreur100a700.css" >
        <link rel="stylesheet" media="(min-width : 1200px) and (max-width: 1920px)" href="../CSS/pageErreur700a1920.css" >
</head>
<body>
    

        <div id="insc" class="log_on">
			<p id="msgErreur">Une erreur est survenue lors de la connexion à la plateforme souhaitée.</p>
			

            <form id="formRedirect" method="post" action="../../Controleur/redirectPagePrincipale.php">
				<input type="submit" id="redirectPagePrincipale"  class="connect" name="redirectPagePrincipale" value="Revenir à la page principale" />
			</form>
        </div>
    
</body>
</html>


