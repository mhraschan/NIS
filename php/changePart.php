<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>NIS PHP Part - changePart</title>
</head>
<body>
<?php

require_once('./Person.class.php');
require_once('./Abilities.class.php');

if ( isset($_GET['max']) )
{
	$name = $_POST['pers_name'];
	print("ausgeben: " . $name);
	
	$a = new Abilities('Abilities', 'Persons_Abilities');
	$ability = $a->getAbsByPersID($name);

print("<b>Abilities for person $name: $ability</b>");
}
?>
<form action="index.php" method="post">
<input type="hidden" name="name" value="<?php print($name); ?>" />
<input type="text" name="greeting" value="" />
<input type="submit" value="Submit" />
</form>



</body>
</html>
