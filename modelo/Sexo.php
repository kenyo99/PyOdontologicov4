<?php
require_once './core/Modelo.php';
class Sexo extends Modelo{
    private $_id;
    private $_estado;

    private $_tabla = 'sexos';

    public function __construct($id=null, $estado=null){
        $this->_id = $id;
        $this->_estado = $estado;

        parent::__construct($this->_tabla);

    }
    public function listar(){
        return $this->getAll();
    }
    public function getOne(){
        return $this->getBy('idsexos',$this->_id);
    }
    public function eliminar(){
        return $this->deleteBy('idsexos',$this->_id);
    }

    public function nuevo(){
        $datos = array(
            "nombre"=>"'$this->_estado'"
        );
        return $this->insert($datos);
    }
    public function editar(){
        $datos = array(
            "nombre"=>"'$this->_estado'"
        );
        
        $wh = "idsexos = $this->_id";

        return $this->update($wh, $datos);

    }

}