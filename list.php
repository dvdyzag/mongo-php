<?php
require 'dbconnection.php';

$mongo = DBConnection::instantiate();

$gridFS = $mongo->database->getGridFS();

$objects = $gridFS->find();

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Uploaded Images</title> 
        <link rel="stylesheet" href="styles.css"/>
    </head>
    <body>
        <div id="contentarea">
            <div id="innercontentarea">
                <h1>Uploaded Images</h1>
                <table class="table-list" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th width="40%">Caption</th>
                            <th width="45%">Filename</th>
                            <th width="*">Size</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($object = $objects->getNext()): ?>
                        <tr>
                            <td><?php echo $object->file['caption']; ?></td>
                            <td>
                                <a href="video.php?id=<?php echo $object->file['_id'];?>">
                                    <?php echo $object->file['filename']; ?>
                                </a> (<a href="reproducir.php?id=<?php echo $object->file['_id'];?>">reproducir</a>)
                            </td>
                            <td ><?php echo ceil($object->file['length'] / 1024).' KB'; ?></td>
                        </tr>
                        <?php endwhile;?>
                        <tr><td><a href="upload.php">Ir a Cargar Fichero</a></td></tr>
                    </tbody> 
              </table>
            </div>
        </div>
    </body>
</html>
