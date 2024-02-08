<?php
$paciente = isset($data)?$data[0]['nombre']. " ". $data[0]['apellido']:'';
$id = isset($data)?$data[0]['idpersonas']:'';

?>
<h1><?=$titulo?></h1>

<h3>Paciente: <?=$paciente?></h3>

<a href="?ctrl=CtrlPaciente&accion=getServiciosOdontologicos&id=<?=$id?>&n=<?=$paciente?>" class="btn btn-success">
    <i class="fa fa-plus-circle"></i> 
    Nuevo Presupuesto
</a>


<div class="d-grid gap-2 d-md-flex justify-content-md-end">
  
    <a class="btn btn-success" href="./vistas/pacientes/excel.php"> 
        <i class="fa-solid fa-file-arrow-down"></i>
        Descargar en Excel  
    </a>

</div>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Numero</th>
            <th>Fecha</th>
            <th>Total</th>
            <th colspan="2">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if (is_array($data))
            foreach ($data as $d) { ?>
            <tr>
                <td><?=$d['idpago']?></td>
                <td><?=$d['numero']?></td>
                <td><?=$d['fecha']?></td>
                <td><?=$d['total']?></td>

                <td>
                    <a data-id="<?=$d["idpago"]?>" class="btn btn-primary editar" href="#" title="Ver Detalles">
                        <i class="fa-solid fa-pencil"></i>  </a>
                </td>
                
            </tr>
        
        <?php } ?>
    </tbody> 

    </table>
    <br>
    <a class="btn btn-light" onclick="location.href='.mostrar'">
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
            <p>Cargando...</p>
        </div>
        
     </div>
    </div>
</div>
<!-- Modal Formulario - Nuevo / Editar -->
<div class="modal fade" id="modal-formPersona" role="dialog">
    <div class="modal-dialog">
 
     <!-- Modal content-->
     <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-titlePersona"></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-bodyPersona" id="body-formPersona">
            <p>Cargando...</p>
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
                <a type="button" class="btn btn-danger" id="btn-confirmar" href="" data-id="">Aceptar</a>
            </div>
        </div>
    </div>
</div>