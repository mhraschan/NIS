<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>NIS PHP Part - ShowAbs</title>
</head>
<body>
<?php

require_once('./Person.class.php');
require_once('./Abilities.class.php');
require_once('./Offers.class.php');

if ( isset($_GET['list']) )
{
	$name = $_POST['a_name'];
	
	$o = new Offers('Offers');
	$rs = $o->getOfferByAbName($name);
	
	print("<br><b>Offers and their maximum participants for Ability with name '" . $name . "': </b>");
	print("<table border='1'>");
	print("<tr>");
	print("<th>Offer ID</th>");
	print("<th>Maximum Participants</th>");
	print("</tr>");
	$offers = mysql_fetch_row($rs);
	while ($offers[0])
	{
		print("<tr>");
		print("<td>" . $offers[0] . "</td>");
		print("<td>" . $offers[1] . "</td>");
		print("</tr>");
		$offers = mysql_fetch_row($rs);
	}
	print("</table>");

	print('<b>List the offers with their maximum participants for each Ability with at least: </b><br>
			<form action="showOffers.php?showAll" method="post">
			<input type="text" name="least" value="" />
			<b>participants</b><br>
			<input type="submit" value="Show them!" />
			</form>');
}
?>
</body>
</html>
