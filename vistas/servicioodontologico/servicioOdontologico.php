<center><h1><?=$titulo?></h1></center>

<a href="#" class="btn btn-success nuevo">
    <i class="fa fa-plus-circle"></i> 
    Nuevo Servicio
</a>

<table class="table table-striped table-hover">
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
       
        <th colspan="2">Opciones</th>
    </tr>
<?php
    if (is_array($data))
    foreach ($data as $d) { ?>
    <tr>
        <td><?=$d['idservicio']?></td>
        <td><?=$d['nombre']?></td>
        <td><?=$d['descripcion']?></td>
        <td>S/.<?=$d['precio']?></td>

        <td>
            <a data-id="<?=$d["idservicio"]?>" class="btn btn-primary editar" href="#" title="Editar">
                <i class="fa-solid fa-pencil"></i>  </a>
             
            <a data-id="<?=$d["idservicio"]?>" data-nombre="<?=$d["nombre"]?>" class="btn btn-danger eliminar" href="#" title="Eliminar">
                <i class="fa fa-trash"></i>  </a>
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
