<?php
class GallerieController{

    private $_gallerieManager;

    public function __construct($collect)
    {
        
        require_once('../models/gallerieManager.php');
        $this->_gallerieManager = new GallerieManager($collect);
        
    }

    /**
     * startGallerie()
     * when the user comes to the page gallery for the first time. This return a tab to json extension because data are pull by an axios request in galleries.php
     */
    public function startGallerie(){
        
        
        echo(json_encode(array('listOfTheme'=>$this->getListTheme(),'listOfGallery'=>$this->getListGallery(),'listOfImages'=>$this->getListImages())));
    }

    /**
     * getListTheme()
     * so the gallerie manager return the full list of theme
     */
    public function getListTheme()
    {
        return $this->_gallerieManager->getListThemes();
    }

    /**
     * getListGallery()
     * so the gallerie manager return the full list of gallerie
     */
    public function getListGallery()
    {
        return $this->_gallerieManager->getListGallerie();
      
    }

    /**
     * getListImages()
     * so the gallerie manager return the full list of Images
     */
    public function getListImages()
    {
        return $this->_gallerieManager->getListImages();
      
    }

    /**
     * addTheme()
     * This will ask the manager to add a theme in BDD
     */
    public function addTheme($tabArgs)
    {
        $res="";
        $panelInfo="";
        $succeed=true;

        if(!empty($tabArgs))
        {
            $res=$this->_gallerieManager->addTheme($tabArgs[0]);
            if($res != null)
            {
                $res = $this->_gallerieManager->getThemeBydId($res);
                $panelInfo = ["color"=>"#48C9B0","text"=>"Thème ajouté avec succés"];
            }else{
                $panelInfo = ["color"=>"#EC7063","text"=>"Un thème identique existe déjà"];
                $succeed=false;
            }
           
        }else{
            $panelInfo = ["color"=>"#EC7063","text"=>"Le formulaire a été mal saisie"];
            $succeed=false;
        }
        echo(json_encode(array('succeed'=>$succeed,'panelInfo'=>$panelInfo,'tabRes'=>$res)));
        
    }

    /**
     * addGallery()
     * This will ask the manager to add a gallery in BDD
     */
    public function addGallery($tabArgs)
    {
       
        $res="";
        $panelInfo="";
        $succeed=true;
        if(!empty($tabArgs[0]) && (!empty($tabArgs[1]) && $tabArgs[1] != "undefined"))
        {
           
            $res = $this->_gallerieManager->addGallerie($tabArgs[0], $tabArgs[1]);
            if( $res!= null)
            {
                $res= $this->_gallerieManager->getGalleryById($res);
                $panelInfo = ["color"=>"#48C9B0","text"=>"Galerie ajoutée avec succés"];
            }else{
                $panelInfo = ["color"=>"#EC7063","text"=>"Une galerie identique existe déjà"];
                $succeed=false;
            }
           
        }else{
            $panelInfo = ["color"=>"#EC7063","text"=>"Selectionne un thème et saisie un nom de galerie !"];
            $succeed=false;
        }

        echo(json_encode(array('succeed'=>$succeed,'panelInfo'=>$panelInfo,'tabRes'=>$res)));
       

    }

    /**
     * addImageToGalerie()
     * So the galerie manager add an image to the gallery
     */
    public function addImageToGalerie($tabArgs)
    {
    
        $res="";
        $panelInfo="";
        $succeed=true;
        if((!empty($tabArgs[0])) && (!empty($tabArgs[1]) && $tabArgs[1] != "undefined"))
        {
            
            $res = $this->_gallerieManager->addImageToGallery($tabArgs[0],$tabArgs[1]);
            if( $res!= null)
            {
                $panelInfo = ["color"=>"#48C9B0","text"=>"L'image' a été ajoutée à la galerie avec succés"];
            }else{
                $panelInfo = ["color"=>"#EC7063","text"=>"Une galerie identique existe déjà"];
                $succeed=false;
            }
           
        }else{
            $panelInfo = ["color"=>"#EC7063","text"=>"Selectionne un thème et une galerie !"];
            $succeed=false;
        }

        echo(json_encode(array('succeed'=>$succeed,'panelInfo'=>$panelInfo,'tabRes'=>$res)));

    }

}