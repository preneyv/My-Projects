<?php

	require_once(realpath(dirname(__FILE__)) . '/../Modele/WebDataAccess/ConstructeurSiteParser.php');
	require_once(realpath(dirname(__FILE__)) . '/../Modele/WebDataAccess/Constructeur_GuitareAlliance_Parser.php');
	require_once(realpath(dirname(__FILE__)) . '/../Modele/WebDataAccess/Constructeur_SheetDownload_Parser.php');
	require_once(realpath(dirname(__FILE__)) . '/../Modele/WebDataAccess/Constructeur_TheBassment_Parser.php');
	require_once(realpath(dirname(__FILE__)) . '/../Modele/WebDataAccess/FabriqueSiteParser.php');
	
	
class genererPartitions
{

	private $tabRes;
	public function __construct()
	{
		$this->tabRes=array(
							"Piano" => array(),
							"Guitare" =>array(),
							"Basse" => array()
							);
	}
	

	public function remplirTableauRes($infoTrack)
	{
		$tabSites=array("GuitareAlliance", "SheetDownload", 'TheBassment');
		$ConsGuitareAlliance = new Constructeur_GuitareAlliance_Parser();
		$ConsSheetDownload = new Constructeur_SheetDownload_Parser();
		$ConsSTheBassment = new Constructeur_TheBassment_Parser();

		for( $i=0; $i<sizeof($tabSites); $i++)
		{

			$parser = FabriqueSiteParser::getInstance()->Construct($tabSites[$i]);
			$tabRetour = $parser->AnalysePage($infoTrack);

			foreach ($tabRetour as $key => $value) {
				foreach ($value as $ligneTab) {
				
					if(isset($ligneTab))
					{
						
						if(empty($this->tabRes[$key]))
						{
								$this->tabRes[$key]=$ligneTab;
						}
						
					}
					
				}
				
				
			}
		}


		return $this->tabRes;
	}
	
}
	


?>	