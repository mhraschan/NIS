<?php

function errorhtml( $errormessage)
{
	print('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >

<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>NIS Homepage</title>
</head>

<body>
<h1>Error</h1>
<p>
' 
. $errormessage . '
</p>
</body>
</html>');

}


?>
