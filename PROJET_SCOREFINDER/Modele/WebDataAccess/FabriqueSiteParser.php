<?php
require_once(realpath(dirname(__FILE__)) . '/../WebDataAccess/ConstructeurSiteParser.php');
require_once(realpath(dirname(__FILE__)) . '/../WebDataAccess/FileParser.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package WebDataAccess
 */
class FabriqueSiteParser {
	/**
	 * @AttributeType WebDataAccess.FabriqueSiteParser
	 */
	private static $_instance;
	/**
	 * @AttributeType String[]
	 */
	private $_dico;
	/**
	 * @AssociationType WebDataAccess.ConstructeurSiteParser
	 * @AssociationKind Composition
	 */
	public $_unnamed_ConstructeurSiteParser_;

	/**
	 * @access public
	 * @return WebDataAccess.FabriqueSiteParser
	 * @ReturnType WebDataAccess.FabriqueSiteParser
	 */
	public static function getInstance() {
		if(is_null(self::$_instance))
		{
		  self::$_instance = new FabriqueSiteParser();
		}
		 
		return self::$_instance;
	}

	public function __construct()
	{
		
	}

	/**
	 * @access public
	 * @param String aType
	 * @return WebDataAccess.FileParser
	 * @ParamType aType String
	 * @ReturnType WebDataAccess.FileParser
	 */
	public function Construct($aType) {
		if(!array_key_exists($aType,$this->_dico))
		{
		   	throw new Exception('Type de parser spécifié inconnu !');
		}
	
		return $this->_dico[$aType]->Construct();
	}

	/**
	 * @access public
	 * @return String[]
	 * @ReturnType String[]
	 */
	public function Types() {
		return array_keys($this->dico);
	}

	/**
	 * @access public
	 * @param String aType
	 * @param WebDataAccess.ConstructeurSiteParser aC
	 * @ParamType aType String
	 * @ParamType aC WebDataAccess.ConstructeurSiteParser
	 */
	public function inscrit($aType, ConstructeurSiteParser $aC) {
		$this->_dico[$aType] = $aC;
	}
}
?>