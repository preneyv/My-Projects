<?php if(!isset($_SESSION))
	{
        require_once('../models/user.php');
		session_start();
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Valere & Joaquim">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Projet Galerie Mongo/PHP</title>

        <link type="text/css" rel="stylesheet" href="style/galleries.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
        <script>

            function connectMe(lien){
                    window.location.href=lien;  
            
            }
                
            function disconnect(){
                    window.location.href='../controllers/controller.php?ctrl=user&fc=disconnect';  
            }

                
            function switchClassPanel(el, wantedState)
            {
                el = document.getElementById(el);
                    el.classList=[wantedState];
            }

        </script>

    </head>
    <body>
        <div id="app">
            <div id="divAfficheImageSelected" class="unactive">
                <i onclick="switchClassPanel('divAfficheImageSelected','unactive')" class="fas fa-times fa-2x"></i>
                <div id="imageSelected"></div>
            </div>
            <div id="infoAlert" class="unactive"><h3></h3><i onclick="switchClassPanel('infoAlert','unactive')" class="fas fa-times fa-1x"></i></div>
            <div class="menu">
                    <ul>
                        <?php
                            if(isset($_SESSION['user']))
                            {
                        ?>
                                <li class="unhoverable">Bienvenue <?php echo $_SESSION['user']->getFirstname() ?></li>
                                <li onclick="disconnect()">Se déconnecter</li>
                        <?php
                            }else{
                        ?>
                                <li onclick="connectMe('./logIn.php')">Se connecter</li>
                                <li onclick="connectMe('./logUp.php')">S'inscrire</li>
                        <?php
                            }
                        ?>
                    </ul>
            </div>
            <div class="main">
                <div class="main-themesBar">

                    <div class="themesListHeader">
                        <div class="setThemesOne"><h3>Themes</h3><h6>Selectionne un theme !</h6></div>
                    </div>

                    <div class="main-themeList">
                    <?php
                        if(isset($_SESSION['user']))
                        {
                    ?>
                            <div class="addTheme unhoverable">
                                <div class="themesListHeader ">
                                    <div><h3>Ajouter un thème</h3></div>
                                    <div class="cog"><i onclick="switchClassPanel('addThemeForm','active')" class="fas fa-plus fa-1x"></i></div>
                                </div>
                                <div id="addThemeForm" class="unactive">
                                    <i class="fas fa-times fa-1x" onclick="switchClassPanel('addThemeForm','unactive')"></i>
                                    <form >
                                        <div class="itemInput">
                                            <input type="text" placeholder="Nom du thème" id="newThemeInput" name="newThemeInput" />
                                        </div>
                                        <div class="itemInput">
                                            <input type="submit"id="submitThemeInput" name="submitThemeInput" value="Ajouter" />
                                        </div>
                                    </form>
                                </div>
                            </div> 
                    <?php
                        }
                    ?>
                        <ul  class="themeList-line">
                        </ul>
                     </div>
                </div>
                <div class="centralPanel-GI">
                        <div class="panel-listGallery">
                    <?php
                        if(isset($_SESSION['user']))
                        {
                    ?>
                            <div class="addGallery">
                                <i onclick="switchClassPanel('addGalleryForm','active')" class="fas fa-plus-square fa-2x"></i>
                                <div id="addGalleryForm" class="unactive">
                                        <i class="fas fa-times fa-1x" onclick="switchClassPanel('addGalleryForm','unactive')"></i>
                                        <form >
                                            <div class="itemInput">
                                                <input type="text" placeholder="Nom de la galerie" id="newGalleryInput" name="newGalleryInput" />
                                            </div>
                                            <div class="itemInput">
                                                <input type="submit"  id="submitGalleryInput" name="submitGalleryInput" value="Ajouter" />
                                            </div>
                                        </form>
                                </div>
                            </div>    
                    <?php
                        }
                        ?>   
                            <div class="listGallery"></div>
                        </div>
                        <div class="listImageOfGallery">
                            <!-- cf. modules/imagesOfGalleryList.js -->
                        </div>
                </div>
                    <?php
    if(isset($_SESSION['user']))
        {
    ?>
            <div class="main-imageBar">
                    <div class="imagesListHeader">
                        <div class="setImagesOne">
                            <div class="imageBar-title" style="display: flex;"><i class="fas fa-images"></i><h3>Images</h3></div>
                            <h6>Voici toutes les images disponibles !</h6>
                        </div>
                    </div>
                    <div class="imagesList">
                        <ul  class="imagesList-line">

                        </ul>
                    </div>
            </div> 
    <?php       
        } 
    ?>   
            </div>
        </div>
    </body>
    <script src="./listFunctions.js"></script>
    <script type="module">
        import {loadThemeAndImages, addTheme, addGallery} from './listFunctions.js';

        window.addEventListener('load',() => {
            loadThemeAndImages();
        },false);

        if(document.getElementById('submitGalleryInput'))
        {
            document.getElementById('submitGalleryInput').addEventListener('click',() => {
                addGallery();
            },false);
        }
        
        if(document.getElementById('submitThemeInput'))
        {
            document.getElementById('submitThemeInput').addEventListener('click',() => {
                addTheme();
            },false);
        }
        


    </script>
    
</html>


