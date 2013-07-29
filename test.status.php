<?php
/*require 'dbconnection.php';
$mongo = DBConnection::instantiate();
$db = $mongo->database;
$dbs= $db->execute('"jesus"');
//$dbs= $db->execute('sh.status()');
foreach($dbs as $db){
	echo "$db\n";
}
print_r($dbs);*/



/*$showdbs = $db->command('show dbs');
foreach($showdbs as $showdb){
	echo "$showdb\n";
}*/
echo shell_exec('mongo --eval "sh.status()"');
/*error_reporting(E_ALL);
$handle = popen('mongo --eval "sh.status()"', 'r');
echo "'$handle'; ". gettype($handle). "<br>done";
$read = fread($handle, 2096);
echo $read;
pclose($handle);*/
?>
