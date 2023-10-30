<?php
require_once './core/Modelo.php';
class AgregarCita extends Modelo{
    private $_id;
    private $_fecharec;
    private $_idpaciente;
    private $_idpersonal;
    private $_observaciones;
    private $_idestados;

    private $_tabla = 'citas';

    public function __construct($id=null, $fecharec=null, $idpaciente=null, $idpersonal=null, $observaciones=null, $idestados=null){
        $this->_id = $id;
        $this->_fecharec= $fecharec;
        $this->_idpaciente = '2';
        $this->_idpersonal = '1';
        $this->_observaciones =  $observaciones;
        $this->_idestados = '1';

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
            "fecha"=>"'$this->_fecharec'",
            "paciente_idpaciente"=>"'$this->_idpaciente'",
            "personal_idpersonal"=>"'$this->_idpersonal'",
            "observaciones"=>"'$this->_observaciones'",
            "idestados"=>"'$this->_idestados'"
        );
        var_dump($datos);
        #echo $this->_sql;
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