<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/Cita.php';
require_once './modelo/Paciente.php';
class CtrlCita extends Controlador
{
    public function index(){
        # $this->verificarLogin();
        $this->listar();
    }
    
    public function listar(){

        $obj= new Cita();

        $respuesta = $obj->listar();

        $msg = $respuesta['msg'];
        // var_dump($respuesta);exit;
        $datos = [
                'titulo'=>"Registro de Citas",
                'data'=>$respuesta['data']
            ];
        $contenido=$this->mostrar('citas/listarCitas01.php',$datos,true);
        $data = [
            'titulo'=>'Registro de Citas',
            'contenido'=>$contenido,
            'data'=>$respuesta['data'],
            'msg'=>$msg
        ];
        // var_dump($data);exit;
        $this->mostrar('template.php',$data);

    }

    public function reservarCita(){
        
        $obj = new Cita (
                null, $_POST['fecha_inicio'],
                $_SESSION['id'], $_POST['evento']);
        $data = $obj->nuevo();
        echo json_encode($data);

        /* $this->index(); */

    }
    public function nuevo(){

        $id = $_GET['idpaciente'];
        $paciente = (new Paciente($id))->getOne()['data'][0];
        $datos = [
            'paciente'=>$paciente
        ];
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
        $id=$_POST['id'];
        $nombre=$_POST['nombre'];
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
    public function verCitas(){
        if (isset($_GET['id'])){    # Si se ha LOGUEADO

            $obj = new Cita;
            $respuesta = $obj->listarPorPaciente($_GET['id']);
            $estadistica = $obj->getEstidisticaXPaciente($_GET['id']);
            
            require_once './modelo/Paciente.php';
            $obj = new Paciente($_GET['id']);
            $paciente = $obj->getOne()['data'][0];

            
            $msg = $respuesta['msg'];
        # var_dump($respuesta);exit;
        $datos = [
                'titulo'=>"Mis Citas",
                'data'=>$respuesta['data'],
                'estadisticas'=>$estadistica['data'],
                'paciente'=>$paciente['nombre'] . ' '.$paciente['apellido']
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

    /*public function citasFull01(){
        
        $obj= new Cita();

        $respuesta = $obj->getCitasForJSON();

        print_r($respuesta['data']);
        #echo json_encode($respuesta['data'],JSON_UNESCAPED_UNICODE);
        die();
        
    }*/
    public function citasFull01(){
        
        $this->mostrar('citas/formularioCita.php');
        
    }
}