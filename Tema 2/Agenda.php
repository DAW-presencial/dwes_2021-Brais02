<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Agenda en PHP</title>
        <link rel="shortut icon" type="image/png" href="https://cdn.pixabay.com/photo/2013/07/12/12/45/organizer-146189_1280.png" sizes="32x32">
    </head>
    <body>
        <?php
        /**
         * @author Brais Virlan <bvirlan@cifpfbmoll.eu>
         * @version 1.0
         * @var array $agenda Donde se guardan los datos que formaran la agenda.
         */
        if (isset($_GET['agenda'])) {
            $agenda = $_GET['agenda'];
        } else {
            $agenda = [];
        }

        //Si se ha enviado la peticion
        if (isset($_GET['submit'])) {
            //Quita los espacios de los lados y comprueba que lo enviado no sea igual a nada
            if (trim($_GET['nombre']) != "" && $_GET['telefono'] != "") {
                $agenda[$_GET['nombre']] = $_GET['telefono']; //Define que el indice de la array sea el nombre y su valor el telefono
            } else {
                if ($_GET['nombre'] == "") {
                    echo "Tienes que añadir algo en el nombre"; //Si es igual a nada muestra un aviso
                } elseif (isset($agenda[$_GET['nombre']]) == false) {
                    echo"El nombre introducido no se encuentra en la agenda, por lo tanto no puede ser eliminado";
                } else {
                    echo"Se ha eliminado de la agenda a " . $_GET['nombre'];
                    unset($agenda[$_GET['nombre']]); //Si es igual a nada muestra un aviso
                }
            }
        }

        /**
         * Crea 
         */
        function CrearInput() {
            global $agenda;
            foreach ($agenda as $nombre => $telefono) {
                echo'<input type="hidden" name="agenda[' . $nombre . ']" value="' . $telefono . '">';
            }
        }

        /**
         * Crea la lista con los datos de $agenda.
         * 
         * Para cada dato de $agenda con la clave $nombre y el valor $telefono se añadira un nuevo elemento lista con estos valores.
         * 
         * @global array $agenda
         * 
         */
        function CrearLista() {
            global $agenda;
            echo "<ul>";
            foreach ($agenda as $nombre => $telefono) {
                echo "<li class='parta'>$nombre:$telefono</li>";
            }
            echo '</ul>';
        }
        ?>
        <form>
            <input type="text" name="nombre" value="" />
            <input type="number" name="telefono" value="" />
            <?php
            CrearInput();
            ?>
            <input type="submit" name="submit" value="Enviar"/>
        </form>
        <h1>Agenda</h1>
        <?php
        CrearLista();
        ?>
    </body>
</html>