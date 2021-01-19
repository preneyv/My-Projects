<?php
class GallerieManager{

    private $_managerDb;
    public function __construct($db)
    {
        $this->_managerDb = $db;
    }

    /**
     * getThemeBydId()
     */
    public function getThemeBydId($id)
    {
        
        $filter=array('_id'=>$id);
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);
        $cursor =   $this->_managerDb->executeQuery("Gallerie.themes", $read);
        $theme = [];
        foreach($cursor as $th)
        {
            array_push($theme,$th); //each result of the cursor result is push to the response array
        }
        
        return $theme;
    }

    /**
     * getGalleryById()
     */
    public function getGalleryById($id)
    {
        
        $filter=array('_id'=>$id);
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);
        $cursor =   $this->_managerDb->executeQuery("Gallerie.gallery", $read);
        $galerie = [];
        foreach($cursor as $th)
        {
            array_push($galerie,$th); //each result of the cursor result is push to the response array
        }
        
        return $galerie;
    }

    /**
     * getImagesById()
     */
    public function getImagesById($id)
    {
        
        $filter=array('_id'=>$id);
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);
        $cursor =   $this->_managerDb->executeQuery("Gallerie.images", $read);
        $image = [];
        foreach($cursor as $th)
        {
            array_push($image,$th); //each result of the cursor result is push to the response array
        }
        
        return $image;
    }

    /**
     * getListThemes()
     * return the full list of theme
     */
    public function getListThemes()
    {
        $filter = [];
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);
        //Exécution de la requête
        $cursor =  $this->_managerDb->executeQuery('Gallerie.themes', $read);
        $themes = [];
        foreach($cursor as $th)
        {
            $stat = $this->getImagesPerThemes($th->title);
            array_push($themes,array('nbImage'=>$stat[0]->nbImages,'tab'=>$th)); //each result of the cursor result is push to the response array
        }
        return $themes;
    }


    /**
     * getImagesPerThemes()
     * Mongo request to get Images count of the selected theme
     * @param theme
     */
    public function getImagesPerThemes($theme)
    {
        $command = new MongoDB\Driver\Command([

            'aggregate' => 'gallery',
            'pipeline' => [
                [
                    '$match' => [
                        'theme' => $theme
                    ]
                ],
                [
                    '$group' => [
                        '_id' => 'theme',
                        'nbImages' => ['$sum' => ['$size'=>'$arrayOfImages']]
                    ]
                ],
                [
                    '$project'=>[
                        'theme'=>1,
                        'nbImages'=>1
                    ]
                ]


            ],
            'cursor' => new stdClass,
        ]);
        $cursor =  $this->_managerDb->executeCommand('Gallerie', $command);
        
        $resultat=[];
        foreach($cursor as $res)
        {
                array_push($resultat,$res);//each result of the cursor result is push to the response array
        }
        return $resultat;
        
         
           
    }

    /**
     * getListGallerie()
     * return the full list of gallerys
     */
    public function getListGallerie()
    {
        
        $filter = [];
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);
        //Exécution de la requête
        $cursor =  $this->_managerDb->executeQuery('Gallerie.gallery', $read);
        $gallery = [];
        foreach($cursor as $gl)
        {
            array_push($gallery,$gl); //each result of the cursor result is push to the response array
        }
        return $gallery;
    }

    /**
     * getListImages()
     * return the full list of Images
     */
    public function getListImages()
    {
        $filter = [];
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);
        //Exécution de la requête
        $cursor =  $this->_managerDb->executeQuery('Gallerie.images', $read);
        $images = [];
        foreach($cursor as $img)
        {
            array_push($images,$img); //each result of the cursor result is push to the response array
        }
        return $images;
    }


    /**
     * addTheme()
     * add theme in BDD with his name
     */
    public function addTheme($titleTheme)
    {
        $theme=array(
            'title' => $titleTheme,
        );
        //On insère le nouvel uilisateur
        //Test if he has been added before and return the user(we will set an error then) or null (we can add it  then)
        if($this->testExist('themes',$theme) == null)
        {
            $single_insert = new MongoDB\Driver\BulkWrite();
            $newAddId = $single_insert->insert($theme); //return the id of the new add

            // Création d'une nouvel objet de la collection "users"
            $this->_managerDb->executeBulkWrite('Gallerie.themes', $single_insert) ;
            
        }else{
            $newAddId = null;
        }
        
        
        return $newAddId; //return null of the id
    }

    /**
     * addGallerie()
     * add a galery in BDD with his belongs name and the associated theme
     */
    public function addGallerie($title, $theme)
    {
        
        $gallery=array(
            'title' => $title,
            'theme'=> $theme,
            'created_at' => Date('m.d.y'),
            'modified_at' =>"",
            'arrayOfImages' => array()
        );
        $tabFilter=array(
            '$and' =>array(
                    ['title' => $title],
                      ['theme' => $theme])
        );
        
        //On insère le nouvel uilisateur
        if($this->testExist('gallery',$tabFilter) == null)
        {
            $single_insert = new MongoDB\Driver\BulkWrite();
            $newAddId = $single_insert->insert($gallery);//return the id of the new add
            $this->_managerDb->executeBulkWrite('Gallerie.gallery', $single_insert) ;
            
        }else{
            $newAddId = null;
        }
        
        return $newAddId;//return null or the id

    }

    /**
     * addImageToGallery()
     * add an image to a galery in BDD
     */
    public function addImageToGallery($image,$gallerie)
    {
        
        $gallerie=new MongoDB\BSON\ObjectId($gallerie);
        $filter=['_id'=>$gallerie];
        $maj = [
            '$set'=>['modified_at'=>Date('m.d.y')],
            '$push'=>['arrayOfImages'=>$image]
        ];
        $updates = new MongoDB\Driver\BulkWrite();
        $updates->update($filter,$maj);
        $result = $this->_managerDb->executeBulkWrite("Gallerie.gallery", $updates) ;
        return $result; //return null or the id

    }

    /**
     * testExist()
     * test if the item already exists
     */
    public function testExist($collection, $tabFilter)
    {
        
            $option = [];
            $read = new MongoDB\Driver\Query($tabFilter, $option);
            //Exécution de la requête
            $cursor = $this->_managerDb->executeQuery("Gallerie.{$collection}", $read);

            //On vérifie si le resultat de la requete existe
            foreach($cursor as $collect)
            {
                $itemExist = $collect ? $collect : null; //set to the item value if exists, null insted
            }
            return $itemExist;
    }
}