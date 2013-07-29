<?php

$id = $_GET['id'];
require 'dbconnection.php';

$mongo = DBConnection::instantiate();
$gridFS = $mongo->database->getGridFS();

$object = $gridFS->findOne(array('_id' => new MongoId($id)));

header('Content-type: '.$object->file['filetype']);
// decirle al navegador que esto es una descarga
// http://serverfault.com/questions/316814/
header('Content-Disposition: attachment; filename="'.$object->file['filename'] . '"');
// php.net/manual/en/function.header.php
header('Cache-Control: no-cache, must-revalidate');
// stackoverflow.com/questions/386845
// header('Cache-Control: private');
header('Content-Length: '. $object->file['length']);
echo $object->getBytes();
?>
