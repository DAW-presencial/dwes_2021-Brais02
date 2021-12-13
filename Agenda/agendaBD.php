<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Agenda en BD</title>
        <link rel="shortut icon" type="image/png" href="https://cdn.pixabay.com/photo/2013/07/12/12/45/organizer-146189_1280.png" sizes="32x32">
        <style>
            li {
                font-size: 20px;
            }
        </style>
    </head>

    <body>
        <?php
        // Los datos que se introduciran en la conexión.
        $host = 'g1.ifc33b.cifpfbmoll.eu';
        $db = 'bvirlan_db';
        $user = 'bvirlan_usr';
        $pass = 'abc123.';
        $puerto = '5432';

        /**
         * Conexión con la base de datos.
         * 
         * En caso de que al probar introduciendo los datos para crear la conexión no funcione,
         * va a enviar un mensaje con el error que indica la Base de datos.         
         */
        try {
            $pdo = new PDO("pgsql:host=$host;port=$puerto; dbname=$db", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo "Ocurrio un error en la BD:" . $e->getMessage();
        }

        /**
         * La comprobación de lo que se introduce en el formulario y que parte del CRUD realizara.
         */
        if (isset($_GET['submit'])) {

            $telefono = $_GET['telefono'];
            $nombre = trim($_GET['nombre']);

            if ($telefono != "" && $nombre != "") {
                $stmt = $pdo->query('select * from datos');
                $datos = $stmt->fetchAll(PDO::FETCH_OBJ);

                foreach ($datos as $dato) {
                    if ($nombre == $dato->nombre) {
                        $sentencia = $pdo->prepare("UPDATE datos SET telefono = ? WHERE nombre = ?;");
                        $resultado = $sentencia->execute([$telefono, $nombre]);
                        if ($resultado === true) {
                            header("Location: agendaBD.php");
                            echo "Los datos de " . $dato->nombre . "se han actualizado de forma correcta";
                        } else {
                            echo "Algo salió mal, comprueba los datos introducidos.";
                        }
                    }
                }

                $sentencia = $pdo->prepare("INSERT INTO datos(telefono, nombre) VALUES (?, ?);");
                $resultado = $sentencia->execute([$telefono, $nombre]);
                if ($resultado == true) {
                    echo "Los datos se han introducido de forma correcta";
                } else {
                    echo "Se ha producido un fallo, comprueba los datos introducidos";
                }

            } else {
                if ($nombre == "") {
                    echo "<b>Tienes que añadir algo en el nombre.</b>";
                } else {
                    $sentencia = $pdo->prepare("DELETE FROM datos WHERE nombre = ?;");
                    $resultado = $sentencia->execute([$nombre]);
                    if ($resultado === true) {
                        echo"<p>Se ha eliminado de la agenda a: <b> $nombre </b>.</p>";
                    } else {
                        echo "Se ha producido un fallo, comprueba los datos introducidos";
                    }
                }
            }
        }

        /**
         * Crea la lista con los datos que tiene la base de datos.
         * 
         * Para cada dato que se encuentra en la base de datos se introducira en la pagina a traves de una lista desorganizada.
         */
        function Crear_Lista() {
            global $pdo;
            echo "<ul>";
            $stmt = $pdo->query('select * from datos');
            $datos = $stmt->fetchAll(PDO::FETCH_OBJ);

            foreach ($datos as $nom_tel) {
                echo "<li>" . $nom_tel->nombre . ":" . $nom_tel->telefono . "</li>";
            }

            echo '</ul>';
        }
        ?>

        <form>
            <label for="nombre">Introduce el nombre de la persona:</label>
            <input id="nombre" type="text" name="nombre" value="" /><br>
            <label for="numero">Introduce el telefono de la persona:</label>
            <input id="numero" type="number" name="telefono" value="" /><br>
            <input type="submit" name="submit" value="Enviar"/>
        </form>
        <h1>Agenda</h1>
        <?php
        Crear_Lista();
        ?>
    </body>
</html>
