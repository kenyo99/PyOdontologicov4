<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/Persona.php';
class CtrlPersona extends Controlador{
    public function index(){
        $this->listar();
    }

    public function guardar(){
        $id=$_POST['id'];
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $dni=$_POST['dni'];
        $direccion=$_POST['direccion'];
        $fechanac=$_POST['fechanac'];
        $telefono=$_POST['telefono'];
        $correo=$_POST['correo'];
        $usuario=$_POST['usuario'];
        $sexo=$_POST['sexos'];
        /* $clave=$_POST['clave']; */
        #var_dump($sexo);exit;
        $obj= new Persona($id, $nombre, $apellido,$dni
            ,$direccion,$fechanac,$telefono,$correo,$usuario,$sexo);
        #var_dump($obj); exit;
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
        $obj= new Persona($id);
        $miObj = $obj->getOne()['data'];
        
        # var_dump($miObj);exit;
        $datos = array(
            'data'=>$miObj[0]
        );
        # var_dump($datos);exit;
        $this->mostrar('personas/formulario.php',$datos);
    }
    public function eliminar(){

        $id = $_GET['id'];
        $obj= new Persona($id);

        $respuesta = $obj->eliminar();

        $this->listar();

    }
    public function nuevo(){
        $this->mostrar('personas/formulario.php');
    }

    public function listar(){

        $obj= new Persona();

        $respuesta = $obj->listar();

        $msg = $respuesta['msg'];
        # var_dump($respuesta);exit;
        $datos = [
                'titulo'=>"Persona",
                'data'=>$respuesta['data']
            ];
        $contenido=$this->mostrar('personas/mostrar.php',$datos,true);
        $data = [
            'titulo'=>'Persona',
            'contenido'=>$contenido,
            'msg'=>$msg
        ];

        $this->mostrar('template.php',$data);

    }
    public function login(){
        #echo "Validando ingreso....";
        
        $obj= new Persona();
        $data = $obj->validarLogin($_POST['email'],$_POST['clave']);
        # var_dump($data);
        if ($data['data']==null){
            echo "Usuario no encontrado";
        }else {
            # var_dump($data['data']);
            $_SESSION['usuario'] = $data['data'][0]['usuario'];
            $_SESSION['id'] = $data['data'][0]['idpersonas'];
            $_SESSION['nombre'] = $data['data'][0]['nombre']. ' '. $data['data'][0]['apellido'];

            header('location: ?ctrl=CtrlTrabajador&accion=validar&id='.$data['data'][0]['idpersonas']);
        }
        
    }
    public function logout(){
        session_destroy();
        header('location: ?');

    }
    public function restablecerClave(){
        $id = $_GET['id'];
        $obj= new Persona($id);

        $respuesta = $obj->restablecerClave();

        $this->listar();
    }
    public function showCambiarClave(){
        $this->mostrar('personas/cambiarClave.php');
    }
    
    public function cambiarClave(){
        $clave = $_POST['clave'];
        $obj = new Persona;
        $data = $obj->cambiarClave($clave);

    }
    public function asignarCargo(){
        $id = $_GET['id'];
        $datos = [
            'id'=>$id
        ];
        $this->mostrar('personas/asignarCargo.php',$datos);
    }
    public function guardarCargo(){
        require_once './modelo/Personal.php';
        $id = $_POST['id'];
        $cargo = $_POST['cargo'];
        $colegiatura = $_POST['colegiatura'];
        $obj = new Personal($id);
        $obj->guardarCargo($cargo,$colegiatura);
        
        $this->listar();
    }
}