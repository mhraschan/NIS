<?php

require_once('./Query.class.php');


class Offers
{
	/* Tabellename */
	public $table_name;
	
	/*Reihe als Ergebnis der Query*/
	public $row;

	/*Im Konstruktor wird der Name der Tabelle der Offers festgelegt*/
	public function __construct($t_name)
	{
		$this->table_name = $t_name;
	}
	
	public function getOfferByAbName($name)
	{
		$sql = 'SELECT o.o_name, o.max_participants FROM Offers o WHERE o.o_id IN (SELECT oa.Offers_o_id FROM Offer_Abilities oa WHERE oa.Abilities_a_id=(SELECT a.a_id FROM Abilities a WHERE a.a_name="' . $name . '"))';
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
	
	public function getOffersHavingLeast($least)
	{
		$sql = 'SELECT a.a_id, a.a_name, o.o_id, o.o_name, MAX(o.max_participants) FROM Abilities a, Offer_Abilities oa, Offers o WHERE o.o_id=oa.Offers_o_id AND oa.Abilities_a_id=a.a_id GROUP BY oa.Abilities_a_id HAVING MAX(o.max_participants) > ' . $least;
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
	
	public function setMaxByAbID($a_id, $max)
	{
		$sql = 'UPDATE ' . $this->table_name . ' SET max_participants=' . $max . ' WHERE o_id IN (SELECT Offers_o_id FROM Offer_Abilities WHERE Abilities_a_id=' . $a_id . ')';
		$qry = new Query();
		$ret = $qry->initialize($sql);
	}

}

?>
