<?php
require_once "config/DB.class.php";

if(isset($_GET['table_name']))
{
	$table_name = $_GET['table_name'];
	
	$sql = DB::getInstance();
	$sql->query("SET NAMES 'utf8'");
	
	$query = "SELECT COLUMN_NAME FROM `INFORMATION_SCHEMA`.`COLUMNS` 
				WHERE `TABLE_SCHEMA`='".$sql->getDB()."' 
				AND `TABLE_NAME`='".$table_name."';";
				
	$req = $sql->query($query);
	$data = $sql->getResults();
	
	foreach($data as $col) {
		echo "<option value='".$col['COLUMN_NAME']."'>".$col['COLUMN_NAME']."</option>";
	}
}	
?>
