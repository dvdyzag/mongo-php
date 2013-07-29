<?php
require 'dbconnection.php';
// require 'scp.function.php';

$action = (isset($_POST['upload']) && $_POST['upload'] === 'Upload') ? 'upload' : 'view';

switch($action) {
    case 'upload':
        
        //comprobar que el archivo se ha subido correctamente
        if($_FILES['blend']['error'] !== 0) {
            die('Error uploading file. Error code '.$_FILES['blend']['error']);
        }

        //conectar al servidor de MongoDB
        $mongo = DBConnection::instantiate();
        //obtener una instancia de MongoGridFS
        $gridFS = $mongo->database->getGridFS();
                
        $filename    = $_FILES['blend']['name'];
        $filetype    = $_FILES['blend']['type'];        
        $tmpfilepath = $_FILES['blend']['tmp_name'];
        $caption     = $_POST['caption'];
        
        // enviar el fichero al servidor blender
        // scp($tmpfilepath, '/tmp/'.$filename);
        //almacenar el archivo subido
        $id = $gridFS->storeFile($tmpfilepath, array('filename' => $filename, 
                                                     'filetype' => $filetype,
                                                     'caption' => $caption));
        
        break;
    
    default:
}
$max_file_size = 8589934592;   // expressed in bytes
?>
<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="styles.css"/>
      <title>Subir archivos</title>

      </head>

          <body>
              <div id="contentarea">
                  <div id="innercontentarea">
                      <h1>Subir Fichero Blender</h1>
                      <?php if($action === 'upload'): ?>
                      <h3>Archivo Subido. Id <?php echo $id; ?> 
                      <a href="<?php echo $_SERVER['PHP_SELF']; ?>">¿Subir otro?</a>
                      </h3>
                      <?php else: ?>
                      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" 
                        accept-charset="utf-8" enctype="multipart/form-data">
                        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
                        <h3>Escribir Título&nbsp;<input type="text" name="caption" required/><h3/>
                        <!--
							http://stackoverflow.com/questions/1561847/html-how-to-limit-file-upload-to-be-only-images
							http://stackoverflow.com/questions/181214/file-input-accept-attribute-is-it-useful
							-->
                        <p><input type="file" name="blend" required accept="image/*,video/*,.iso" /></p>
                        <p><input type="submit" value="Upload" name="upload"/></p>
                      </form>
                    <?php endif; ?>
                    <a href="list.php">Ver ficheros cargados</a>
                  </div>
              </div>
          </body>
</html>
