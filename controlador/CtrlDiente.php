<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/Diente.php';
class CtrlDiente extends Controlador
{
    public function index(){
        $this->listar();
    }
    public function editar(){
        
        $id = $_GET['id'];
        # echo "Editando....".$id;
        $obj= new Diente($id);
        $miObj = $obj->getOne();
        # var_dump($miObj);exit;
        $datos = array(
            'data'=>$miObj['data'][0]
        );
        # var_dump($datos);exit;
        $this->mostrar('dientes/formulario.php',$datos);
    }
    public function guardar(){
        $id=$_POST['id'];
        $ubicacion=$_POST['ubicacion'];
        $nombre=$_POST['nombre'];
        
        $obj= new Diente($id, $ubicacion, $nombre);
        #var_dump($obj);
        if ($id==''){
            $respuesta = $obj->nuevo();
        } else {    # Editar
            $respuesta = $obj->editar();
        }
        
        $this->listar();
    }
    public function nuevo(){
        $this->mostrar('dientes/formulario.php');
    }

    public function eliminar(){

        $id = $_GET['id'];
        $obj= new Diente($id);

        $respuesta = $obj->eliminar();

        $this->listar();

    }

    public function listar(){

        $obj= new Diente();

        $respuesta = $obj->listar();

        $msg = $respuesta['msg'];
        # var_dump($respuesta);exit;
        $datos = [
                'titulo'=>"Registro de dientes",
                'data'=>$respuesta['data']
            ];
        $contenido=$this->mostrar('Dientes/mostrar.php',$datos,true);
        $data = [
            'titulo'=>'Registro de dientes',
            'contenido'=>$contenido,
            'msg'=>$msg
        ];

        $this->mostrar('template.php',$data);

    }
}