<?php
require_once './core/Modelo.php';
class Servicio extends Modelo{
    private $_id;
    private $_nombre;
    private $_descripcion;
    private $_precio;

    private $_tabla = 'servicios_odontologicos';

    public function __construct($id=null, $nombre=null, $descripcion=null, $precio=null){
        $this->_id = $id;
        $this->_nombre = $nombre;
        $this->_descripcion = $descripcion;
        $this->_precio = $precio;

        parent::__construct($this->_tabla);

    }
    public function listar(){
        return $this->getAll();
    }
    public function getOne(){
        return $this->getBy('idservicio',$this->_id);
    }
    public function eliminar(){
        return $this->deleteBy('idservicio',$this->_id);
    }

    public function nuevo(){
        $datos = array(
            "nombre"=>"'$this->_nombre'",
            "descripcion"=>"'$this->_descripcion'",
            "precio"=>"'$this->_precio'"
        );
        return $this->insert($datos);
    }
    public function editar(){
        $datos = array(
            "nombre"=>"'$this->_nombre'",
            "descripcion"=>"'$this->_descripcion'",
            "precio"=>"'$this->_precio'"
        );
        
        $wh = "idservicio = $this->_id";

        return $this->update($wh, $datos);

    }

}