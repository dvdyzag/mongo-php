<?php
$id = $_GET['id'];
require 'dbconnection.php';

$mongo = DBConnection::instantiate();
$gridFS = $mongo->database->getGridFS();

$object = $gridFS->findOne(array('_id' => new MongoId($id)));
// www.kratedesign.com/blog/tag/gridfs
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Reproduciendo </title> 
        <link rel="stylesheet" href="styles.css"/>
    </head>
    <body>
        <div id="contentarea">
            <div id="innercontentarea">
                <h1>Reproduciendo</h1>
                <table class="table-list" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th width="40%">Caption</th>
                            <th width="45%">Filename</th>
                            <th width="*">Size</th>
                        </tr>
                    </thead>
                    <tbody>
						<tr>
							<td><?php echo $object->file['caption'];?></td>
							<td><a href="video.php?id=<?php echo $object->file['_id'];?>">
                                    <?php echo $object->file['filename']; ?>
                                </a></td>
							<td><?php echo ceil($object->file['length'] / 1024).' KB';?></td>
						</tr>
                        <tr><td><a href="upload.php">Ir a Cargar Fichero</a></td></tr>
                        <tr><td><a href="list.php">Ver ficheros cargados</a></td></tr>
                    </tbody> 
              </table>
              <video width="400" height="240" controls="controls">
				  <source src="stream.php?id=<?php echo $object->file['_id'];?>" type="<?php echo $object->file['filetype'];?>" />
				  Your browser doesn't support shit
              </video>
            </div>
        </div>
    </body>
</html>
