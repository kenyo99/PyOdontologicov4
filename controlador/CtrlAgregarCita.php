<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/AgregarCita.php';
class CtrlAgregarCita extends Controlador
{
    public function index(){
        $this->verificarLogin();
        $this->listar();
    }
    public function editar(){
        
        $id = $_GET['id'];
        # echo "Editando....".$id;
        $obj= new AgregarCita($id);

        $miObj = $obj->getOne();
        # var_dump($miObj);exit;
        $datos = array(
            'data'=>$miObj['data'][0]
        );
        # var_dump($datos);exit;
        $this->mostrar('AgregarCitas/formulario.php',$datos);
    }
    public function guardar(){
        $id=$_POST['id'];
        $fecharec=$_POST['fecharec'];
        $observaciones=$_POST['observaciones'];
        
        $obj= new AgregarCita($id, $fecharec, $observaciones);
        var_dump($obj);
        #echo $id,$fecharec,$observaciones;
        if ($id==''){
            $respuesta = $obj->nuevo();
        } else {    # Editar
            $respuesta = $obj->editar();
        }
        
        $this->listar();
    }
    public function nuevo(){
        $this->mostrar('agregar_cita/formulario.php');
    }

    public function eliminar(){

        $id = $_GET['id'];
        $obj= new AgregarCita($id);

        $respuesta = $obj->eliminar();

        $this->listar();

    }

    public function listar(){

        $obj= new AgregarCita();

        $respuesta = $obj->listar();

        $msg = $respuesta['msg'];
        # var_dump($respuesta);exit;
        $datos = [
                'titulo'=>"Registrar fecha y hora",
                'data'=>$respuesta['data']
            ];
        $contenido=$this->mostrar('agregar_cita/mostrar.php',$datos,true);
        $data = [
            'titulo'=>'Registrar fecha y hora',
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