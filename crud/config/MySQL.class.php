<?php

Class MySQL extends DB 
{

	protected $dbh,$dbhost,$dbuser,$dbpass,$dbname ;

	protected function __construct() 
	{ 
		$this->dbhost = 'localhost';
		$this->dbuser = 'c1_woa';
		$this->dbpass = 'ryfUtLQ!N08';
		$this->dbname = 'c1_woa';
		$this->num_query = 0;
		
		$this->connect();
		$this->selectDB($this->dbname, $this->dbh);
	}

	public function connect() 
	{
		$this->dbh = @mysql_connect($this->dbhost, $this->dbuser, $this->dbpass);
		if(!$this->dbh) 
			return $this->print_error("Impossible de se connecter à la base!");
	}
	
	public function disconnect()
	{
		if($this->dbh!=null)
		mysql_close($this->dbh); 
	}

	public function isConnected()
	{
		return ($this->dbh != null) ;
	}
	
	public function selectDB($dbname, $dbh)
	{
		// if(isConnected()) est bien nécessaire ici ?
		// Ce serait bien un Errno ^^
		if(!@mysql_select_db($dbname,$dbh)) 
			return $this->print_error("Impossible de selectionner la base");
		return true;
	}
	
	public function setDB($dbname) 
	{
		$success = $this->selectDB($dbname, $this->dbh);
		if($success)
			$this->dbname = $dbname;
		return $success;
	}
	
	public function getDB()
	{
		return $this->dbname;
	}
	
	function query($query) 
	{
		$res_query = @mysql_query($query);
		
		// on met a zero les resultats
		$this->num_rows = 0;
		$this->results = null;
		$this->res_query = null;
		
		if(!$res_query)
		{
			$this->print_error("Impossible d'executer la requete ".mysql_error());
			return false;
		}
		// on met la ressoucre dans la var res_query
		$this->res_query = $res_query;
		
		++$this->num_query;
			
		$data = array();
		while(($row = @mysql_fetch_assoc($res_query)))
			$data[] = $row;
			
		// on sauve num_rows au cas ou :p
		$this->num_rows = @mysql_num_rows($res_query);
		
		// on sauve le resultats qu'on peut recuperer par get Results
		$this->results = $data;
		//if($this->num_rows==0)
		//	return false;
		
		@mysql_free_result($res_query);
		return true;
	}
	
	function getResults($query=null)
	{
		if($query)
			$this->query($query);
		return $this->results;
	}
	// envoie tjs une seule ligne meme si plusieurs sont possible
	// tres utile en cas des doublon ou lors qu'on veut etre sur de recevoir juste un resultat
	function getResult($query=null)
	{
		if($query)
			$this->query($query);
		if(count($this->results)!=0)
			return $this->results[0];
		return null;
	}
	
	function numRows($query) 
	{
		$this->query($query);
		if($this->res_query)
			return $this->num_rows;
	}
	
	function getLastId () 
	{
		return @mysql_insert_id();
	}
	
	function queryGetAffRows($query) 
	{
		$res = $this->query($query);
		if(!$res) return $this->print_error("Impossible d'executer la requete ");
		return @mysql_affected_rows();
	}
	
	function optimize($tbl_name) {
		if(!($this->query("OPTIMIZE table $tbl_name"))) return $this->print_error("Impossible d'optimiser la table $tbl_name");
		return true;
	}
	function count($fields, $table_name, $where_statement) {
		$this->query('SELECT COUNT('.$fields.') AS compteur FROM '.$table_name.' '.$where_statement.'');
		$data = $this->getResults();
		return $data[0]["compteur"];
	}
}

?>
