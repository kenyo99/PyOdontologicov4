    <center><h1 id="titulo"><?=$titulo?></h1></center>

    <a href="#" class="btn btn-success nuevo">
        <i class="fa fa-plus-circle"></i> 
        Registrar nueva Cita
    </a>
    <a href="#" class="btn btn-success" id="imprimirPDF">
        <i class="fa fa-plus-circle"></i> 
       Imprimir
    </a>
    <h1>.</h1>
    <table class="table table-striped table-hover">
        <tr>
            <th>Id</th>
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
            <td><?=$d['NomPersonal']?></td>

            <td>
                <a data-id="<?=$item?>" class="btn btn-danger imprimirCita" href="#">
                <i class="fas fa-download fa-sm text-white-50"></i> Descargar </a>

                <a data-id="<?=$d["idcitas"]?>" class="btn btn-success editar" href="#">
                    <i class="fa-solid fa-pencil"></i> Editar </a>
            </td>
            
        </tr>
    
    <?php    }
    ?>
        

    </table>
    <br>
    <a class="btn btn-light" href="?">
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
