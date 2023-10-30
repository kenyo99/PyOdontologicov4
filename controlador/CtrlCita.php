<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/Cita.php';
class CtrlCita extends Controlador
{
    public function index(){
        # $this->verificarLogin();
        $this->listar();
    }
    
    public function listar(){

        $obj= new Cita();

        $respuesta = $obj->getCitas();

        $msg = $respuesta['msg'];
        # var_dump($respuesta);exit;
        $datos = [
                'titulo'=>"Registro de dientes",
                'data'=>$respuesta['data']
            ];
        $contenido=$this->mostrar('citas/calendario.php',$datos,true);
        $data = [
            'titulo'=>'Registro de Citas',
            'contenido'=>$contenido,
            'data'=>$respuesta['data'],
            'msg'=>$msg
        ];

        $this->mostrar('template.php',$data);

    }
    /* private function verificarLogin(){
        if (!isset($_SESSION['usuario'])){
            header("Location: ?");
            exit();
        }
    } */
    public function reservarCita(){
        # var_dump($_POST);
        $obj = new Cita (
                null, $_POST['fecha_inicio'],
                $_SESSION['id'], $_POST['evento']);
        $obj->nuevo();
        
        $this->index();

    }
    public function nuevo(){
        $this->mostrar('citas/formularioCita.php');
    }
    public function editar(){
        
        $id = $_GET['id'];
        # echo "Editando....".$id;
        $obj= new Cita($id);
        $miObj = $obj->getOne();
        # var_dump($miObj);exit;
        $datos = array(
            'data'=>$miObj['data'][0]
        );
        # var_dump($datos);exit;
        $this->mostrar('citas/formularioCita.php',$datos);
    }

    public function guardar(){
        $fecha = $_POST['fecharec'] . " ".$_POST['hora'];
        #var_dump($fecha); exit;
        $obj = new Cita (
                null, $fecha,
                $_SESSION['id'], $_POST['evento']);
        $obj->nuevo();
        
        $this->citasPorPaciente();
    }
    public function citasPorPaciente(){
        if (isset($_SESSION['id'])){    # Si se ha LOGUEADO

            $obj = new Cita;
            $respuesta = $obj->listarPorPaciente($_SESSION['id']);
            
            
            $msg = $respuesta['msg'];
        # var_dump($respuesta);exit;
        $datos = [
                'titulo'=>"Mis Citas",
                'data'=>$respuesta['data']
            ];
        $contenido=$this->mostrar('citas/listarCitas.php',$datos,true);
        $data = [
            'titulo'=>'Mis Citas',
            'contenido'=>$contenido,
            'msg'=>$msg,
            'data'=>$respuesta['data']
        ];

        $this->mostrar('template.php',$data);


        }else{
            echo "No te has registrado";
        }

    }
    public function citasFull(){
        
        $obj= new Cita();

        $respuesta = $obj->TraerCitas();

        $msg = $respuesta['msg'];
        # var_dump($respuesta);exit;
        $datos = [
                'titulo'=>"Citas",
                'data'=>$respuesta['data']
            ];
        $contenido=$this->mostrar('citas/listarCitas.php',$datos,true);
        $data = [
            'titulo'=>'Citas',
            'contenido'=>$contenido,
            'data'=>$respuesta['data'],
            'msg'=>$msg
        ];

        $this->mostrar('template.php',$data);

    }
}