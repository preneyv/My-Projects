<?php
require_once(realpath(dirname(__FILE__)) . '/../WebDataAccess/SiteParser.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package WebDataAccess
 */
class SheetDownload implements SiteParser {

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

		$simpleHTMLDom = new simple_html_dom();
		$urlPDF="none";
		$urlToGo;
		$keepSearching=true;
		$opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
		$context = stream_context_create($opts);
		
		$nomTrackReplaceEspace = str_replace(" ", "+", $infosTrack[1] );
		$html = file_get_html("http://www.sheetdownload.com/search?q=".$nomTrackReplaceEspace."&submit=Search", 0, $context);
		
		foreach ($html->find('div[class=pops] small') as $value) {
			$result = ($value->plaintext);
			
				foreach ($html->find('div[class=name]') as $divResp) 
				{
					

						if( $keepSearching==true)
						{	

							foreach ($divResp->find('a') as $link) {

								if(strpos($infosTrack[1],strtoupper($link->plaintext))!==false)
								{

									if(isset($link->href))
									{

									$urlToGo = "http://www.sheetdownload.com".$link->href;
									
									$keepSearching=false;

									}
								}
								
							}
							
						}
					
				}
			


		}

		
			
			
		
		

		if(isset($urlToGo))
		{
			$htmlUrlToGo = file_get_html($urlToGo, 0, $context);
			
			$elt = $htmlUrlToGo->find('div[class=span1] a',-1);
			
				if(isset($elt))
				{	
						
						$urlPDF = "http://www.sheetdownload.com".$elt->href;
						$verifPDF = file_get_html($urlPDF, 0, $context);
						
						$h1Erreur = $verifPDF->find('embed');

						
						if(isset($h1Erreur))
						{
							$tabURL = array($urlPDF);
							$tabRetour['Piano'] = $tabURL;
						}
						
						
					
				}
			
		}
		

		return $tabRetour;
		
	}
}
?>