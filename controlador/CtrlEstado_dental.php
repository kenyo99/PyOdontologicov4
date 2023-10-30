<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/Estado_dental.php';
class CtrlEstado_dental extends Controlador
{
    public function index(){
        $this->verificarLogin();
        $this->listar();

    }
    public function editar(){
        
        $id=$_GET['id'];
        # echo "Editando....".$id;
        $obj= new Estado_dental($id);

        $miObj = $obj->getOne();
        # var_dump($miObj);exit;
        $datos = array(
            'data'=>$miObj['data'][0]
        );
        # var_dump($datos);exit;
        $this->mostrar('estado_dental/formulario.php',$datos);
    }
    public function guardar(){
        $id=$_POST['id'];
        $icono=$_POST['icono'];
        $descripcion=$_POST['descripcion'];
        $color=$_POST['color'];
        
        $obj= new Estado_dental($id, $icono, $descripcion, $color);

        if ($id==''){
            $respuesta = $obj->nuevo();
        } else {    # Editar
            $respuesta = $obj->editar();
        }
        
        $this->listar();
    }
    public function nuevo(){
        $this->mostrar('estado_dental/formulario.php');
    }

    public function eliminar(){

        $id = $_GET['id'];
        $obj= new Estado_dental($id);

        $respuesta = $obj->eliminar();

        $this->listar();

    }

    public function listar(){

        $obj= new Estado_dental();

        $respuesta = $obj->listar();

        $msg = $respuesta['msg'];
        # var_dump($respuesta);exit;
        $datos = [
                'titulo'=>"Registro de Estado Dental",
                'data'=>$respuesta['data']
            ];
        $contenido=$this->mostrar('estado_dental/mostrar.php',$datos,true);
        $data = [
            'titulo'=>'Registro de Estado Dental',
            'contenido'=>$contenido,
            'msg'=>$msg
        ];

        $this->mostrar('template.php',$data);

    }
    private function verificarLogin(){
        if (!isset($_SESSION['usuario'])){
            header("Location: ?");
            exit();
        }
    }
}