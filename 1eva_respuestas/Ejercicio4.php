<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php

        class A {

            public $publica = "saludos";
            protected $protegida = "verde";
            private $privado1 = "verde";
            private $privado2 = "verde";

            public function __set($name, $value) {
                $this->$name = $value;
                /* Condicional que restringe el acceso a __set
                switch ($name) {
                    case "privado1": $this->$name = $value;
                        break;
                    case "privado3": $this->$name = $value;
                        break;
                    default: NULL;
                        break;
                }*/
            }

            public function __get($name) {
                return $this->$name;
                /* Condicional que restringe el acceso a __get
                switch ($name) {
                    case "privado1": return $this->$name;
                        break;
                    case "privado3": return $this->$name;
                        break;
                    default: return NULL;
                        break;
                }*/
            }

        }

         class B extends A{
             private $casa = "en la playa";
             protected $llave = "de metal";
         }
        $obj = new B;
        /* Hace explotar el sistema por culpa de que no son de A.
         * echo $obj->casa . "<br>";
        echo $obj->llave . "<br>";*/

        echo $obj->publica . "<br>";

        echo $obj->protegida . "<br>";
        $obj->privado1 = "azul";
        echo $obj->privado1 . "<br>";
        $obj->privado2 = "rojo";
        echo $obj->privado2 . "<br>";

        var_dump($obj);
        ?>
    </body>
</html>
