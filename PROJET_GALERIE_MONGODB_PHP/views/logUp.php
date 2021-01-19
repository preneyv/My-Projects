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
        <title>Projet Galerie : Inscription</title>

        <link type="text/css" rel="stylesheet" href="style/home.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    </head>
    <body>
        <div id="app">
            <div class="connect">
                <div class="mainFormEnter">

                    <div class="signUp">
                        <div class="formUp">
                            <div class="subscribeHeader">
                                <div class="registerOne"><h3>Register</h3><h6>Join us now !</h6></div>
                                <div><i class="fas fa-pencil-alt fa-3x"></i></div>
                            </div>
                            <form  action="../controllers/controller.php?ctrl=user&fc=logup" method="post" >
                                <div class="itemInput">
                                    <input type="text" placeholder="Ton nom" id="nameInputLogUp" name="nameInputLogUp" />
                                </div>
                                <div class="itemInput">
                                    <input type="text" placeholder="Ton prénom" id="firstnameInputLogUp" name="firstnameInputLogUp" />
                                </div>
                                <div class="itemInput">
                                    <input type="email" placeholder="Ton email" id="emailInputLogUp" name="emailInputLogUp" />
                                </div>
                                <div class="itemInput">
                                    <input type="password" placeholder="Mot de passe" id="passInputLogUp" name="passInputLogUp" />
                                </div>
                                <div class="itemInput">
                                    <input type="password" placeholder="Confirmation mot de passe" id="passValidationInputLogUp" name="passValidationInputLogUp" />
                                </div>
                                <div class="itemInput">
                                    <input type="submit"  id="submitInputLogUp" name="submitInputLogUp" value="S'inscrire" />
                                </div>
                            </form>
                        </div>
                        <?php
                            //si l'utilisateur n'existe pas et que l'inscription s'est bien passée
                            if(isset($_SESSION['userStateLogUp'])){echo "<h5 style='color:{$_SESSION['userStateLogUp']['couleur']};float : left'>{$_SESSION['userStateLogUp']['res']}</h5>";}  
                            unset($_SESSION['userStateLogUp']);         
                        ?>
                    </div>
                    <div style="color: white;">
                        Vous avez déjà un compte ? <a href="./logIn.php" style="text-decoration: underline; color: white;">Connectez-vous !</a>
                    </div>

                </div>
            </div>
        </div>
    </body>
</html>