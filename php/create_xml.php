<?php
	require('./Properties.class.php');
	include_once 'error.php';
	
	$pnr = $_GET['pnr'];
	$prop = new Properties();
	$db = new mysqli( $prop->db_server, $prop->db_user, $prop->db_password, $prop->db_name );
	
	if (mysqli_connect_errno())
	{
		errorhtml('Die Datenbank konnte nicht erreicht werden. Folgender Fehler trat auf: <strong>' .mysqli_connect_errno(). ' : ' .mysqli_connect_error(). '</strong>');
		die;
	}

	$query = "SELECT p.name, o.o_name, a.date FROM Persons p
			INNER JOIN Accountings a
			ON p.p_nr = a.Persons_p_nr
			INNER JOIN Offers o
			ON a.Offers_o_id = o.o_id
			WHERE p.p_nr = " . $pnr . ";";
	
	$result = $db->query( $query );
	
	if ($result->num_rows == 0)
	{
		errorhtml('No entries for that user.');
		die;
	}
	$xslpath = "../xsl/transform.xsl";

	$xmlcontent = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

	if($_GET['serverclient'] == 'client')
		$xmlcontent .= "<?xml-stylesheet type=\"text/xsl\" href=\"$xslpath\"?>";

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
	
	if($_GET['serverclient'] == 'client')
	{
		header('Content-Type: text/xml');
		echo $xmlcontent;
	}
	else
	{
		$xsltproc = new XsltProcessor();

		// DOM Dokument initiieren und xsl-datei laden
		$xsl = new DomDocument;
		$xsl->load($xslpath);
		$xsltproc->importStylesheet($xsl);
	
		// DOM initiieren und xml-datei laden
		$xml_doc = new DomDocument;
		$xml_doc->loadXML($xmlcontent);
	
		// Transformation
		if ($html = $xsltproc->transformToXML($xml_doc)) {
			echo $html;
		}
		else 
		{
			errorhtml( "XSL Transformation failed.");
			die;
		}
	}
	//echo "<!-- " . htmlspecialchars($xmlcontent) . ">";

	$db->close();
?>
