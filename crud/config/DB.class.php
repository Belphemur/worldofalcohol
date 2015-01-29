<?php
// Classe Error pour gerer les exceptions!
require_once 'MySQL.class.php';

class Error  extends Exception {

	// le $debug, devrait pas être un define ? au moins être un const !
	private $debug = true; // SI activé Permet d'afficher plus de détails sur les erreurs
    public function __construct($Msg) {
        parent::__construct($Msg);
    }
 
    public function GetError() {
    	$msg  = '<div><strong>'.$this->getMessage().'</strong><br>';
    	if($this->debug) {
    		$msg .= mysql_error().'<br>';
    		$ers = error_get_last();
    		$msg .= $ers['message'].'<br>';;
    	}
        $msg .= ' Fichier : '.$this->getFile().'</div>';
        $msg .= ' Ligne : '.$this->getLine().'</div>';
        return $msg;
    }
}

// Class Database 
abstract Class DB 
{
	protected $num_query,$debug=false, $results, $num_rows, $res_query;
	private static $instance; // variable pour le Singleton
	
	// ****************** SINGLETON **********************
	public static function getInstance() {
		if ((!isset(self::$instance)) || (self::$instance==null) ) {
			//echo "l'instance n'existait pas <br>";
			self::$instance = new MySQL();
		}
		else
			;//echo "<b>l'instance existe déjà</b><br/>";
			
		return self::$instance;
	}
	//*****************************************************

	// abstract function
	abstract public function connect();
	abstract public function disconnect();
	abstract public function query($query);
	abstract public function getResults($query=null);
	abstract public function getResult($query=null); // un seul resultat au retour
	abstract public function numRows($query);
	abstract public function getDB();
	abstract public function getLastId();
	abstract public function isConnected();
	abstract public function queryGetAffRows($query);
	abstract public function optimize($tbl_name);
	abstract public function count($fields, $tbl_name, $where_statement);
	
	// permet de gérer tous les exceptions ou de les masquer
	function print_error($msg) 
	{	
		if($this->debug) 
			throw new Error($msg);
		else
			echo $msg;
	}
	
	
	function getNumQuery() 
	{
		return $this->num_query;
	}
	
	function __clone() 
	{
  		echo "Je suis un singleton, ne me clonez pas !";
	} 	
	
	function __destruct() 
	{
		// Est-ce utile le isset ? vu que self::$instance est en static ?
		if(isset(self::$instance) && !empty(self::$instance)) 
		{
			$this->disconnect() ;
			self::$instance = null;
			unset($this->dbh);
			unset($this->dbhost);
			unset($this->dbname);
			unset($this->dbuser);
			unset($this->dbpass);
			unset($this->num_query);
		}
	}
}
?>