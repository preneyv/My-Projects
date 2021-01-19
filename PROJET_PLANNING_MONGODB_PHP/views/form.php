<?php if(!isset($_SESSION))
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
        <title>Projet Planning : Connexion</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="style/form.css">
    </head>
    <body>
        <div class="container-fluid">
        
      
            <div class="accordion" id="accordionExample">
              
                <div class="card" style="border-bottom : 1px solid rgb(0,0,0,.125)">
                  <div class="card-header" id="headingOne">
                    <h2 class="mb-0">S'inscrire</h2>
                  </div>

                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <form action="../controllers/controller.php?ctrl=user&fc=logup" method="post" id="formula" name="formula">
                            <div class="form-group row">
                              <label for="inputPseudo" class="col-sm-2 col-form-label">Pseudo</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPseudo" name="inputPseudo" placeholder="Pseudo">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputFirstName" class="col-sm-2 col-form-label">Prénom</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputFirstName" name="inputFirstName" placeholder="Prénom">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputLastName" class="col-sm-2 col-form-label">Nom</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputLastName" name="inputLastName" placeholder="Nom">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputPassword" class="col-sm-2 col-form-label">Mot de passe</label>
                              <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Mot de passe">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                              <div class="col-sm-10">
                                <input type="email" class="form-control" id="staticEmail" name="staticEmail" placeholder="email@example.com">
                              </div>
                            </div>
                             <button type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary">Valider</button>
                          </form>
                    </div>
                    <?php
                    //si l'utilisateur n'existe pas et que l'inscription s'est bien passé
                    if(isset($_SESSION['userStateLogUp'])){
                      echo "<h6 style='color:{$_SESSION['userStateLogUp']['couleur']};float : right; padding-right: 12px;'>
                        {$_SESSION['userStateLogUp']['res']}
                      </h6>";}  
                    unset($_SESSION['userStateLogUp']);         
                    ?>
                  </div>

               </div>
               <div class="card" style="border-bottom : 1px solid rgb(0,0,0,.125)">
                  <div class="card-header" id="headingOne">
                    <h2 class="mb-0">Se connecter</h2>
                  </div>
                  <div id="collapseTwo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <form action="../controllers/controller.php?ctrl=user&fc=login" method="post" id="formula" name="formula">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-3 col-form-label">Email</label>
                              <div class="col-sm-9">
                                <input type="email" class="form-control" id="staticEmail" name="staticEmail" placeholder="email@example.com">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputPassword" class="col-sm-3 col-form-label">Mot de passe</label>
                              <div class="col-sm-9">
                                <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Mot de passe">
                              </div>
                            </div>
                             <button type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary">Valider</button>
                        </form>
                    </div>
                  </div>
                  <?php
                    //si l'utilisateur n'existe pas et que l'inscription s'est bien passé
                    if(isset($_SESSION['userStateLogIn'])){
                      echo "<h6 style='color:{$_SESSION['userStateLogIn']['couleur']};float : right; padding-left: 1.25rem;'>
                        {$_SESSION['userStateLogIn']['res']}
                      </h6>";}  
                    unset($_SESSION['userStateLogIn']);         
                    ?>
               </div>
             </div>
        </div>
    </body>
</html>