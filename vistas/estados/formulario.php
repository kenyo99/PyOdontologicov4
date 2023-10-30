<?php
$id = isset ($data['idestados'])?$data['idestados']:"";
$estado = isset ($data['nombre'])?$data['nombre']:"";

$editar = ($id != '')?1:0;  # 1: Editar / 0: Nuevo

# $titulo = ($editar==1)?'Editar Estado':'Nuevo Estado';

?>
    
    <form action="?ctrl=CtrlEstado&accion=guardar" method="post">
        id: <input class="form-control" type="text" name="id" value="<?=$id?>" readonly>
        <br>
        Nombre: <input class="form-control" type="text" name="nombre" value="<?=$estado?>">
        <br>
        <input class="form-control btn btn-success" type="submit" value="Guardar">
    </form>

    <a href="?ctrl=CtrlEstado">Retornar</a>
