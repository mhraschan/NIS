<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>NIS PHP Part - ShowOffers (with group by and having)</title>
</head>
<body>
<?php

require_once('./Person.class.php');
require_once('./Abilities.class.php');
require_once('./Offers.class.php');

if ( isset($_GET['showAll']) )
{
	$least = $_POST['least'];
	
	$o = new Offers('Offers');
	$rs = $o->getOffersHavingLeast($least);
	
	print("<br><b>Offers for each Ability with highest max_participants having at least: " . $least . " max_participants: </b>");
	print("<table border='1'>");
	print("<tr>");
	print("<th>Ability ID</th>");
	print("<th>Ability Name</th>");
	print("<th>Offer ID</th>");
	print("<th>Offer Name</th>");
	print("<th>Max_Participants</th>");
	print("</tr>");
	
	$offers = mysql_fetch_row($rs);
	
	while ($offers[0])
	{
		print("<tr>");
		print("<td>" . $offers[0] . "</td>");
		print("<td>" . $offers[1] . "</td>");
		print("<td>" . $offers[2] . "</td>");
		print("<td>" . $offers[3] . "</td>");
		print("<td>" . $offers[4] . "</td>");
		print("</tr>");
		
		$offers = mysql_fetch_row($rs);		
	}
	print("</table>");
}
?>
<b>Set maximum participants of all Offers with Ability ID: </b><br>
<form action="dataManipulation.php?setMax" method="post">
<input type="text" name="a_id" value="" />
<b>to new maximum: </b>
<input type="text" name="max" value="" />
<input type="submit" value="Update!" />
</form>

</body>
</html>
