<?php
# require_once './core/Modelo.php';
require_once './modelo/Persona.php';

class Presupuesto extends Persona{
    
    private $_id;
    private $_tipo;

    private $_tabla = 'paciente';
    private $_vista = 'v_pacientes';

    public function __construct($id=null, $nombre=null, $apellido=null,$dni=null
                ,$direccion=null,$fechanac=null,$telefono=null,$correo=null
                ,$usuario=null,$sexo=null,$tipo=null,$fechaalta=null,$clave=null, $estado='2'){

                    
        $this->_id = $id;
        $this->_tipo = $tipo;
        
        parent::__construct ($id,$nombre, $apellido,$dni,$direccion,$fechanac
                ,$telefono,$correo,$usuario,$clave, $fechaalta,$estado,$sexo);
        

       # parent::__construct($this->_tabla);

    }
    public function listar(){
        $this->setTabla($this->_vista);
        return $this->getAll();
    }
    public function getOne(){
        $this->setTabla($this->_vista);
        return $this->getBy('idpersonas',$this->_id);
    }
    public function eliminar(){
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

    }
    
    
}