<?php
require_once './core/Modelo.php';


class Comprobante extends Modelo{
    
    private $_id;
    /* private $_tipo;  */

    private $_tabla = 'comprobante';
    private $_vista = 'v_comprobante00';

    public function __construct($id=null){

                    
        $this->_id = $id;
        /* $this->_tipo = $tipo; */

       parent::__construct($this->_tabla);

    }
    public function getPresupuestosXPaciente($id){
        $sql = "Select * from v_comprobante00 where idpersonas=$id";
        $this->setSql($sql);
        return $this->ejecutarSql();
    }


    /* public function listar(){
        $this->setTabla($this->_vista);
        return $this->getAll();
    }
    public function getOne(){
        $this->setTabla($this->_vista);
        return $this->getBy('idpersonas',$this->_id);
    } */

    /* public function eliminar(){
        $this->setTabla($this->_tabla);
        $this->deleteBy('idpersonas',$this->_id);
        # var_dump($this->_tabla);exit;
        $this->setTabla('personas');
        parent::eliminar();

    }
    public function nuevo(){
        parent::nuevo();
        $datos = [
            'idpersonas'=>$this->idSiguiente,
            'idtipo_paciente'=>"$this->_tipo",
        ];
        # var_dump($datos);exit;
        $this->setTabla('paciente');

        return $this->insert($datos);

    }
    public function guardarPaciente($idPersona,$tipo){
        # parent::nuevo();
        $datos = [
            'idpersonas'=>$idPersona,
            'idtipo_paciente'=>"$tipo",
        ];
        # var_dump($datos);exit;
        $this->setTabla('paciente');

        return $this->insert($datos);

    }
    
    public function editar(){
         parent::editar();
        $datos = [
            'idpersonas'=>$this->_id,
            'idtipo_paciente'=>"$this->_tipo",
        ];
        $this->setTabla('paciente');
        $wh = "idpersonas=$this->_id";
        return $this->update($wh,$datos);

    } */
    
    
}