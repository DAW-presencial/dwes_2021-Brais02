<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Prueba del mapa de clases</title>
    </head>
    <body>
        <?php
        /*function MiCargador($nombre) {
            require("clases/$nombre.class.php");
        }
        spl_autoload_register('MiCargador');
        $obj = new Persona;
        var_dump($obj);*/
        
        $clases = array (
            "Persona" => "clases/Persona.class.php", 
            "Coche" => "clases/coche.php", 
            "Casas" => "clases/Pisos.php");
        
        var_dump($clases);
        echo "<br>";
        
        function CargadorArray($nom) {
            global $clases;
            require "$clases[$nom]";
        }
        spl_autoload_register('CargadorArray');
        $objeto = new Persona;
        var_dump($objeto);
        echo "<br>";
        $casas = new Casas;
        var_dump($casas);
        ?>
    </body>
</html>
