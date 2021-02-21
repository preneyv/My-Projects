<?php
   if(!isset($_SESSION))session_start();
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ScoreFinder - Inscription</title>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" type="text/css" href="../CSS/logonPage.css">
        <link rel="stylesheet" media="(min-width : 100px) and (max-width: 1200px)" href="../CSS/logonPage100a700px.css" >
        <link rel="stylesheet" media="(min-width : 1200px) and (max-width: 1920px)" href="../CSS/logonPage700a1920px.css" >
        <script src="../JS/verifFormulaire.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script type = "text/javascript" 
         src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
</head>
<body>
    

        <div id="insc" class="log_on">

            <h2 id="inscTitle">Inscription</h2>
            <?php
                if(isset($_SESSION['compteExistant']))
                {
            ?>  <span>Le compte existe déjà</span>
            <?php
                unset($_SESSION['compteExistant']);
                }
            ?>
            <?php
                if(isset($_SESSION['erreurMdp']))
                {
            ?>  <span>Une erreur est survenue lors de la saisie des mots de passe</span>
            <?php
                unset($_SESSION['erreurMdp']);
                }
            ?>
            <?php
                if(isset($_SESSION['erreurSaisies']))
                {
            ?>  <span>Une erreur est survenue lors de la saisie du pseudo, du nom ou du prénom</span>
            <?php
                unset($_SESSION['erreurSaisies']);
                }
            ?>
            <form id="formConnetion" method="post" action="../../Controleur/inscription.php" onsubmit="return validerForm(this)" >

              
                <input type="text"  id="Pseudo" class="id" name="pseudo" placeholder="Entrez un pseudo"/><br>
                <input type="text"  id="Nom" class="id" name="nom" placeholder="Entrez votre nom" /><br>
                <input type="text"  id="Prenom" class="id" name="prenom"  placeholder="Entrez votre prénom"/><br>
                <input type="email"  id="email" class="mail" name="mail"  placeholder="Entrez un email"/><br>
                <input  type="password" oninput="verifEtSaisieMdpTempsReel(this)" id="mdp" class="passWord" name="mdp" placeholder="Saisir un mot de passe" /><br>
                <input type="password" disabled="" oninput="verifMdpTempsReel(this)" id="mdpConf" class="passWord" name="mdpConf" placeholder="Confirmer votre mot de passe"  /><br>
                <div id="acces_autorisation">
                    <h2>Autorisations d'accès :</h2>
                    
        				<input type="checkbox" id="c1" name="deezerData" />
                        <label for="c1"><span></span>Deezer</label>
                    
                        <input type="checkbox" id="c2" name="spotifyData" />
                        <label for="c2"><span></span>Spotify</label>
                    
                    
                </div>
                <span id="erreurPseudo" ></span>
                <span id="erreurNom" ></span>
                <span id="erreurPrenom" ></span>
                <span id="erreurMail" ></span>
                <span id="erreurMdp"></span>
                <input type="submit" id="Inscription"  class="connect" name="sInscrire" value="Inscription" />
            </form>
        </div>
    
</body>
</html>


