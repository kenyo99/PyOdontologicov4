<?php
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename = archivo.xls");
?>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Dni</th>
            <th>Direccion</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Tipo</th>
            
           
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
                <td><?=$d['dni']?></td>
                <td><?=$d['direccion']?></td>
                <td><?=$d['telefono']?></td> 
                <td><?=$d['correo']?></td> 
                <td><?=$d['tipo']?></td>  
                

                <td>
                    <a data-id="<?=$d["idpersonas"]?>" class="btn btn-primary editar" href="#">
                        <i class="fa-solid fa-pencil"></i> Editar </a>
            
                    <a class="btn btn-danger" href="?ctrl=CtrlHistorias&id=<?=$d["idpersonas"]?>">
                        <i class="fa-solid fa-landmark"></i> Historia </a>
                    
                    <a class="btn btn-warning" href="?ctrl=CtrlHistorias&id=<?=$d["idpersonas"]?>">
                        <i class="fa-regular fa-credit-card"></i> Prespuesto
                    </a>
                </td>
                
            </tr>
        
        <?php } ?>
    </tbody> 

    </table>