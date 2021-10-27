<!DOCTYPE html>
<html>
    <head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
</head>
    <table>
       <?php
       $tablacontrol = 0;
       $acabado = false;
       
        echo"<tr> <th></th>";
        for($i = 0; $i<11; $i++){
            echo"<th> $i </th>";
        }
        echo"</tr>";
       
        while ($acabado ==false){
            echo"<tr> <th> $tablacontrol </th>";
            for($i = 0; $i<11; $i++){
                echo"<td>". $tablacontrol*$i ."</td>";
            }
            echo"</tr>";
            $tablacontrol++;
            if($tablacontrol == 11) {
                $acabado = true;
            }
        }
       ?> 
    </table>
</html>
