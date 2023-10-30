<?php
session_start();
require_once './core/Controlador.php';
require_once './modelo/Trabajador.php';
# require_once './modelo/Persona.php';
class CtrlTrabajador extends Controlador{
    public function index(){
        echo "Hola trabajador";
    }
    public function validar(){
        # echo "Validando ingreso....";
        $this->verificarLogin();
        $obj= new Trabajador();
        $data = $obj->validar($_GET['id']);

        if ($data['data']==null){
            # echo "Trabajador no encontrado";
            # $obj= new Persona();

            $this->mostrarDashboardCliente();

        }else {
            $_SESSION['tipo']= $data['data'][0]['tipo'];
            $_SESSION['id']= $data['data'][0]['idpersonas'];
            $this->mostrarDashboard();
        }
        
    }
    public function mostrarDashboard(){
        # $contenido = $this->mostrar('plantilla/home.php','',true);
        $_SESSION['menu']=$this->getMenuTrabajador();

        $data = [
            
            'titulo'=>'Sistema Odontológico',
            'contenido'=>$this->mostrar('plantilla/home.php','',true)
        ];
        $this->mostrar('template.php',$data);
    }
    public function mostrarDashboardCliente(){
        # $contenido = $this->mostrar('plantilla/home.php','',true);
        $_SESSION['menu']=[
            
            # 'CtrlAgregarCita'=>'Nueva Cita',
            'CtrlCita&accion=citasPorPaciente'=>'Agendar Cita',
            'CtrlCita'=>'Calendario de Citas',
            'CtrlServicio'=>'Otros Servicios',
            'CtrlPerfil'=>'Mi Perfil',
        ];
        $data = [
            
            'titulo'=>'Sistema Odontológico',
            'contenido'=>$this->mostrar('plantilla/homePaciente.php','',true)
        ];
        $this->mostrar('template.php',$data);
    }
    private function getMenuTrabajador(){
        $tipo = isset($_SESSION['tipo'])?$_SESSION['tipo']:'';
        switch ($tipo) {
            case 'DOCTOR':
                $menu=[
                    
                    "CtrlPaciente"=>"Lista de Pacientes",
                    "CtrlCita&accion=citasFull"=>"Mis Citas",
                    "CtrlPresupuesto"=>"Nuevo Presupuesto",
                    "CtrlDiente"=>"Registro de Dientes",
                    "CtrlEstado_dental"=>"Estado Dental",
                    "CtrlPerfil"=>"Mi Perfil",

                    ];
                break;
            
            default:    # Para el ADMINISTRADOR
                $menu=[
                    # "CtrlPrincipal"=>"Inicio",
                    "CtrlHistorias"=>"Historias clinicas",
                    "CtrlOdontograma"=>"Odontogramas",
                    "CtrlEstado"=>"Estados",
                    "CtrlPersona"=>"Registro Personas",
                    "CtrlPaciente"=>"Aregar Paciente",
                    "CtrlPersonal"=>"Registro de Personal",
                    "CtrlFormaPago"=>"Formas de Pago",
                    "CtrlSexo"=>"Sexo",
                    "CtrlDiente"=>"Dientes",
                    "CtrlEstado_dental"=>"Estado Dental",
                    "CtrlServicio"=>"Servicios Odontologicos",
                    "CtrlCita"=>"Agendar cita",
                    "CtrlPerfil"=>"Perfil",

                    ];
                break;
                
        }
        return $menu;
    }
    private function verificarLogin(){
        if (!isset($_SESSION['usuario'])){
            header("Location: ?");
            exit();
        }
    }
}