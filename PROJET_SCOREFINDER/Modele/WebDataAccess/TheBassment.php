<?php
require_once(realpath(dirname(__FILE__)) . '/../WebDataAccess/SiteParser.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package WebDataAccess
 */
class TheBassment implements SiteParser {

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
		
		$html = file_get_html('http://www.thebassment.info/transcriptions.html');
		
		foreach ($html->find('table[class=table-striped] tbody tr') as $tr) {
			
			
				$artName = strtoupper($tr->children(1));
				$trackName = strtoupper($tr->children(0));

			
				if(strpos($artName, $infosTrack[0])!==false && strpos($trackName,$infosTrack[1])!==false)
				{	
					
					$linkTD = $tr->children(6);
					$link = $linkTD->children(0)->href;
					if(isset($link))
					{
						if(preg_match("#.pdf$#",$link))
						{
							
							$urlPDF = 'http://www.thebassment.info/'.$link;
							$tabURL = array($urlPDF);
							$tabRetour['Basse'] = $tabURL;

						}

					}
				}

			
		}
		return $tabRetour;
		
	}
}
?>