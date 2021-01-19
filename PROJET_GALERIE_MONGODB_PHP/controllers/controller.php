<?php

    if(!isset($_SESSION))
	{
		session_start();
    }//start session if is not.

    require_once('../models/connexion.php');
    $dbInstance = new Connexion();
    $dbInstance->doConnect();
    $collection = $dbInstance->getManagerDB();//Do a connection to the DB

    $fc= (isset($_GET['fc']) && !empty($_GET['fc'])) ? $_GET['fc'] : '';//Fonction to execute
    $src = (isset($_GET['ctrl']) && !empty($_GET['ctrl'])) ? $_GET['ctrl'] : '';//Which controllers the link will leads on
    $theme = (isset($_GET['theme']) && !empty($_GET['theme'])) ? $_GET['theme'] : '';
    $gallery = (isset($_GET['gallery']) && !empty($_GET['gallery'])) ? $_GET['gallery'] : '';
    $image = (isset($_GET['image']) && !empty($_GET['image'])) ? $_GET['image'] : '';



    $map = array(
           'user' => array(
                            'login'=>array('method'=>'doLogin','args'=>""),
                            'logup'=>array('method'=>'doLogup','args'=>""),
                            'disconnect'=>array('method'=>'disconnect','args'=>"")
           ),
           'gallerie' => array(
                            'start' => array('method'=>'startGallerie','args'=>""),
                            'addTheme' => array('method' => 'addTheme', 'args'=>array($theme)),
                            'addGallery' => array('method' => 'addGallery', 'args'=>array($gallery,$theme)),
                            'addImageToGallery' => array('method' => 'addImageToGalerie', 'args'=>array($image,$gallery)),

           )

    );//This array is like a map matching with the right controllers and the right method then.
    

    
   if(!empty($fc) || !empty($ctrl))
   {
        require_once('./'.$src.'Controller.php');//Call thecontrollersrs that will be needed
        $curControler = $src.'Controller';
        $curControler = new $curControler($collection);//Create new controllers
        
        $method = $map[$src][$fc]['method'];//assembling the method
        $curControler->$method($map[$src][$fc]['args']);//executes the method
   }
    


?>