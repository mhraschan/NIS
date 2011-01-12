<?php

/*Die Klasse Properties dient nur zum Speichern der Default-Werte fuer die
Datenbank, zu der eine Verbindung aufgebaut werden soll*/
class Properties
{
	/* Datenbankserver - In der Regel die IP */
	public $db_server;
	/* Datenbankname */
	public $db_name;
	/* Datenbankuser */
	public $db_user;
	/* Datenbankpasswort */
	public $db_password;
	
	/*Im Konstruktor werden die Default-Werte der Datenbank-Verbindung fest-
	gelegt. In unserem Beispiel eine Verbindung zu einer MySQL-Datenbank*/
	public function __construct()
	{
		$this->db_server = 'localhost';
		$this->db_name = 'nis';
		$this->db_user = 'nis';
		$this->db_password = '';
	}
}

?>
