<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Formularios y Files</title>
        <link rel="shortut icon" type="image/png" href=" https://play-lh.googleusercontent.com/58sr3IvX1wiE8ei_BICqPgywKgZ5DPpmRL_2YuZINnFlz_9D2os9PmueeZPPtZno0zk" sizes="32x32">


    </head>
    <body>
        <form method="post" enctype="multipart/form-data">
            <label for="archivo1">Seleccione archivo: </label>
            <input type="file" name="archivo" id="archivo1" /><br>
            <label for="archivo2">Seleccione archivo: </label>
            <input type="file" name="archivo2" id="archivo2" /><br>
            <label for="archivo3">Seleccione archivo: </label>
            <input type="file" name="archivo3" id="archivo3" /><br>
            <label for="archivo4">Seleccione archivo: </label>
            <input type="file" name="archivo4" id="archivo4" /><br>
            <input type="submit" name="submit"/>
        </form>
        <?php
        $target_dir = __DIR__ . "\\clases\\";
        //$target_dir = __Dir__ . "/files/";
        if (isset($_POST["submit"])) {
            foreach ($_FILES as $key => $valor) {
                /* var_dump($key);
                  var_dump($valor); */
                $error = $valor["error"];

                switch ($error) {
                    case 0:
                        $tmp_name = $valor["tmp_name"];
                        $name = basename($valor["name"]);
                        if (move_uploaded_file($tmp_name, $target_dir . $name)) {
                            echo "Se ha enviado y movido el archivo: " . $name . " !<br>";
                        } else {
                            echo "error al mover el archivo: " . $name . "!";
                        }
                        //move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_dir .$_FILES["archivo"]["name"]);
                        //rename($_FILES["archivo"]["tmp_name"], $target_dir . $_FILES["archivo"]["name"]);
                        break;
                        
                    case 1:
                        echo "Error al subir el archivo: " . $name . ", por culpa del servidor!";
                        break;
                    
                    case 2:
                        echo "Error al mover el archivo: " . $name . ", por culpa del formulario!";
                        break;
                
                    case 4:
                        echo "Error, no se ha subido ningun archivo!";
                        break;
                 
                    case 6:
                        echo "Error al acceder al directorio con el archivo: " . $name . "!";
                        break;
                    
                    case 7:
                        echo "Error el archivo: " . $name . " np se ha podido escribir en el disco!";
                        break;
                    
                    case 8:
                        echo "Error el archivo: " . $name . " no se ha subido por un fallo en PHP!";
                        break;
                    
                    default:
                        echo "Algo ha salido mal <br>";
                        break;
                }
            }
        }
        /* PARA SUBIR 1 ARCHIVO
          switch ($error) {
          case 0:
          $tmp_name = $_FILES["archivo"]["tmp_name"];
          $name = basename($_FILES["archivo"]["name"]);
          if (move_uploaded_file($tmp_name, $target_dir . $name)) {
          echo "error!";
          }
          //move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_dir .$_FILES["archivo"]["name"]);
          //rename($_FILES["archivo"]["tmp_name"], $target_dir . $_FILES["archivo"]["name"]);
          break;
          default:
          echo "Algo ha salido mal <br>";
          break;
          }
          }

          //var_dump($_FILES);
          } */
        ?>
    </body>
</html>
