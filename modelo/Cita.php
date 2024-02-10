<?php
require_once './core/Modelo.php';
class Cita extends Modelo{
    private $_id;
    private $_fecha;
    private $_estado;
    private $_paciente;
    private $_observaciones;
    private $_personal;


    private $_tabla = 'citas';
    # private $_vista = 'v_cita';
    private $_vista = 'v_cita01';

    public function __construct($id=null, $fecha=null
                                , $paciente=null, $obs = null 
                               , $estado=1
                    ){
        $this->_id = $id;
        $this->_estado = $estado;
        $this->_fecha = $fecha;
        $this->_paciente = $paciente;
        $this->_personal = 2;
        $this->_observaciones = $obs;

        parent::__construct($this->_tabla);

    }
    public function listar(){
        return $this->getAll();
    }
    public function getOne(){
        return $this->getBy('idcitas',$this->_id);
    }
    /*public function eliminar(){
        return $this->deleteBy('iddientes',$this->_id);
    } */

    public function nuevo(){
        $datos = array(
            "fecha"=>"'$this->_fecha'",
            "observaciones"=>"'$this->_observaciones'",
            "idestados"=>"'$this->_estado'",
            "idpaciente"=>"'$this->_paciente'",
            "idpersonal"=>"'$this->_personal'",
            
        );
         $this->insert($datos);
         /* Generar Ticket */
         return $this->generarTicket();

         

    }
    private function generarTicket(){
        /** Insertamos en Comprobante Pago */
        $sql = "Select getNumeroTicket() as numero";
        $this->setSql($sql);
        $nroTicket = $this->ejecutarSql()['data'][0]['numero'];
        // echo $nroTicket;exit;

        $sql ="Insert into comprobante_pago
                (numero, fecha,idcomprobante,idtipo_comprobantes,idpagos,
                idpersonas, idpersonas1)
                VALUES 
                ('$nroTicket', CURRENT_TIMESTAMP(), 0, 0, 0,
                '$this->_paciente', '$this->_personal')
            ";

            $this->setSql($sql);
            $this->ejecutarSql();
        /** Insertamos en Detalle Comprobante Pago */
        $sql = "Select idpago from comprobante_pago where numero='$nroTicket'";
        $this->setSql($sql);
        $nroComprobante = $this->ejecutarSql()['data'][0]['idpago'];
        // Recuperamos el PRECIO
        $sql = "Select precio from servicios_odontologicos where idservicio=0";
        $this->setSql($sql);
        $precio = $this->ejecutarSql()['data'][0]['precio'];
        // Insertamos el detalle
        $sql = "Insert into detalles_comprobante 
                (cantidad, idpago, idservicio, precio)
                VALUES
                (1, $nroComprobante, 0, $precio)
            ";
        $this->setSql($sql);
        $this->ejecutarSql();
        /** actualizar en total en Comprobante Pago */
        $sql = "Update comprobante_pago set total=$precio where idpago=$nroComprobante";
        $this->setSql($sql);
        $this->ejecutarSql();
        // Retornar el NÚMERO DE TICKET
        //return $nroTicket;
        $sql ="Select idcitas from citas where idpaciente=$this->_paciente order by fecha desc limit 1";
        $this->setSql($sql);
        $idCitas = $this->ejecutarSql()['data'][0]['idcitas'];
        // Actualizamos o ENLAZAMOS las citas con el comprobante de pago.
        $sql = "Update citas set idpago=$nroComprobante where idcitas=$idCitas";
        $this->setSql($sql);
        $this->ejecutarSql();

        $sql = "Select * from v_ticketsPago where idpago=$nroComprobante";
        $this->setSql($sql);
        return $this->ejecutarSql()['data'][0];
    }
    public function editar(){
        $datos = array(
            "nombre"=>"'$this->_estado'"
        );
        
        $wh = "idestados = $this->_id";

        return $this->update($wh, $datos);


    }
    public function TraerCitas(){
        $hoy = getdate();
        $sql = "Select * from v_cita01 ORDER BY fecha DESC LIMIT 0, 9 ";
        # var_dump($sql);exit;
        $this->_sql->setSQL($sql);

        return $this->_bd->ejecutar($this->_sql);
    }

    public function getCitas(){
        $hoy = getdate();
        $sql = "Select * from ". $this->_vista 
            . " where fecha > '".$hoy['year']."-".$hoy['mon']."-".$hoy['mday']."'";
        # var_dump($sql);exit;
        $this->_sql->setSQL($sql);

        return $this->_bd->ejecutar($this->_sql);
    }
    public function getCitasForJSON(){
        $hoy = getdate();
        $sql = "Select 
                idcitas as id, fecha as start,
                fin as end,
                observaciones as title from ". $this->_vista 
            . " where fecha > '".$hoy['year']."-".$hoy['mon']."-".$hoy['mday']."'";
        # var_dump($sql);exit;
        $this->_sql->setSQL($sql);

        return $this->_bd->ejecutar($this->_sql);
    }
    public function listarPorPaciente($idPaciente){
        $sql = "Select * from ". $this->_vista 
        . " where idpaciente = $idPaciente order by fecha desc limit 0,6";

        $this->_sql->setSQL($sql);
        
        return $this->ejecutarSql();
    }
    public function getEstidisticaXPaciente($id){
        $sql = "Select * from v_estadisticas_citas where idpaciente=$id";

        $this->_sql->setSQL($sql);
        
        return $this->ejecutarSql();
    }

}