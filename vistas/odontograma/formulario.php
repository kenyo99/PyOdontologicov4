<?php
    $id = isset ($data['idpersonas'])?$data['idpersonas']:"";
    $nombre = isset ($data['nombre'])?$data['nombre']:"";
    $apellido = isset ($data['apellido'])?$data['apellido']:"";
    $colegiatura = isset ($data['colegiatura'])?$data['colegiatura']:"";
   /*  $clave = isset ($data['clave'])?$data['clave']:""; */

$editar = ($id != '')?1:0;  # 1: Editar / 0: Nuevo

# $titulo = ($editar==1)?'Editar Estado':'Nuevo Estado';

?>
    
    <form action="?ctrl=CtrlPersonal&accion=guardar" method="post">
        id: <input class="form-control" type="text" name="id" value="<?=$id?>" readonly>
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar por DNI..."
                aria-label="Search" aria-describedby="basic-addon2" id="txtBuscar">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                Nombre: 
                <input class="form-control" type="text" name="nombre" value="<?=$nombre?>" required>
            </div>
            <div class="col">
                Apellido: 
                <input class="form-control" type="text" name="apellido" value="<?=$apellido?>">
            </div>
        </div>
        <div class="row">
            <div class="col">
                Colegiatura:
                <input type="text" class="form-control" name="dni" value="<?=$colegiatura?>" required>
            </div>
            <div class="col">
                Cargo: <br>
                <input type="radio" name="cargo" value='1' required> ADMINISTRADOR <br>
                <input type="radio" name="cargo" value='2' required> DOCTOR <br>
                <input type="radio" name="cargo" value='3' required > ASISTENTE <br>
            </div>
        </div>
        <br>
        <input class="form-control btn btn-success" type="submit" value="Guardar">
    </form>

    <a href="?ctrl=CtrlTrabajador">Retornar</a>
