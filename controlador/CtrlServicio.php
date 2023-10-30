<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/Servicio.php';
class CtrlServicio extends Controlador
{
    public function index(){
        $this->verificarLogin();
        $this->listar();

    }
    public function editar(){
        
        $id=$_GET['id'];
        # echo "Editando....".$id;
        $obj= new Servicio($id);

        $miObj = $obj->getOne();
        # var_dump($miObj);exit;
        $datos = array(
            'data'=>$miObj['data'][0]
        );
        # var_dump($datos);exit;
        $this->mostrar('servicios/formulario.php',$datos);
    }
    public function guardar(){
        $id=$_POST['id'];
        $nombre=$_POST['nombre'];
        $descripcion=$_POST['descripcion'];
        $precio=$_POST['precio'];
        
        $obj= new Servicio($id, $nombre, $descripcion, $precio);

        if ($id==''){
            $respuesta = $obj->nuevo();
        } else {    # Editar
            $respuesta = $obj->editar();
        }
        
        $this->listar();
    }
    public function nuevo(){
        $this->mostrar('servicios/formulario.php');
    }

    public function eliminar(){

        $id = $_GET['id'];
        $obj= new Servicio($id);

        $respuesta = $obj->eliminar();

        $this->listar();

    }

    public function listar(){

        $obj= new Servicio();

        $respuesta = $obj->listar();

        $msg = $respuesta['msg'];
        # var_dump($respuesta);exit;
        $datos = [
                'titulo'=>"Servicios Generales ",
                'data'=>$respuesta['data']
            ];
        $contenido=$this->mostrar('servicios/mostrar.php',$datos,true);
        $data = [
            'titulo'=>'Servicios Generales',
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