<?php
$id = isset ($data['idpagos'])?$data['idpagos']:"";
$forma = isset ($data['forma'])?$data['forma']:"";

$editar = ($id != '')?1:0;  # 1: Editar / 0: Nuevo

# $titulo = ($editar==1)?'Editar forma':'Nuevo forma';

?>
    
    <form action="?ctrl=CtrlFormaPago&accion=guardar" method="post">
        id: <input class="form-control" type="text" name="id" value="<?=$id?>" readonly>
        <br>
        Nombre: <input class="form-control" type="text" name="nombre" value="<?=$forma?>">
        <br>
        <input class="form-control btn btn-success" type="submit" value="Guardar">
    </form>

    <a href="?ctrl=CtrlFormaPago">Retornar</a>
