<?php

    class utils
    {
        
       function __construct($argument)
       {
       }

       function limpiarDato($dato){
            echo 'ssss';
            if (get_magic_quotes_gpc()){
                $dato = stripslashes($dato);
            }
            elseif (!is_numeric($dato)){
                $dato = mysql_real_escape_string($dato);
            }
            return $dato;
       }

       function limpiarQuery($datos){
           echo 'ffff';
            foreach ($datos as $key => $valor){
                $datos[$key] = this.limpiarDato($valor);
            }
            return $datos;
       }
    }
?>
