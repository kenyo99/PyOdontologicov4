<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/Paciente.php';
require_once './modelo/Historias.php';

class CtrlHistorias extends Controlador
{
    public function index(){
        $id = isset($_GET['id'])?$_GET['id']:null;
        if ($id==null){
            // No se seleccionó un PACIENTE
            header('Location:?ctrl=CtrlPaciente&accion=listar');
            die();
        } else
            $this->listar($id);
    }
    public function editar(){
        $id = $_GET['idPaciente'];
        $paciente = (new Paciente($id))->getOne()['data'][0];
        
        
        $id = $_GET['id'];
        # echo "Editando....".$id;
        $obj= new Historias($id);

        $miObj = $obj->getOne();
        # var_dump($miObj);exit;
        $datos = array(
            'data'=>$miObj['data'][0],
            'paciente'=>$paciente
        );
        # var_dump($datos);exit;
        $this->mostrar('historias/formulario.php',$datos);
    }
    public function guardar(){
        $id=$_POST['id'];
        $enfermedades=$_POST['enfermedades'];
        $alergias=$_POST['alergias'];
        $sensibilidad=$_POST['sensibilidad'];
        $presion=$_POST['presion'];
        $gestacion=$_POST['gestacion'];
        $temperatura=$_POST['temperatura'];
        $fecha=$_POST['fecharec'];
        $observaciones=$_POST['observaciones'];
        $idPaciente=$_POST['idPaciente'];
        //var_dump($_POST); exit;
        #var_dump($id,$presion,'enfermedades',$enfermedades,$temperatura); exit;
         
        $obj= new Historias($id,$fecha, $observaciones
                ,$idPaciente, '2', $enfermedades
                ,$alergias,$sensibilidad,$presion
                ,$temperatura,$gestacion);
        /* $id=null, $fecha=null,$_observaciones=null
                , $idPaciente=null, $idDoctor=null, $enfermedades=null

                , $alergias=null, $presion=null, $sensibilidad=null
                , $temperatura=null,$gestacion=null */



        if ($id==''){
            $respuesta = $obj->nuevo();
        } else {    # Editar
            $respuesta = $obj->editar();
        }
        
        $this->listar($idPaciente);
    }
    public function nuevo(){
        $id = $_GET['idPaciente'];
        $paciente = (new Paciente($id))->getOne()['data'][0];
        $datos = [
            'paciente'=>$paciente
        ];

        $this->mostrar('historias/formulario.php',$datos);
    }

    public function eliminar(){

        $id = $_GET['id'];
        $obj= new Historias($id);

        $respuesta = $obj->eliminar();

        $this->listar();

    }

    public function listarXPaciente($id){
/**
 * Recuperar el paciente
 */
    $paciente = (new Paciente($id))->getOne()['data'][0];
    // var_dump($paciente);exit;

 /**
 * Recuperar la historia del paciente
 */
        $obj= new Historias();
        
        $respuesta = $obj->listar($id);

        $msg = $respuesta['msg'];
        //var_dump($respuesta);exit;
        $datos = [
                'titulo'=>"Historias Clinicas",
                'paciente'=>$paciente,
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
    public function listar($id=null){
        // $id = isset($_GET['id'])?$_GET['id']:null;
        if ($id==null){
            // No se seleccionó un PACIENTE
            header('Location:?ctrl=CtrlPaciente&accion=listar');
            die();
        } else {
        /**
         * Recuperar el paciente
         */
            $paciente = (new Paciente($id))->getOne()['data'][0];
            // var_dump($paciente);exit;
            require_once ('./modelo/Comprobante.php');
            $obj = new Comprobante();

            $estadisticas = $obj->getEstadisticasXPaciente($id);

        /**
         * Recuperar la historia del paciente
         */
                $obj= new Historias();
                
                $respuesta = $obj->listar($id);

                $msg = $respuesta['msg'];
                //var_dump($respuesta);exit;
                $datos = [
                        'titulo'=>"Historias Clinicas",
                        'paciente'=>$paciente,
                        'estadisticas'=>$estadisticas['data'],
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
}