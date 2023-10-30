<h1><?=$titulo?></h1>

<a href="#" class="btn btn-success nuevo">
    <i class="fa fa-plus-circle"></i> 
    Asignar Personal
</a>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Colegiatura</th>
            <th>Cargo</th>
           
            <th colspan="2">Opciones</th>
        </tr>
    </thead>
    <tbody>
    <?php
        if (is_array($data))
        foreach ($data as $d) { ?>
        <tr>
            <td><?=$d['idpersonas']?></td>
            <td><?=$d['nombre']?></td>
            <td><?=$d['apellido']?></td>
            <td><?=$d['colegiatura']?></td>
            <td><?=$d['tipo']?></td> 
            

            <td>
                <a data-id="<?=$d["idpersonas"]?>" 
                    class="btn btn-success editar" href="#" title="Editar" >
                    <i class="fa-solid fa-pencil"></i>
                </a>

                <a data-id="<?=$d["idpersonas"]?>" data-nombre="<?=$d["nombre"]?>" 
                    class="btn btn-danger eliminar" href="#" title="Eliminar">
                    <i class="fa fa-trash"></i>
                </a>

                <a data-id="<?=$d["idpersonas"]?>" data-nombre="<?=$d["nombre"]?>" class="btn btn-warning cambiarClave" href="#" title="Restablecer Clave">
                    <i class="fa-solid fa-unlock"></i></a>
                </td>
            </td>
            
        </tr>
    
    <?php    }
    ?>
    </tbody> 

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
