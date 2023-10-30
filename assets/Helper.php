<?php
abstract class Helper {

    static public function getEdad($fecha_nacimiento){
        if ($fecha_nacimiento!=''){
            $nacimiento = new DateTime($fecha_nacimiento);
            $ahora = new DateTime(date("Y-m-d"));
            $diferencia = $ahora->diff($nacimiento);
            return $diferencia->format("%y");
        } else {
            return 0;
        }
    }
}