<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/Presupuesto.php';
require_once './modelo/Persona.php';
require_once './modelo/Paciente.php';

class CtrlPresupuesto extends Controlador{
    public function index(){
        $this->listar();
    }

    public function guardarPaciente(){
        $id=$_POST['id'];
        $tipo = $_POST['tipo'];
        $obj= new Paciente;
        $obj->guardarPaciente($id,$tipo);
        $this->listar();

    }
    public function guardar(){
        #Paciente
        $id=$_POST['id'];
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $dni=$_POST['dni'];
        $direccion=$_POST['direccion'];
        $fechanac=$_POST['fechanac'];
        $telefono=$_POST['telefono'];
        $correo=$_POST['correo'];
        $usuario=$_POST['usuario'];
        $sexo=$_POST['sexo'];
        /* $clave=$_POST['clave']; */
        # Paciente
        $tipo = $_POST['tipo'];
        
        $obj= new Paciente($id, $nombre, $apellido,$dni
            ,$direccion,$fechanac,$telefono,$correo,$usuario,$sexo,$tipo);
         #var_dump($obj);
        if ($id==''){
            $respuesta = $obj->nuevo();
            
        } else {    # Editar
            $respuesta = $obj->editar();
        }
        
        $this->listar();
    }
    public function editar(){
        
        $id = $_GET['id'];
        # echo "Editando....".$id;
        $obj= new Paciente($id);
        $miObj = $obj->getOne()['data'];
        
        # var_dump($miObj);exit;
        $datos = array(
            'data'=>$miObj[0]
        );
        # var_dump($datos);exit;
        $this->mostrar('pacientes/formulario.php',$datos);
    }
    public function eliminar(){

        $id = $_GET['id'];
        $obj= new Paciente($id);

        $respuesta = $obj->eliminar();

        $this->listar();

    }
    public function nuevo(){
        $this->mostrar('presupuesto/formulario.php');
    }
    public function nuevoPersona(){
        
        $this->mostrar('personas/formulario.php');
    }

    public function listar(){

        $obj= new Presupuesto();

        $respuesta = $obj->listar();

        $msg = $respuesta['msg'];
        # var_dump($respuesta);exit;
        $datos = [
                'titulo'=>"Nuevo Presupuesto",
                'data'=>$respuesta['data']
            ];
        $contenido=$this->mostrar('presupuesto/mostrar.php',$datos,true);
        $data = [
            'titulo'=>'Nuevo Presupuesto',
            'contenido'=>$contenido,
            'msg'=>$msg
        ];

        $this->mostrar('template.php',$data);

    }
    public function buscarxDNI(){
        $dni = $_GET['dni'];
        $obj= new Persona();
        $data = $obj->buscarXDni($dni);
        if (is_null($data))
            echo "0";
        else
            echo json_encode($data);
    }

    
}