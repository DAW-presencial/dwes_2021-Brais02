<html>
    <head>
        <meta charset="UTF-8">
        <title>Sin validación</title>
    </head>
    <body>
        <?php
        /**
         * Programa de envio de formulario
         * 
         * @brais
         */
        
        # Me mostrar el formulario siempre
        displayForm();
        $target_dir = __Dir__ . "\\temporal\\";

        //Si se ha enviado un formulario que haga lo siguiente
        if (isset($_POST["submit"])) {
            echo "<b>El formulario devolvio:</b><ul>";
            echo "<li>El nombre introducido es: " . $_POST['nombre'] . "</li>";
            echo "<li>El apellido introducido es: " . $_POST['apellido'] . "</li>";
            echo "<li>La fecha introducido es: " . $_POST['fecha'] . "</li>";
            
            /*Para cada valor cva*/
            foreach ($_FILES as $valor) {
                $error = $valor["error"];

                switch ($error) {
                    case 0:
                        $tmp_name = $valor["tmp_name"];
                        $name = basename($valor["name"]);
                        $tamano = $valor["size"];

                        if (move_uploaded_file($tmp_name, $target_dir . $name)) {
                            echo "<li>Se ha enviado y movido el archivo: <b>" . $name .
                            "</b> que tiene un peso de: <b>" . $tamano . " bytes!</b></li>";
                        } else {
                            echo "<li>error al mover el archivo: " . $name . "!</li>";
                        }
                        break;

                    case 1:
                        echo "<li>Error al subir el archivo: " . $name . ", por culpa del servidor!</li>";
                        break;

                    case 2:
                        echo "<li>Error al mover el archivo: " . $name . ", por culpa del formulario!</li>";
                        break;

                    case 4:
                        echo "<li>Error, no se ha subido ningun archivo!";
                        break;

                    case 6:
                        echo "<li>Error al acceder al directorio con el archivo: " . $name . "!</li>";
                        break;

                    case 7:
                        echo "<li>Error el archivo: " . $name . " np se ha podido escribir en el disco!</li>";
                        break;

                    case 8:
                        echo "<li>Error el archivo: " . $name . " no se ha subido por un fallo en PHP!</li>";
                        break;

                    default:
                        echo "<li>Algo ha salido mal </li>";
                        break;
                }
            }
            echo "</ul>";
        } /*else {
            displayForm();
        }*/

        function DisplayForm() {
            global $nombre, $apellido, $fecha;
            ?>  
            <h1>Registro de usuario</h1>
            <form method="post" enctype="multipart/form-data">
                <input type = "text" name = "nombre" 
                       placeholder="Nombre" value = "<?php echo $nombre; ?>"/>
                <input type = "text" name = "apellido" 
                       placeholder="Apellido" value = "<?= $apellido; ?>"/>
                <input type = "date" name = "fecha" 
                       placeholder="fecha de nacimiento" value = "<?= $fecha; ?>"/><br>
                <label for="archivo1">Seleccione archivo: </label>
                <input type="file" name="archivo" id="archivo1" /><br>
                <label for="archivo2">Seleccione archivo: </label>
                <input type="file" name="archivo2" id="archivo2" /><br>
                <input type = "submit" name="submit"/>
            </form>
            <?php
        }
        ?>
    </body>
</html>