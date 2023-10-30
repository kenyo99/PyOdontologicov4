<?php
require_once './core/Modelo.php';
class Estado_dental extends Modelo{
    private $_id;
    private $_icono;
    private $_descripcion;
    private $_color;

    private $_tabla = 'estado_dental';

    public function __construct($id=null, $icono=null, $descripcion=null, $color=null){
        $this->_id = $id;
        $this->_icono = $icono;
        $this->_descripcion = $descripcion;
        $this->_color = $color;

        parent::__construct($this->_tabla);

    }
    public function listar(){
        return $this->getAll();
    }
    public function getOne(){
        return $this->getBy('idestado_dental',$this->_id);
    }
    public function eliminar(){
        return $this->deleteBy('idestado_dental',$this->_id);
    }

    public function nuevo(){
        $datos = array(
            "icono"=>"'$this->_icono'",
            "descripcion"=>"'$this->_descripcion'",
            "color"=>"'$this->_color'"
        );
        return $this->insert($datos);
    }
    public function editar(){
        $datos = array(
            "icono"=>"'$this->_icono'",
            "descripcion"=>"'$this->_descripcion'",
            "color"=>"'$this->_color'"
        );
        
        $wh = "idestado_dental = $this->_id";

        return $this->update($wh, $datos);

    }

}