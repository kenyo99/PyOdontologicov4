<?php
require_once './core/Modelo.php';


class DetalleComprobante extends Modelo{
    
    private $_id;
    private $_precio;
    private $_descuento;
    private $_cantidad;
    private $_igv;
    private $_idPago;
    private $_idServicio;

    /* private $_tipo;  */

    private $_tabla = 'detalles_comprobante';
    // private $_vista = 'v_comprobante00';

    public function __construct($id=null,$precio=0, $descuento=0,$cantidad=1,$igv=0,$idPago=null, $idServicio=null){

                    
        $this->_id = $id;
        $this->_precio = $precio;
        $this->_descuento = $descuento;
        $this->_cantidad = $cantidad;
        $this->_igv = $igv;
        $this->_idPago = $idPago;
        $this->_idServicio = $idServicio;
        /* $this->_tipo = $tipo; */

       parent::__construct($this->_tabla);

    }
    
    public function nuevo(){
  
           $datos = array(
            /* "iddetalles_comprobante"=>"'$this->_id'", */
            "precio"=>"$this->_precio",
            "descuento"=>"$this->_descuento", 
            "cantidad"=>"$this->_cantidad", 
            "igv"=>"$this->_igv", 
            "idpago"=>"$this->_idPago", 
            "idservicio"=>"$this->_idServicio", 
            
        );
        // var_dump($datos);
        return $this->insert($datos);
        
    }

    
    
}