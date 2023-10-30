<?php
require_once './core/Modelo.php';
class Diente extends Modelo{
    private $_id;
    private $_ubicacion;
    private $_nombre;

    private $_tabla = 'dientes';

    public function __construct($id=null, $ubicacion=null, $nombre=null){
        $this->_id = $id;
        $this->_ubicacion = $ubicacion;
        $this->_nombre = $nombre;

        parent::__construct($this->_tabla);

    }
    public function listar(){
        return $this->getAll();
    }
    public function getOne(){
        return $this->getBy('iddientes',$this->_id);
    }
    public function eliminar(){
        return $this->deleteBy('iddientes',$this->_id);
    }

    public function nuevo(){
        $datos = array(
            "ubicacion"=>"'$this->_ubicacion'",
            "nombre"=>"'$this->_nombre'"
        );
        return $this->insert($datos);
    }
    public function editar(){
        $datos = array(
            "ubicacion"=>"'$this->_ubicacion'",
            "nombre"=>"'$this->_nombre'"
        );
        
        $wh = "iddientes = $this->_id";

        return $this->update($wh, $datos);

    }

}