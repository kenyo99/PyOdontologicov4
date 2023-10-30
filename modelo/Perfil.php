<?php
require_once './core/Modelo.php';
class Persona extends Modelo{
    private $_id;
    private $_nombre;
    private $_apellido;
    private $_dni;
    private $_direccion;
    private $_fechanac;
    private $_telefono;
    private $_correo;
    private $_usuario; 
    private $_fechaalta;
    private $_estado;
    private $_clave;

    private $_tabla = 'personas';

    public function __construct($id=null, $nombre=null, $apellido=null,$dni=null,$direccion=null,$fechanac=null,$telefono=null,$correo=null,$usuario=null,$clave=null, $fechaalta=null, $estado=null,$sexo=null){
        $this->_id = $id;
        $this->_nombre = $nombre;
        $this->_apellido = $apellido;
        $this->_dni = $dni;
        $this->_direccion = $direccion;
        $this->_fechanac =$fechanac;
        $this->_telefono = $telefono;
        $this->_correo = $correo;
        $this->_usuario = $usuario;
        $this->_clave = $clave; 
        $this->_fechaalta = '';
        $this->_estado = '2';
        $this->_sexo = '1';

        parent::__construct($this->_tabla);

    }
    public function listar(){
        return $this->getAll();
    }
    public function getOne(){
        return $this->getBy('idpersonas',$this->_id);
    }
    public function eliminar(){
        return $this->deleteBy('idpersonas',$this->_id);
    }
    public function nuevo(){
        $datos =  $this->getDatos();
        #var_dump($datos);
        #echo $this->_sql;
        return $this->insert($datos);
    }
    public function editar(){
        $datos = $this->getDatos();
        
        $wh = "idpersonas = $this->_id";

        return $this->update($wh, $datos);

    }
    private function getDatos(){
        return array(
            "nombre"=>"'$this->_nombre'",
            "apellido"=>"'$this->_apellido'",
            "dni"=>"'$this->_dni'",
            "direccion"=>"'$this->_direccion'",
            "fecha_nacimiento"=>"'$this->_fechanac'",
            "telefono"=>"'$this->_telefono'",
            "correo"=>"'$this->_correo'",
            "usuario"=>"'$this->_usuario'",
            "clave"=>"'".$this->encriptarClave($this->_clave)."'",
            "fecha_alta"=>"'$this->_fechaalta'",
            "estados_idestados"=>"'$this->_estado'",
            "idsexos"=>"'$this->_sexo'"
        );
    }
    public function validarLogin($usuario, $clave){
        $clave = $this->encriptarClave($clave);
        $this->_sql->addWhere("`correo`='$usuario'");
        $this->_sql->addWhere("`clave`='$clave'");
        #echo $this->_sql;exit;
        return $this->_bd->ejecutar($this->_sql);
    }
    public function restablecerClave(){
        $clave = $this->encriptarClave('123456');
        $datos = array(
            "clave"=>"'$clave'",
        );
        
        $wh = "idpersonas = $this->_id";

        return $this->update($wh, $datos);
    }
    public function cambiarClave($clave){
        $clave = $this->encriptarClave($clave);
        $datos = array(
            "clave"=>"'$clave'",
        );
        
        $wh = "idpersonas = $this->_id";

        return $this->update($wh, $datos);
    }
    private function encriptarClave($clave){
        $miClave = substr(md5($clave),5,15).substr(md5($clave),2,10);
        #$miClave = substr(md5($clave));

        return $miClave;
    }

}