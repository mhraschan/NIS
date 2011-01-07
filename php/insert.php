<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >

<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Insert Data</title>
</head>

<body>
<?php
require('./Properties.class.php');
if(empty($_GET)) { ?>
<h1>New Person</h1>
<form action="" method="get">
	<label for="person_name">New person's name</label>
	<input type="text" name="name" id="person_name"/>
	<input type="submit" name="new_person" value="Create" />
</form>

<h1>New Ability</h1>
<form action="" method="get">
	<label for="abil_name">New ability's name</label>
	<input type="text" name="name" id="abil_name"/>
	<input type="submit" name="new_abil" value="Create" />
</form>

<h1>Link Person and Ability</h1>
<table style="width: 50%">
<tr><td>
<div style="float: left;">
<p>Existing persons:</p>
<table border="1">
<tr><th>p_nr</th><th>name</th></tr>
<?php
$rows = doquery("select p_nr, name from Persons;");
foreach($rows as $row) {
	echo "<tr><td>". $row['p_nr'] ."</td><td>". $row['name'] ."</td></tr>";
}
?>
</table>
</div>
</td><td>
<div  style="float: right;">
<p>Existing abilities:</p>
<table border="1">
<tr><th>a_id</th><th>a_name</th></tr>
<?php
$rows = doquery("select a_id, a_name from Abilities;");
foreach($rows as $row) {
	echo "<tr><td>". $row['a_id'] ."</td><td>". $row['a_name'] ."</td></tr>";
}
?>
</table>
</div>
</td></tr>
</table>

<form action="" method="get">
	<div>
	<label for="pnr">person number</label>
	<input type="text" name="pnr" id="pnr" />
	</div>
	<div>
	<label for="anr">ability number</label>
	<input type="text" name="anr" id="anr" />
	</div>
	<div>
	<input type="submit" name="link_pers_abil" value="Create" />
	</div>
</form>
<?php } ?>

<?php
if(isset($_GET['new_person'])) {
	$name = $_GET['name'];
	if($name == '') {
		echo "<p>Not creating person with name ''</p>" ;
	} else {
		$rows = doquery("insert into Persons (name) values ('". $name ."');");
		echo "<p>Created person with name $name.</p>" ;
	}
}
?>

<?php
if(isset($_GET['new_abil'])) {
	$name = $_GET['name'];
	if($name == '') {
		echo "<p>Not creating ability with name ''</p>" ;
	} else {
		$rows = doquery("insert into Abilities (a_name) values ('". $name ."');");
		echo "<p>Created ability with name $name.</p>" ;
	}
}
?>

<?php
if(isset($_GET['link_pers_abil'])) {
	$pnr = $_GET['pnr'];
	$anr = $_GET['anr'];
	
	# Check referential integrity, i.e. if in both parent tables a tuple with the foreign key exists
	$prow = doquery("select name from Persons where p_nr = ". $pnr .";")->fetch();
	$arow = doquery("select a_name from Abilities where a_id = ". $anr .";")->fetch();
	if(empty($prow) || empty($arow)) {
		echo "<strong>Referential Integrity Violation! Foreign Key doesn't exist in parent table. Insertion aborted!</strong>";
	} else {
		echo "<p>Inserted mapping for Person ". $prow['name'] ." and ". $arow['a_name'] .".</p>";
		echo "<p>Referential Integrity OK.</p>";
		doquery("insert into Persons_Abilities values($pnr, $anr);");
	}
	
	
}
?>

<?php if(!empty($_GET)) { ?>
<p><a href="insert.php">Back to form</a></p>
<?php } ?>

<?php

function doquery($sql) {
	$prop = new Properties();
	try {
		$conn = new PDO('mysql:host='. $prop->db_server .';dbname='. $prop->db_name, $prop->db_user, $prop->db_password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo "<p>Connection failed: " . $e->getMessage() .'</p>';
	}
	
	try {
		$rows = $conn->query($sql);
	} catch(PDOException $e) {
		echo "<p>Query failed: " . $e->getMessage() .'</p>';
		echo "<p>SQL:  $sql </p>";
	}
	return $rows;
}
?>
</body>
</html>
