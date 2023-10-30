<?php
require_once './core/Modelo.php';
class Trabajador extends Modelo{
    private $_id;
    private $_idpersona;
    private $_tipo;

    private $_tabla = 'personal';
    private $_vista = 'v_personal';

    public function __construct($id=null, $idpersona=null,$tipo=null){
        $this->_id = $id;
        $this->_idpersona = $idpersona;
        $this->_tipo = $tipo;

        parent::__construct($this->_tabla);

    }
    public function validar($id){
        $this->setTabla($this->_vista);
        return $this->getBy('idpersonas',$id);
    }

    public function listar(){
        return $this->getAll();
    }
    public function eliminar(){
        return $this->deleteBy('idestados',$this->_id);
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
        
        $wh = "idestados = $this->_id";

        return $this->update($wh, $datos);

    }

}