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
            [
                'url'=>'CtrlCita&accion=citasPorPaciente',
                'title'=>'Agendar Cita',
                'icon'=>'fa-solid fa-pencil'
            ],
            /* [
                'url'=>'CtrlCita',
                'title'=>'Calendario de Citas',
                'icon'=>'fa-regular fa-credit-card'
            ], */
            [
                'url'=>'CtrlServicio&acccion=listar',
                'title'=>'Otros Servicios',
                'icon'=>'fa-brands fa-servicestack'
            ],
            [
                'url'=>'CtrlPerfil',
                'title'=>'Mi Perfil',
                'icon'=>'fa-solid fa-user'
            ],
            
           
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

                    [
                        'url'=>'CtrlPaciente&accion=listar',
                        'title'=>'Lista de Pacientes',
                        'icon'=>'fa-solid fa-pencil'
                    ],
                    [
                        'url'=>'CtrlCita&accion=citasFull',
                        'title'=>'Mis Citas',
                        'icon'=>'fa-regular fa-calendar-check'
                    ],
                    [
                        'url'=>'CtrlServicioOdontologico&accion=listar',
                        'title'=>'Agregar servicios',
                        'icon'=>'fa-brands fa-servicestack'
                    ],
                    [
                        'url'=>'CtrlDiente&accion=listar',
                        'title'=>'Registro de Dientes',
                        'icon'=>'fa-solid fa-tooth'
                    ],
                    [
                        'url'=>'CtrlEstado_dental&accion=listar',
                        'title'=>'Estado Dental',
                        'icon'=>'fa-solid fa-teeth'
                    ],
                    [
                        'url'=>'CtrlPerfil&accion=listar',
                        'title'=>'Mi Perfil',
                        'icon'=>'fa-solid fa-user'
                    ],

                    
                    /*"CtrlPaciente"=>"Lista de Pacientes",
                    "CtrlCita&accion=citasFull"=>"Mis Citas",
                    "CtrlPresupuesto"=>"Nuevo Presupuesto",
                    'CtrlServicioOdontologico'=>'Agregar servicios',
                    "CtrlDiente"=>"Registro de Dientes",
                    "CtrlEstado_dental"=>"Estado Dental",
                    "CtrlPerfil"=>"Mi Perfil",*/

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