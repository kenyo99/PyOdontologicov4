<?php
require_once './core/Controlador.php';

class CtrlPrincipal extends Controlador{
    public function index(){
        # echo "Saludos desde CtrlPrincipal";
        $datos = array(
            'menu'=>array(
                'CtrlPrincipal'=>'Inicio',
                'CtrlEstado'=>'Estados',

            )
        );

        $this->mostrar('personas/login.php',$datos);
    }

}