<?php
	include_once 'dbconfig.php';
	
	$pnr = $_GET['pnr'];
	
	$db = new mysqli( $server, $user, $password, $dbname );
	
	if (mysqli_connect_errno() == 0)
	{
		$query = "SELECT p.name, o.o_name, a.date FROM Persons p
				INNER JOIN Accountings a
				ON p.p_nr = a.Persons_p_nr
				INNER JOIN Offers o
				ON a.Offers_o_id = o.o_id
				WHERE p.p_nr = " . $pnr . ";";
		
		$result = $db->query( $query );
		
		if ($result->num_rows == 0)
			echo 'Keine Einträge für den User';
		else
		{
			$xmlcontent = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
			$xmlcontent .= "<!-- all offers for specified person-->\n";
			
			$row = $result->fetch_object();
			
			$xmlcontent .= "<person_accountings>\n";
			$xmlcontent .= "<person>\n<name>" . $row->name . "</name>\n</person>\n";
			
			$xmlcontent .= "<accountings>\n";
			do {
				$xmlcontent .= "<accounting>\n";
		    	$xmlcontent .= "<offer>" . $row->o_name . "</offer>\n";
		    	$xmlcontent .= "<date>" . $row->date . "</date>\n";
		    	$xmlcontent .= "</accounting>\n";
			} while($row = $result->fetch_object());
			$xmlcontent .= "</accountings>\n";
			
			$xmlcontent .= "</person_accountings>\n";
			
			$randval = rand();
			$xmlfilename = "tmp" . $randval . ".xml";
			$xslpath = "../xsl/transform.xsl";
			
			$file = fopen($xmlfilename, "w");
			fwrite($file, $xmlcontent);
			fclose($file);
			
			$xsltproc = new XsltProcessor();

			// DOM Dokument initiieren und xsl-datei laden
			$xsl = new DomDocument;
			$xsl->load($xslpath);
			$xsltproc->importStylesheet($xsl);
			
			// DOM initiieren und xml-datei laden
			$xml_doc = new DomDocument;
			$xml_doc->load($xmlfilename);
			
			// Transformation
			if ($html = $xsltproc->transformToXML($xml_doc))
			   echo $html;
			else 
				echo "XSL Transformation failed.";
			
			unlink($xmlfilename);
		}
	}
	else
	{
	    // Es konnte keine Datenbankverbindung aufgebaut werden
	    echo 'Die Datenbank konnte nicht erreicht werden. Folgender Fehler trat auf: <strong>' .mysqli_connect_errno(). ' : ' .mysqli_connect_error(). '</strong>';
	}
	
	$db->close();
?>