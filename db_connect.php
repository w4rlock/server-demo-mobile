<?php
/* Database config */

$db_host        = 'localhost';
$db_user        = 'sencha';
$db_pass        = 'sencha*123';
$db_database    = 'demo-mobile'; 

/* End config */

$link = mysql_connect($db_host,$db_user,$db_pass) or die('Could not connect: ' . mysql_error());
mysql_select_db($db_database,$link) or die('Could not select database');
mysql_query("SET names UTF8");

?>
