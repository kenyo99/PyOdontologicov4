<?php
$id = isset ($data['idservicio'])?$data['idservicio']:"";
$nombre = isset ($data['nombre'])?$data['nombre']:"";
$descripcion = isset ($data['descripcion'])?$data['descripcion']:"";
$precio = isset ($data['precio'])?$data['precio']:"";

$editar = ($id != '')?1:0;  # 1: Editar / 0: Nuevo

# $titulo = ($editar==1)?'Editar Estado':'Nuevo Estado';

?>
    
    <form action="?ctrl=CtrlServicio&accion=guardar" method="post">
        id: <input class="form-control" type="text" name="id" value="<?=$id?>" readonly>
        <br>
        Nombre: <input class="form-control" type="text" name="nombre" value="<?=$nombre?>">
        <br>
        Descripcion: <input class="form-control" type="text" name="descripcion" value="<?=$descripcion?>">
        <br>
        Precio: <input class="form-control" type="text" name="precio" value="<?=$precio?>">
        <br>
        <input class="form-control btn btn-success" type="submit" value="Guardar">
    </form>

    <a href="?ctrl=CtrlTrabajador">Retornar</a>
