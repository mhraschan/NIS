<?php

require_once('./Query.class.php');


class Abilities
{
	/* Tabellename */
	public $table_name;
	
	/*Reihe als Ergebnis der Query*/
	public $row;

	/*Im Konstruktor wird der Name der Tabelle der Abilities festgelegt*/
	public function __construct($t_name)
	{
		$this->table_name = $t_name;
	}
	
	public function getAbsByPersID($id)
	{
		$sql = 'SELECT a.a_name FROM ' . $this->table_name . ' a WHERE a.a_id IN (SELECT pa.Abilities_a_id FROM Persons_Abilities pa WHERE pa.Persons_p_nr=(SELECT p.p_nr FROM Persons p WHERE p.name="' . $id . '"))';
		$qry = new Query();
		$ret = $qry->initialize($sql);
		
		if ($ret == 0)
		{
			$rs = $qry->getResultSet();
			return $rs;
		}
		else
			return -1;
	}
	
	public function getEntities()
	{
		$sql = 'SELECT * FROM ' . $this->table_name;
		$qry = new Query();
		$ret = $qry->initialize($sql);
		
		if ($ret == 0)
		{
			$rs = $qry->getResultSet();
			return $rs;
		}
		else
			return -1;
	}

}


?>