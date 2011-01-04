<?php

require_once('./ConnectionFactory.class.php');


/*Ein Objekt der Klasse Query setzt eine uebergebene Sql-Query ab und speichert
das Ergebnis in einem ResultSet*/
class Query
{
	/*globales ResultSet*/
	private $resultSet;
	
	/*instanziert ein Objekt der Klasse Connect*/
	private $con;
	
	/*name der Datenbank, wird aus properties class gelesen*/
	private $db_name;

	/*Im Konstruktor wird eine Verbindung zu der Datenbank hergestellt*/
	public function __construct()
	{
		$this->con = new Connection();
	}
	
	
	/*Beim initialisieren wird die sql-query abgesetzt und das Ergebnis wird in
	row gespeichert*/
	public function initialize($sql)
	{	
		$this->db_name = $this->con->db_name;
		$db_check = mysql_select_db($this->db_name);
		
		if ($this->con)
		{
			$this->resultSet = mysql_query($sql);
			
			if ($this->resultSet == null)
				echo("resultset is null; QUERY: " . $sql);
			
			
			return 0;
		}
		else
		{
			return -1;
		}
	}
	
	/*Beim insert wird eine query abgesetzt*/
	public function insert($sql) {
		$this->db_name = $this->con->db_name;
		$db_check = @mysql_select_db($db_name);
		
		if ($this->con)
		{
			mysql_db_query($this->db_name, $sql);
			
			return 0;
		}
		else
		{
			return -1;
		}
	}
	
	/*Hier wird das ResultSet zurueckgegeben*/
	public function getResultSet()
	{
		if ($this->resultSet == null)
			$this->myAlert("resultset is null");
	
		return $this->resultSet;
	}
	
	/*Hier wird die row auf der pos $pos des ResultSets zurueckgegeben*/
	public function getResultAt($pos)
	{
		$tmp = 0;
		if ($this->resultSet)
		{
			while(($row = mysql_fetch_row($this->resultSet)) && ($tmp < $pos))
			{
				 $tmp++;
			}
			
			return $row;
		}
	}
	
}

?>