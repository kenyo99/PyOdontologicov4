<?php
 $nombre =  isset($paciente['nombre'])?$paciente['nombre']:'';
 $apellido =  isset($paciente['apellido'])?$paciente['apellido']:'';

?>
<h1><?=$titulo?></h1>
<?php require_once './vistas/plantilla/dashboard.php'; ?>

<h1>Paciente: <?=$nombre?> <?=$apellido?></h1>
<a href="#" class="btn btn-success nuevaHistoria">
    <i class="fa fa-plus-circle"></i> 
    Nuevo Registro
</a>
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a href="#" class="btn btn-success reporte">
        <i class="fas fa-download fa-sm text-white-50"></i> 
        Generar Reportes XLSX
    </a>
    <H1> </H1>
    <a href="#" class="btn btn-danger reporte">
        <i class="fas fa-download fa-sm text-white-50"></i> 
        Descarga PDF
    </a>
</div>

<br>

<table class="table table-striped table-hover">
    <tr>
        <th>Id</th>
        <th>Fecha de Atención</th>
        <th>Atendido Por</th>
        <th>Observaciones</th>
        

        <th colspan="3"><center>Opciones</center></th>
    </tr>
<?php
    if (is_array($data))
    foreach ($data as $d) { ?>
    <tr>
        <td><?=$d['idhistorias_clinicas']?></td>
        <td><?=$d['fecha']?></td>
        <td><?=$d['nomDoctor']?> <?=$d['apeDoctor']?></td>
        <td><?=$d['observaciones']?></td>

        <td>
            <a data-id="<?=$d["idhistorias_clinicas"]?>" class=" btn btn-success editarHistoria" href="#" title="Editar">
                <i class="fa-solid fa-pencil"></i>
            </a>

            <a data-id="<?=$d["idhistorias_clinicas"]?>" data-nombre="<?=$d["nomPaciente"]?>" class=" btn btn-danger eliminar" href="#" title="Eliminar">
                <i class="fa fa-trash"></i>
            </a>
        
            <a data-id="<?=$d["idhistorias_clinicas"]?>" data-nombre="<?=$d["nomPaciente"]?>" class="btn btn-primary enviar" href="#" title="Enviar Al Correo">
                <i class="fa-regular fa-share-from-square"></i>
            </a>
            </td>
        
    </tr>

<?php    }
?>
    

</table>
<br>
<a href="?">Retornar</a>

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

   $('.nuevaHistoria').click( function(){ 
            let linkNuevo=$(this).html();
            // alert(linkNuevo)
            $(this).html('<i class="fa fa-spinner"></i> Cargando...');
            $('.modal-title').html('Nuevo Registro');
            $.ajax({
                url:'index.php',
                type:'get',
                data:{'ctrl':'<?=isset($_GET['ctrl'])?$_GET['ctrl']:''?>','idPaciente':'<?=$_GET['id']?>','accion':'nuevo'}
            }).done(function(datos){
                $('.nuevaHistoria').html(linkNuevo);
                $('#body-form').html(datos);
                $('#modal-form').modal('show');
            }).fail(function(){
                $('.nuevaHistoria').html(linkNuevo);
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