<?php
class userManager{

    private $_managerDb;

    public function __construct($db)
    {
        require_once('user.php');
        $this->_managerDb = $db;
    }

    /**
     * getUserById()
     * return the user by his ID
     */
    public function getUserById($id){

        $filter = ['id' => $id];
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);
        //Exécution de la requête
        $cursor =  $this->_managerDb->executeQuery('Gallerie.users', $read);
        foreach($cursor as $user)
        {
                return $user;
        }
    }

    /**
     * getUserByPassAndEmail()
     * Return user by his password and email
     */
    public function getUserByPassAndEmail($tabFilter){

        return $user = $this->testExistUser($tabFilter);//Test if he exists  and return the user or null then
    }

    /**
     * addUser()
     * add user to the DB
     */
    public function addUser($tabUser)
    {
        $userTabFilter=['email' =>$tabUser['email']];
        //On insère le nouvel uilisateur
        if($this->testExistUser($userTabFilter) == null)//Test if he has been added before and return the user(we will set an error then) or null (we can add it  then)
        {
            $single_insert = new MongoDB\Driver\BulkWrite();
            $newAddId = $single_insert->insert($tabUser);//return the id of the new add
            // Création d'une nouvel objet de la collection "users"
            $this->_managerDb->executeBulkWrite('Gallerie.users', $single_insert) ;
            
        }else{
            $newAddId = null;
        }
        
        return $newAddId;//return null of the id
    }

    /**
     * createUser()
     * create the user as a PHP object
     */
    public function createUser($userTab){

        $user = new User($userTab['id']);
        $user->hydrate($userTab);
        return $user;
    }

    /**
     * testExistUser()
     * test if the user already exists
     */
    public function testExistUser($tabFilter)
    {
        
            $option = [];
            $read = new MongoDB\Driver\Query($tabFilter, $option);
            //Exécution de la requête
            $cursor =   $this->_managerDb->executeQuery('Gallerie.users', $read);
            //On vérifie si le resultat de la requete existe
            foreach($cursor as $user)
            {
                $userExist = $user ? $user : null;//set to the user value if exists, null insted
            }
            return $userExist;
    }

}
?>
