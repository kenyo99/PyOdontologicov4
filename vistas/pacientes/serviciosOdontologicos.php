<?php


?>
<h1><?=$titulo?></h1>



<a href="?ctrl=CtrlPaciente&accion=getServiciosOdontologicos&id=<?=$id?>" class="btn btn-success">
    <i class="fa fa-plus-circle"></i> 
    Generar Presupuesto
</a>
<span><b>TOTAL PPTO: </b></span>S/ <span id="total">0.00</span>


<div class="d-grid gap-2 d-md-flex justify-content-md-end">
  
    <a class="btn btn-success" href="./vistas/pacientes/excel.php"> 
        <i class="fa-solid fa-file-arrow-down"></i>
        Descargar en Excel  
    </a>

</div>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th></th>
            <th>Id</th>
            <th>Servicio</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th colspan="2">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if (is_array($data))
            foreach ($data as $d) { ?>
            <tr>
                <td>
                    <input type="checkbox" class="lista" value="<?=$d['idservicio']?>">
                </td>
                <td><?=$d['idservicio']?></td>
                <td><?=$d['nombre']?></td>
                <td><?=$d['descripcion']?></td>
                <td><input type="number" value="1" min="1"></td>
                <td><?=$d['precio']?></td>

                <td>
                    <a data-id="<?=$d["idservicio"]?>" class="btn btn-primary editar" href="#" title="Agregar">
                        <i class="fa-solid fa-pencil"></i>  </a>
                </td>
                
            </tr>
        
        <?php } ?>
    </tbody> 

    </table>
    <br>
    <a class="btn btn-light" href="?">
        <i class="fa-solid fa-rotate-left"></i>
        Retornar
    </a>

