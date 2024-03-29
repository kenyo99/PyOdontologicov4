<?php
require_once './core/Modelo.php';
class Historias extends Modelo{
    private $_id;
    private $_fecha;
    private $_observaciones;
    private $_idPaciente;
    private $_idDoctor;
    private $_enfermedades;
    private $_alergias;
    private $_presion;
    private $_sensibilidad;
    private $_temperatura;
    private $_gestacion;

    private $_tabla = 'historias_clinicas';
    private $_vista = 'v_historias_clinicas';

    public function __construct($id=null, $fecha=null,$_observaciones=null
                , $idPaciente=null, $idDoctor=null, $enfermedades=null
                , $alergias=null, $presion=null, $sensibilidad=null
                , $temperatura=null,$gestacion=null){

        $this->_id = $id;
        $this->_fecha = $fecha;
        $this->_observaciones = $_observaciones;
        $this->_idPaciente = $idPaciente;
        $this->_idDoctor = $idDoctor;
        $this->_enfermedades = $enfermedades;
        $this->_alergias = $alergias;
        $this->_presion = $presion;
        $this->_sensibilidad = $sensibilidad;
        $this->_temperatura = $temperatura;
        $this->_gestacion = $gestacion;
        

        parent::__construct($this->_tabla);

    }
    public function listar($id){
        $this->setTabla($this->_vista);
        if (is_null($id))
            return $this->getAll();
        else 
            return $this->getHistoriasPaciente($id);
    }
    private function getHistoriasPaciente($id){
        $sql ="Select * from $this->_vista"
            . " where idPaciente=$id";
        $this->setSql($sql);
        return $this->ejecutarSql();
    }
    public function getOne(){
        return $this->getBy('iddientes',$this->_id);
    }
    public function eliminar(){
        return $this->deleteBy('iddientes',$this->_id);
    }

    public function nuevo(){
        $datos = array(
            "fecha"=>"'$this->_fecha'",
            "observaciones"=>"'$this->_observaciones'",
            "idpaciente"=>"'$this->_idPaciente'",
            "iddoctor"=>"'$this->_idDoctor'",
            "enfermedades"=>"'$this->_enfermedades'",
            "alergias"=>"'$this->_alergias'",
            "sensibilidad"=>"'$this->_sensibilidad'",
            "presion"=>"'$this->_presion'",
            "gestacion"=>"'$this->_gestacion'",
            "temperatura"=>"'$this->_temperatura'",
        );
        //var_dump($datos); exit;
        $this->setTabla('historias_clinicas');
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