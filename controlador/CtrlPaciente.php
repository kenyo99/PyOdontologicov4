<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/Persona.php';
require_once './modelo/Paciente.php';

class CtrlPaciente extends Controlador{
    public function index(){
        $this->listar();
    }

    public function guardarPaciente(){
        $id=$_POST['id'];
        $tipo = $_POST['tipo'];
        $obj= new Paciente;
        $obj->guardarPaciente($id,$tipo);
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
        $obj= new Paciente($id);
        $miObj = $obj->getOne()['data'];
        
        # var_dump($miObj);exit;
        $datos = array(
            'data'=>$miObj[0]
        );
        # var_dump($datos);exit;
        $this->mostrar('pacientes/formulario.php',$datos);
    }
    public function eliminar(){

        $id = $_GET['id'];
        $obj= new Paciente($id);

        $respuesta = $obj->eliminar();

        $this->listar();

    }
    public function nuevo(){
        $this->mostrar('pacientes/formulario.php');
    }
    public function nuevoPersona(){
        
        $this->mostrar('personas/formulario.php');
    }

    public function listar(){

        $obj= new Paciente();

        $respuesta = $obj->listar();

        $msg = $respuesta['msg'];
        # var_dump($respuesta);exit;
        $datos = [
                'titulo'=>"Paciente",
                'data'=>$respuesta['data']
            ];
        $contenido=$this->mostrar('pacientes/mostrar.php',$datos,true);
        $data = [
            'titulo'=>'Paciente',
            'contenido'=>$contenido,
            'msg'=>$msg
        ];

        $this->mostrar('template.php',$data);
    }

    //listar presupuesto

    public function listarProsupuesto(){
        
        require_once './modelo/Presupuesto.php';
        
        $obj= new Presupuesto();

        $respuesta = $obj->listar();

        $msg = $respuesta['msg'];
        # var_dump($respuesta);exit;
        $datos = [
                'titulo'=>"Paciente",
                'data'=>$respuesta['data']
            ];
        $contenido=$this->mostrar('pacientes/misPresupuestos.php',$datos,true);
        $data = [
            'titulo'=>'Paciente',
            'contenido'=>$contenido,
            'msg'=>$msg
        ];

        $this->mostrar('template.php',$data);
    }
    public function listar01(){

        $obj= new Paciente();

        $respuesta = $obj->listar01();

        $msg = $respuesta['msg'];
       # var_dump($respuesta);exit;
        $datos = [
                'titulo'=>"Paciente",
                'data'=>$respuesta['data']
            ];
        $contenido=$this->mostrar('pacientes/excel.php',$datos,true);
        $data = [
            'titulo'=>'Paciente',
            'contenido'=>$contenido,
            'msg'=>$msg
        ];

        $this->mostrar('template.php',$data);

    }
    public function buscarxDNI(){
        $dni = $_GET['dni'];
        $obj= new Persona();
        $data = $obj->buscarXDni($dni);
        if (is_null($data))
            echo "0";
        else
            echo json_encode($data);
    }
    public function nuevoPresupuesto(){
        $id = $_GET['id'];  #id de Paciente
        echo "Nuevo presupuesto para ".$id;
    }
    public function misPresupuestos(){
        require_once './modelo/Comprobante.php';
        $id = $_GET['id'];  #id de Paciente
        $obj = new Comprobante();
        $respuesta = $obj->getPresupuestosXPaciente($id);
        $estadisticas = $obj->getEstadisticasXPaciente($id);
        $msg = $respuesta['msg'];

        $datos = [
                'titulo'=>"Presupuestos",
                'data'=>$respuesta['data'],
                'estadisticas'=>$estadisticas['data']
            ];
            $contenido=$this->mostrar('pacientes/misPresupuestos.php',$datos,true);
            $data = [
                'titulo'=>'Presupuestos',
                'contenido'=>$contenido,
                'msg'=>$msg
            ];

        $this->mostrar('template.php',$data);

    }
    public function getServiciosOdontologicos(){
        require_once './modelo/Servicio.php';
        $id = $_GET['id'];  #id de Paciente
        $nombre = $_GET['n'];  #nombre de Paciente
        $obj = new Servicio;
        $respuesta = $obj->listar();

        $msg = $respuesta['msg'];

        $datos = [
                'titulo'=>"Presupuestos",
                'id'=>$id,
                'nombre'=>$nombre,
                'data'=>$respuesta['data']
            ];
        $contenido=$this->mostrar('pacientes/serviciosOdontologicos.php',$datos,true);
        $data = [
            'titulo'=>'Presupuestos',
            'contenido'=>$contenido,
            'msg'=>$msg
        ];

        $this->mostrar('template.php',$data);
    }
    public function generarTicket(){
        //echo "POST<br>";
        //var_dump($_POST);
        //echo "<br>GET<br>";
       // var_dump($_GET);
       $id = $_GET['idPaciente'];
        require_once './modelo/Comprobante.php';
       
        $obj = new Comprobante(null,$id,0,$_POST['ppto']);

        $obj->nuevo($_POST);
        //echo "echo";
        header("Location:?ctrl=CtrlPaciente&accion=misPresupuestos&id=$id");

    }
}