 \<?php

require_once('./Query.class.php');

class Person
{
	/* Tabellename */
	public $table_name;
	
	/*Reihe als Ergebnis der Query*/
	public $row;

	/*Im Konstruktor wird der Name der Tabelle der Person festgelegt*/
	public function __construct($t_name)
	{
		$this->table_name = $t_name;
	}
	
	public function getPersonByID($id)
	{
		$sql = 'SELECT name FROM ' . $this->table_name . ' WHERE p_nr=' . $id;
		$qry = new Query();
		$ret = $qry->initialize($sql);
		
		if ($ret == 0)
		{
			$rs = $qry->getResultSet();
			$pname = mysql_fetch_row($rs);
			return $pname[0];
		}
		else
			return -1;
	}
	public function delPersByAbID($a_id)
	{
		$qry = new Query();

		$sql = 'DELETE FROM ' . $this->table_name . ' WHERE p_nr IN (SELECT Persons_p_nr FROM Persons_Abilities WHERE Abilities_a_id=' . $a_id . ')';
		$ret = $qry->initialize($sql);
		
		//Integrity Check for Person with Abilities: $a_id		
		$icheck0 = 'DELETE FROM Persons_Abilities WHERE Abilities_a_id = ' . $a_id;
		$ret = $qry->initialize($icheck0);

        $icheck1 = 'DELETE FROM Accountings WHERE Persons_p_nr IN (SELECT p_nr FROM Persons WHERE p_nr IN(SELECT Persons_p_nr FROM 							Persons_Abilities WHERE Abilities_a_id=' . $a_id . '))';
		$ret = $qry->initialize($icheck1);

	}
}

?>
