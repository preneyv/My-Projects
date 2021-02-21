<?php 

	class bdd
	{
		private $db;

		public function __construct()
		{
			try{
					
					$this->db = new PDO('mysql:host=localhost;dbname=scorefinder', "root","");
			}
			catch(Exception $e)
			{
				die($e->mysql_errno());
			}
		}

		public function recupRequete($req)
		{
			$requete = $this->db->prepare($req);
			$requete->execute();
			return $requete->fetchAll(PDO::FETCH_OBJ);
		}

		public function getDB()
		{
			return $this->db;
		}
	}
?>