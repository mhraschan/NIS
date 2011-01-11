<?php

require_once('./Query.class.php');


/*In der Klasse Produkt werden die Produkte mittels Artikel Nummer oder Bezeichnung
ermittelt, und in einem ResultSet gespeichert*/
class Product
{
	/**Beinhaltet den Namen der Produkt-Tabelle*/
	private $table_name = 'Produkt';
	
	/*ResultSet als Ergebnis der Query*/
	private $resultSet;
	
	/* Enthaelt die Ergebnisreihe einer query */
	private $row;


	/*Ist fuer die Fehlerausgabe zustaendig. Es wird eine MessageBox angezeigt*/
	function myAlert($text){
		echo '<script type="text/javascript"> alert("'.$text.'")</script>';
	}
	
	
	/*Konstruktor - in diesem Fall leer*/
	public function __construct() {
		
	}
	
	
	/*Hier wir ein Produkt mittels seiner Bezeichnung ermittelt*/
	public function getProductByBez($bez)
	{
		$success = -1;
		
		$sql = 'SELECT art_nr FROM ' . $this->table_name . ' WHERE art_bez=\'' .  $bez . '\'';
		
		$qry   = new query();
		$success = $qry->initialize($sql);
		
		if ($success == 0) //wenn query absetzen erfolgreich, dann...
		{
			$this->resultSet = $qry->getResultSet();		
			return 0;
		}
		else 
		{
			return -1;
		}
		
	}
	
	/*Hier wird ein Produkt mittels seiner Artikel Nummer ermittelt. Es kann
	also hoechstens ein Produkt ermittelt werden, da die ArtNr primary Key ist*/
	public function getProductByArtNr($ArtNr) 
	{		
		$success = -1;
		
		$sql = 'SELECT * FROM ' . $this->table_name . ' WHERE art_nr=\'' .  $ArtNr . '\'';
		
		$qry   = new query();
		$success = $qry->initialize($sql);
		
		if ($success == 0) //wenn query absetzen erfolgreich, dann...
		{
			$this->resultSet = $qry->getResultSet();		
			return 0;
		}
		else 
		{
			return -1;
			$this->myAlert("fufi");
		}
		
	}
	
	
	
	/*Sucht alle Produkte, in denen $bez als Teil der Artikel Bezeichnung vorkommt*/ 
     public function getProductByBezTeil($bez) 
     { 
          $success = -1; 
           
          $sql = 'SELECT * FROM ' . $this->table_name . ' WHERE art_bez like \'%' .  $bez . '%\' ORDER BY art_bez'; 
           
          $qry   = new query(); 
          $success = $qry->initialize($sql); 
           
          if ($success == 0) //wenn query absetzen erfolgreich, dann... 
          { 
               $this->resultSet = $qry->getResultSet();           
               return 0; 
          } 
          else  
          { 
               return -1; 
          } 
           
     }
	
     /*liefert die naechste Reihe eines ResultSets zurueck*/
	public function getNextValue()
	{
		$this->row = mysql_fetch_row($this->resultSet);		
		
		return $this->row;
	}
	
	
	/*Liefert die Artikel Nummer einer row zurueck*/
	public function getArtNr() {
		return $this->row[0];
	}
	
	/*Liefert die Bezeichnung einer row zurueck*/
	public function getBezeichnug() {
		return $this->row[1];
	}
		
	/* wenn short auf "true" gesetzt ist, dann werden nur die ersten 150 zeichen zurückgeliefert (für die Artikelübersicht)
	 * sonst wird die komplette Info zurückgeliefert 
	 */
	public function getInfo($short) {
		
		$bezeichnung_tmp = $this->row[2];
		$len = strlen($bezeichnung_tmp);
		
		if ($short == true)
		{
			if ($len > 150) {
				$bezeichnung_tmp = str_split($bezeichnung_tmp, 150);
				return $bezeichnung_tmp[0] . '...';
			}
			else 
				return $this->row[2];
		}
		else 
			return $this->row[2];
	}
	
	/*Liefert den Link einer row zurueck*/
	public function getLink() {
		return $this->row[3];
	}
	
	/*Liefert die Lieferzeit einer row zurueck*/
	public function getLieferzeit() {
		return $this->row[4];
	}
	
	/*Liefert den Einkaufspreis einer row zurueck*/
	public function getEKPreis() {
		$erg = bcadd($this->row[5], 0, 2);
		return $erg;
	}
	
	/*Liefert den Haendlerpreis einer row zurueck*/
	public function getHaendlerPreis() {
		$erg = bcadd($this->row[6], 0, 2);
		return $erg;
	}
	
	/*Liefert den Privatpreis einer row zurueck*/
	public function getPrivPreis() {
		$erg = bcadd($this->row[7], 0, 2);
		return $erg;
	}
	
}

?>