<?php
require_once './core/Modelo.php';
class FormaPago extends Modelo{
    private $_id;
    private $_forma;

    private $_tabla = 'formas_pagos';

    public function __construct($id=null, $forma=null){
        $this->_id = $id;
        $this->_forma = $forma;

        parent::__construct($this->_tabla);

    }
    public function listar(){
        return $this->getAll();
    }
    public function getOne(){
        return $this->getBy('idpagos',$this->_id);
    }
    public function eliminar(){
        return $this->deleteBy('idpagos',$this->_id);
    }

    public function nuevo(){
        $datos = array(
            "forma"=>"'$this->_forma'"
        );
        return $this->insert($datos);
    }
    public function editar(){
        $datos = array(
            "forma"=>"'$this->_forma'"
        );
        
        $wh = "idpagos = $this->_id";

        return $this->update($wh, $datos);

    }

}