<?php
 $nombre =  isset($paciente['nombre'])?$paciente['nombre']:'';
 $apellido =  isset($paciente['apellido'])?$paciente['apellido']:'';

?>
    <center><h1 id="titulo"><?=$titulo?></h1></center>
    
    <a href="#" class="btn btn-success nuevaCita">
        <i class="fa fa-plus-circle"></i> 
        Registrar nueva Cita
    </a>
    <h1>.</h1>
    <table class="table table-striped table-hover">
        <tr>
            <th>Nº</th>
            <th>Fecha de Citas</th>
            <th>Detalle</th>
            <th>Estado</th>
            <th>Nombre Paciente</th>
            <th>Atendido Por:</th>
           
            <th colspan="2">Opciones</th>
        </tr>
    <?php
    $i = 1;
        if (is_array($data))
        foreach ($data as $d) {
            $item = $i++;
        ?>
        <tr>
            <td><?=$item?></td>
            <td><?=$d['fecha']?></td>
            <td><?=$d['observaciones']?></td>
            <td><?=$d['NomEstado']?></td>
            <td><?=$d['NomPaciente']?> <?=$d['ApePaciente']?></td>
            <td>Dr. <?=$d['NomPersonal']?></td>

            <td>
                <a data-id="<?=$item?>" class="btn btn-danger imprimirCita" href="#" title="Descargar">
                <i class="fas fa-download fa-sm text-white-50"></i>  </a>

                <a data-id="<?=$d["idcitas"]?>" class="btn btn-success editar" href="#" title="Editar">
                    <i class="fa-solid fa-pencil"></i>  </a>
            </td>
            
        </tr>
    
    <?php    }
    ?>
        

    </table>
    <br>
    <a class="btn btn-light" href="?ctrl=CtrlPaciente&accion=listar">
        <i class="fa-solid fa-rotate-left"></i>
        Retornar
    </a>

    <!-- Modal Formulario - Nuevo / Editar -->
<div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog">
 
     <!-- Modal content-->
     <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" id="body-form">
    
        </div>
        
     </div>
    </div>
</div>
<!-- Modal Eliminar -->
<div class="modal fade" id="modal-eliminar" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="frm-eliminar"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="body-eliminar">
                <div class="text-center">
                    <h5>¿Estas seguro que deseas seguir con la eliminación?</h5>
                    <h5 class="reg-eliminacion">Registro: </h5>
                </div>
            </div>
            <div class="modal-footer justify-content-between">            
                <button type="button" class="btn btn-secundary" data-dismiss="modal">Cancelar</button>
                <a type="button" class="btn btn-danger" id="btn-confirmar" href="" data-id="">Eliminar</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $(function () {
     
   'use strict';

   $('.nuevaCita').click( function(){ 
            let linkNuevo=$(this).html();
            // alert(linkNuevo)
            $(this).html('<i class="fa fa-spinner"></i> Cargando...');
            $('.modal-title').html('Nuevo Registro');
            $.ajax({
                url:'index.php',
                type:'get',
                data:{'ctrl':'<?=isset($_GET['ctrl'])?$_GET['ctrl']:''?>','idpaciente':'<?=$_GET['id']?>','accion':'nuevo'}
            }).done(function(datos){
                $('.nuevaCita').html(linkNuevo);
                $('#body-form').html(datos);
                $('#modal-form').modal('show');
            }).fail(function(){
                $('.nuevaCita').html(linkNuevo);
                alert("error");
            });
        });

        $('.editarHistoria').click( function(){ 
            var id= $(this).data('id');
            $('.modal-title').html('Editando el Reg.: '+id);
            $.ajax({
                url:'index.php',
                type:'get',
                data:{'ctrl':'<?=isset($_GET['ctrl'])?$_GET['ctrl']:'';?>','accion':'editar','id':id,'idPaciente':'<?=$_GET['id']?>'}
            }).done(function(datos){
                $('#body-form').html(datos);
                $('#modal-form').modal('show');
            }).fail(function(){
                alert("error");
            });
        });
  });
</script>
