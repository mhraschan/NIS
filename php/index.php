<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>NIS PHP Part</title>
</head>
<body>
<?php

require_once('./Person.class.php');
require_once('./Abilities.class.php');

if ( isset($_GET['list']) )
{
	$id = $_POST['pers_id'];
	//print("Name und Abilities zu folgender Pers_ID: " . $id);
	
	$p = new Person("Persons");
	$name = $p->getPersonByID($id);
	print("<b>Hello, $name</b>");
	
	$a = new Abilities('Abilities');
	$rs = $a->getAbsByPersID($name);

	print("<br><b>Abilities for person $name: </b>");
	print("<ul>");
	$ability = mysql_fetch_row($rs);
	while ($ability[0])
	{
		print("<li>" . $ability[0] . "</li>");
		$ability = mysql_fetch_row($rs);
	}
	print("</ul>");
	
	print("<b>Show all Offers with Ability name: </b><br>");
	print('<form action="showAbs.php?list" method="post">
			<input type="text" name="a_name" value="" />
			<input type="submit" value="Show Offers" />
			</form>');
}
else
{
	print("<b>Pers_ID to show Info for: </b><br>");
	print('<form action="index.php?list" method="post">
			<input type="text" name="pers_id" value="" />
			<input type="submit" value="List Name and Abilities" />
			</form>');
}


?>




</body>
</html>
