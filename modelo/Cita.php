<?php
require_once './core/Modelo.php';
class Cita extends Modelo{
    private $_id;
    private $_fecha;
    private $_estado;
    private $_paciente;
    private $_observaciones;
    private $_personal;


    private $_tabla = 'citas';
    # private $_vista = 'v_cita';
    private $_vista = 'v_cita01';

    public function __construct($id=null, $fecha=null
                                , $paciente=null, $obs = null 
                               , $estado=1
                    ){
        $this->_id = $id;
        $this->_estado = $estado;
        $this->_fecha = $fecha;
        $this->_paciente = $paciente;
        $this->_personal = 4;
        $this->_observaciones = $obs;

        parent::__construct($this->_tabla);

    }
    public function listar(){
        return $this->getAll();
    }
    public function getOne(){
        return $this->getBy('idcitas',$this->_id);
    }
    /*public function eliminar(){
        return $this->deleteBy('iddientes',$this->_id);
    } */

    public function nuevo(){
        $datos = array(
            "fecha"=>"'$this->_fecha'",
            "observaciones"=>"'$this->_observaciones'",
            "idestados"=>"'$this->_estado'",
            "idpaciente"=>"'$this->_paciente'",
            "idpersonal"=>"'$this->_personal'",
            
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
    public function TraerCitas(){
        $hoy = getdate();
        $sql = "Select * from v_cita01 ORDER BY fecha DESC LIMIT 0, 9 ";
        # var_dump($sql);exit;
        $this->_sql->setSQL($sql);

        return $this->_bd->ejecutar($this->_sql);
    }

    public function getCitas(){
        $hoy = getdate();
        $sql = "Select * from ". $this->_vista 
            . " where fecha > '".$hoy['year']."-".$hoy['mon']."-".$hoy['mday']."'";
        # var_dump($sql);exit;
        $this->_sql->setSQL($sql);

        return $this->_bd->ejecutar($this->_sql);
    }
    public function listarPorPaciente($idPaciente){
        $sql = "Select * from ". $this->_vista 
        . " where idpaciente = $idPaciente";

        $this->_sql->setSQL($sql);
        
        return $this->ejecutarSql();
    }

}