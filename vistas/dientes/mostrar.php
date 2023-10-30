    <h1><?=$titulo?></h1>

    <a href="#" class="btn btn-success nuevo">
        <i class="fa fa-plus-circle"></i> 
        Insertar Nuevo
    </a>
    
    <table class="table table-striped table-hover">
        <tr>
            <th>Id</th>
            <th>Ubicacion</th>
            <th>Nombre</th>
           
            <th colspan="2">Opciones</th>
        </tr>
    <?php
        if (is_array($data))
        foreach ($data as $d) { ?>
        <tr>
            <td><?=$d['iddientes']?></td>
            <td><?=$d['ubicacion']?></td>
            <td><?=$d['nombre']?></td>

            <td>
                <a data-id="<?=$d["iddientes"]?>" class="btn btn-success editar" href="#" title="Editar">
                    <i class="fa-solid fa-pencil"></i> Editar </a>
                
                <a data-id="<?=$d["iddientes"]?>" data-nombre="<?=$d["nombre"]?>" class="btn btn-danger eliminar" href="#" title="Elimnar">
                    <i class="fa fa-trash"></i> Eliminar </a>
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
