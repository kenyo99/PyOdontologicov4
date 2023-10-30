<?php
$id = isset ($data['iddientes'])?$data['iddientes']:"";
$ubicacion = isset ($data['ubicacion'])?$data['ubicacion']:"";
$nombre = isset ($data['nombre'])?$data['nombre']:"";

$editar = ($id != '')?1:0;  # 1: Editar / 0: Nuevo

# $titulo = ($editar==1)?'Editar Estado':'Nuevo Estado';

?>
    
    <form action="?ctrl=CtrlDiente&accion=guardar" method="POST">
        id: <input class="form-control" type="text" name="id" value="<?=$id?>" readonly>
        <br>
        Ubicacion: <input class="form-control" type="text" name="ubicacion" value="<?=$ubicacion?>">
        <br>
        Nombre: <input class="form-control" type="text" name="nombre" value="<?=$nombre?>">
        <br>
        <input class="form-control btn btn-success" type="submit" value="Guardar">
    </form>

    <a href="?ctrl=CtrlTrabajador">Retornar</a>
