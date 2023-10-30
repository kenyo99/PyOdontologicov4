<?php
$id = isset ($data['idestado_dental'])?$data['idestado_dental']:"";
$icono = isset ($data['icono'])?$data['icono']:"";
$descripcion = isset ($data['descripcion'])?$data['descripcion']:"";
$color = isset ($data['color'])?$data['color']:"";

$editar = ($id != '')?1:0;  # 1: Editar / 0: Nuevo

# $titulo = ($editar==1)?'Editar Estado':'Nuevo Estado';

?>
    
    <form action="?ctrl=CtrlEstado_dental&accion=guardar" method="post">
        id: <input class="form-control" type="text" name="id" value="<?=$id?>" readonly>
        <br>
        Ingresar Imagen: <input class="form-control" type="file" name="icono" value="<?=$icono?>">
        <br>
        Descripcion: <input class="form-control" type="text" name="descripcion" value="<?=$descripcion?>">
        <br>
        Color: <input class="form-control" type="text" name="color" value="<?=$color?>">
        <br>
        <input class="form-control btn btn-success" type="submit" value="Guardar">
    </form>

    <a href="?ctrl=CtrlTrabajador">Retornar</a>
