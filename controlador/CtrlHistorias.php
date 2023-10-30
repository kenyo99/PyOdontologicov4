<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/Historias.php';

class CtrlHistorias extends Controlador
{
    public function index(){
        $id = isset($_GET['id'])?$_GET['id']:null;
        $this->listar($id);
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

        if ($id==''){
            $respuesta = $obj->nuevo();
        } else {    # Editar
            $respuesta = $obj->editar();
        }
        
        $this->listar();
    }
    public function nuevo(){
        $this->mostrar('historias/formulario.php');
    }

    public function eliminar(){

        $id = $_GET['id'];
        $obj= new Diente($id);

        $respuesta = $obj->eliminar();

        $this->listar();

    }

    public function listar($id){

        $obj= new Historias();
        
        $respuesta = $obj->listar($id);

        $msg = $respuesta['msg'];
        # var_dump($respuesta);exit;
        $datos = [
                'titulo'=>"Historias Clinicas",
                'data'=>$respuesta['data']
            ];
        $contenido=$this->mostrar('historias/mostrar.php',$datos,true);
        $data = [
            'titulo'=>'Historias Clinicas',
            'contenido'=>$contenido,
            'msg'=>$msg
        ];

        $this->mostrar('template.php',$data);

    }
}