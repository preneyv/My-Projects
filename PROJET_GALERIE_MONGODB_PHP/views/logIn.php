<?php
if(!isset($_SESSION))
{
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Valere & Joaquim">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Projet Galerie : Connexion</title>

        <link type="text/css" rel="stylesheet" href="style/home.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    </head>
    <body>
        <div id="app">
            <div class="connect">
                <div class="mainFormEnter">

                    <div class="signIn">
                        <div class="formIn">
                            <div class="subscribeHeader">
                                <div class="registerOne"><h3>Come In</h3><h6>Glad to see you again !</h6></div>
                                <div><i class="fas fa-arrow-right fa-3x"></i></div>
                            </div>
                            <form action="../controllers/controller.php?ctrl=user&fc=login" method="post" >
                                <div class="itemInput">
                                    <input type="email" placeholder="Ton email" id="emailInputLogUp" name="emailInputLogUp" />
                                </div>
                                <div class="itemInput">
                                    <input type="password" placeholder="Mot de passe" id="passInputLogUp" name="passInputLogUp" />
                                </div>
                                <div class="itemInput">
                                    <input type="submit"  id="submitInputLogUp" name="submitInputLogUp" value="Se connecter" />
                                </div>
                            </form> 
                        </div>
                        <?php
                            //si l'utilisateur n'existe pas et que la connexion s'est bien passée
                            if(isset($_SESSION['userStateLogIn'])){echo "<h5 style='color:{$_SESSION['userStateLogIn']['couleur']};float : left'>{$_SESSION['userStateLogIn']['res']}</h5>";}  
                            unset($_SESSION['userStateLogIn']);         
                        ?>
                    </div>
                    <div style="color: white;">
                        Vous n'avez pas de compte ? <a href="./logUp.php" style="text-decoration: underline; color: white;">Créez en un !</a>
                    </div>

                </div>
            </div>
        </div>
    </body>
</html>