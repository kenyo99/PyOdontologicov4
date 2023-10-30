<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/Estado.php';
class CtrlEstado extends Controlador
{
    public function index(){
        $this->verificarLogin();
        $this->listar();

    }
    public function editar(){
        
        $id = $_GET['id'];
        # echo "Editando....".$id;
        $obj= new Estado($id);

        $miObj = $obj->getOne();
        # var_dump($miObj);exit;
        $datos = array(
            'data'=>$miObj['data'][0]
        );
        # var_dump($datos);exit;
        $this->mostrar('estados/formulario.php',$datos);
    }
    public function guardar(){
        $id=$_POST['id'];
        $nombre=$_POST['nombre'];
        
        $obj= new Estado($id, $nombre);

        if ($id==''){
            $respuesta = $obj->nuevo();
        } else {    # Editar
            $respuesta = $obj->editar();
        }
        
        $this->listar();
    }
    public function nuevo(){
        $this->mostrar('estados/formulario.php');
    }

    public function eliminar(){

        $id = $_GET['id'];
        $obj= new Estado($id);

        $respuesta = $obj->eliminar();

        $this->listar();

    }

    public function listar(){

        $obj= new Estado();

        $respuesta = $obj->listar();

        $msg = $respuesta['msg'];
        # var_dump($respuesta);exit;
        $datos = [
                'titulo'=>"Estados",
                'data'=>$respuesta['data']
            ];
        $contenido=$this->mostrar('estados/mostrar.php',$datos,true);
        $data = [
            'titulo'=>'Estados',
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