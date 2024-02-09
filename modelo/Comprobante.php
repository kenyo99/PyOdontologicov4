<?php
require_once './core/Modelo.php';
require_once './modelo/DetalleComprobante.php';


class Comprobante extends Modelo{
    
    private $_id;
    private $_idPaciente;
    private $_idPersonal;
    private $_total;
    /* private $_tipo;  */

    private $_tabla = 'comprobante_pago';
    private $_vista = 'v_comprobante00';

    public function __construct($id=null,$idPaciente=null, $idPersonal=null,$total){

                    
        $this->_id = $id;
        $this->_idPaciente = $idPaciente;
        $this->_idPersonal = $idPersonal;
        $this->_total = $total;
        /* $this->_tipo = $tipo; */

       parent::__construct($this->_tabla);

    }
    public function getPresupuestosXPaciente($id){
        $sql = "Select * from v_comprobante00 where idpersonas=$id";
        $this->setSql($sql);
        return $this->ejecutarSql();
    }


    /* public function listar(){
        $this->setTabla($this->_vista);
        return $this->getAll();
    }
    public function getOne(){
        $this->setTabla($this->_vista);
        return $this->getBy('idpersonas',$this->_id);
    } */

    /* public function eliminar(){
        $this->setTabla($this->_tabla);
        $this->deleteBy('idpersonas',$this->_id);
        # var_dump($this->_tabla);exit;
        $this->setTabla('personas');
        parent::eliminar();

    }
    */
    public function nuevo($post){
        /** Insertamos en Comprobante Pago */
        $sql = "Select getNumeroTicket() as numero";
        $this->setSql($sql);
        $nroTicket = $this->ejecutarSql()['data'][0]['numero'];
        // echo $nroTicket;exit;
        $this->setSql(null);


           $datos = array(
            "numero"=>"'$nroTicket'",
            "fecha"=>"CURRENT_TIMESTAMP()",
            "idcomprobante"=>3, // Estado Pendiente de pago
            "idtipo_comprobantes"=>2,   // Boleta
            "idpagos"=>1,   // En Efectivo
            "idpersonas"=>"'$this->_idPaciente'", 
            "idpersonas1"=>"'$this->_idPersonal'",
            "total"=>"$this->_total"
        );
        


         $this->insert($datos);

        $nroComprobante = $this->getComprobanteGenerado($nroTicket);

        $this->setSql(null);

        // Guardamos los Detalles
        //$id=null,$precio=0, $descuento=0,$cantidad=1,$igv=0,$idPago=null, $idServicio=null
        $totalId = count($post['id']);
        // var_dump($i);exit;
        for ($i=0; $i < $totalId; $i++) { 
            # code... 
            $obj = new DetalleComprobante(
                null,$post['precio'][$i],0,$post['cantidad'][$i],0,$nroComprobante,$post['id'][$i]
            );
            $obj->nuevo();
        }
        


    }

    private function getComprobanteGenerado($nroTicket){

        /** Insertamos en Detalle Comprobante Pago */
        $sql = "Select idpago from $this->_tabla where numero='$nroTicket'";
        $this->setSql($sql);
        return $this->ejecutarSql()['data'][0]['idpago'];
    }

   /* public function guardarPaciente($idPersona,$tipo){
        # parent::nuevo();
        $datos = [
            'idpersonas'=>$idPersona,
            'idtipo_paciente'=>"$tipo",
        ];
        # var_dump($datos);exit;
        $this->setTabla('paciente');

        return $this->insert($datos);

    }
    
    public function editar(){
         parent::editar();
        $datos = [
            'idpersonas'=>$this->_id,
            'idtipo_paciente'=>"$this->_tipo",
        ];
        $this->setTabla('paciente');
        $wh = "idpersonas=$this->_id";
        return $this->update($wh,$datos);

    } */
    
    
}