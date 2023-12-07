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
   static public function getUserIpAddress() {

    $httpType = [ 
            'HTTP_CLIENT_IP', 
            'HTTP_X_FORWARDED_FOR', 
            'HTTP_X_FORWARDED', 
            'HTTP_X_CLUSTER_CLIENT_IP', 
            'HTTP_FORWARDED_FOR', 
            'HTTP_FORWARDED', 
            'REMOTE_ADDR'
            ] ;
    foreach ( $httpType as $key ) {

            // Comprobamos si existe la clave solicitada en el array de la variable $_SERVER 
            if ( array_key_exists( $key, $_SERVER ) ) {

                // Eliminamos los espacios blancos del inicio y final para cada clave que existe en la variable $_SERVER 
                foreach ( array_map( 'trim', explode( ',', $_SERVER[ $key ] ) ) as $ip ) {
                    // Filtramos* la variable y retorna el primero que pase el filtro
                    if ( filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) !== false )
                        return $ip;
                }
            }
        }

        return '?'; // Retornamos '?' si no hay ninguna IP o no pase el filtro
    } 
}