<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $prueba = [34, 2, 4, 6, 3, 5, 1, 100, 50, 10, 400];

        function burbuja(&$array) {
            $longitud = count($array);
            for ($i = 0; $i < $longitud; $i++) {
                for ($j = 0; $j < $longitud - 1; $j++) {
                    if ($array[$j] > $array[$j + 1]) {
                        $temporal = $array[$j];
                        $array[$j] = $array[$j + 1];
                        $array[$j + 1] = $temporal;
                    }
                }
            }
        }

        burbuja($prueba);
        var_dump($prueba);
        ?>
    </body>
</html>
