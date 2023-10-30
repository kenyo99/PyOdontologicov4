<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/Personal.php';

class CtrlPersonal extends Controlador{
    public function index(){
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
        $obj= new personal($id);
        $miObj = $obj->getOne()['data'];
        
        # var_dump($miObj);exit;
        $datos = array(
            'data'=>$miObj[0]
        );
        # var_dump($datos);exit;
        $this->mostrar('personal/formulario.php',$datos);
    }
    public function eliminar(){

        $id = $_GET['id'];
        $obj= new Personal($id);

        $respuesta = $obj->eliminar();

        $this->listar();

    }
    public function nuevo(){
        $this->mostrar('personal/formulario.php');
    }

    public function listar(){

        $obj= new Personal();

        $respuesta = $obj->listar();

        $msg = $respuesta['msg'];
        # var_dump($respuesta);exit;
        $datos = [
                'titulo'=>"Personal",
                'data'=>$respuesta['data']
            ];
        $contenido=$this->mostrar('personal/mostrar.php',$datos,true);
        $data = [
            'titulo'=>'Personal',
            'contenido'=>$contenido,
            'msg'=>$msg
        ];

        $this->mostrar('template.php',$data);

    }

    
}