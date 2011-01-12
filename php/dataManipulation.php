<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>NIS PHP Part - Data Manipulation</title>
</head>
<body>
<?php

require_once('./Person.class.php');
require_once('./Abilities.class.php');
require_once('./Offers.class.php');

if ( isset($_GET['setMax']) )
{
	$a_id = $_POST['a_id'];
	$max = $_POST['max'];
	
	$o = new Offers('Offers');
	$o->setMaxByAbID($a_id, $max);
	
	$a = new Abilities('Abilities');
	$rs = $a->getEntities();
	
	print("<br><b>Abilities with their ID:</b>");
	print("<table border='1'>");
	print("<tr>");
	print("<th>Ability ID</th>");
	print("<th>Ability Name</th>");
	print("</tr>");
	
	$ent = mysql_fetch_row($rs);
	
	while ($ent[0])
	{
		print("<tr>");
		print("<td>" . $ent[0] . "</td>");
		print("<td>" . $ent[1] . "</td>");
		print("</tr>");
		
		$ent = mysql_fetch_row($rs);		
	}
	print("</table>");
	
	print('<b>Delete Persons with p_nr: </b><br>
			<form action="dataManipulation.php?del" method="post">
			<input type="text" name="a_id" value="" />
			<input type="submit" value="Delete!" />
			</form>');
	
}
else if ( isset($_GET['del']) )
{
	$a_id = $_POST['a_id'];
	
	$p = new Person('Persons');
	$p->delPersByID($a_id);
}
?>

</body>
</html>
