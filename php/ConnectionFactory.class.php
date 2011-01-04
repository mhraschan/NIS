<?php

require('./Properties.class.php');

/*Ein Objekt dieser Klasse wird erzeugt um eine Verbindung herzustellen. Die Einstellungen
dafuer werden aus der "Properties.class.php" Datei geholt*/
class Connection
{
	/*Connection für die Datenbank*/
	public $con;
	
	/* Datenbankserver - In der Regel die IP */
	public $db_server;
	/* Datenbankname */
	public $db_name;
	/* Datenbankuser */
	public $db_user;
	/* Datenbankpasswort */
	public $db_password;

	/*Konstruktor der Klasse Connection. Hier werden die Properties gelesen
	und eine Verbindung zu der in den Properties bestimmten Datenbank her-
	gestellt*/
	public function __construct()
	{
		$prop = new Properties();
		
		$this->db_server = $prop->db_server;
		$this->db_name = $prop->db_name;
		$this->db_user = $prop->db_user;
		$this->db_password = $prop->db_password;
		
		$this->con = @mysql_connect($this->db_server, $this->db_user, $this->db_password)
			or die ('Konnte keine Verbindung zur Datenbank herstellen, please call 110 ');	
		
		$db_check = @mysql_select_db($this->db_name);
	}
	
	
	/*Hier wird die vorhandene Verbindung zur Datenbank abgebaut, um Ressourcen zu wahren*/
	public function disconnect()
	{		
		/* Schliessen der Datenbank-Verbindung */
		$db_close = @mysql_close($this->con);
		
		if($db_close)
		  echo 'Verbindung zur Datenbank geschlossen';
		else
		  echo 'Konnte Verbindung zur Datenbank nicht schliessen';
	}
		
	
}
?>