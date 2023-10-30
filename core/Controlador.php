<?php
require_once "Vista.php";
abstract class Controlador {
   # Código del CORE - Controlador
   static protected function mostrar($vista,
                                        $datos='',
                                        $comoContenido=FALSE){
       return Vista::mostrar($vista,$datos,$comoContenido);
   }
   public function __toString(){
      return __CLASS__;
   }
}
