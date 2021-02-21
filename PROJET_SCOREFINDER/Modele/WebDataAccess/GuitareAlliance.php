<?php
require_once(realpath(dirname(__FILE__)) . '/../WebDataAccess/SiteParser.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package WebDataAccess
 */
class GuitareAlliance implements SiteParser {

	/**
	 * @access public
	 */
	public function __construct() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function AnalysePage($infosTrack) {
		$tabRetour=array(
							"Piano" => array(),
							"Guitare" =>array(),
							"Basse" => array(),

							);
		$urlPDF="none";
		$urlToGo;
		
		$html = file_get_html('http://guitaralliance.com/guitar-tab/');
		foreach ($html->find('div[class=entry] ul') as $ul) {
			
			foreach ($ul->find('li') as $li){
				
				
				$eltA=$li->find('a',-1);
				$value = strtoupper($eltA->plaintext);
				if(strpos($value, $infosTrack[0])!==false && strpos($value,$infosTrack[1])!==false)
				{	
					if(isset($eltA->href))
					{
						$urlToGo = $eltA->href;

					}
				}


			}
		}

		if(isset($urlToGo))
		{
			$htmlUrlToGo = file_get_html($urlToGo);
			foreach ($htmlUrlToGo->find('div[class=entry-inner] p') as $p){
				$elt = $p->find('a',-1);
				
				if(isset($elt))
				{	
					
					if(preg_match("#.pdf$#",$elt->href))
					{
						
						$urlPDF = "http://guitaralliance.com/".$elt->href;
						$tabURL = array($urlPDF);
						$tabRetour['Guitare'] = $tabURL;

					}
					
				}
			}
		}
		

		return $tabRetour;
		
	}
}
?>