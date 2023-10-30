<?php
    $id = isset ($data['idpersonas'])?$data['idpersonas']:"";
    $nombre = isset ($data['nombre'])?$data['nombre']:"";
    $apellido = isset ($data['apellido'])?$data['apellido']:"";
    $dni = isset ($data['dni'])?$data['dni']:"";
    $direccion = isset ($data['direccion'])?$data['direccion']:"";
    $fechanac = isset ($data['fechanac'])?$data['fechanac']:"";
    $telefono = isset ($data['telefono'])?$data['telefono']:"";
    $correo = isset ($data['correo'])?$data['correo']:"";
    $usuario = isset ($data['usuario'])?$data['usuario']:"";
    $clave = isset ($data['clave'])?$data['clave']:"";

$editar = ($id != '')?1:0;  # 1: Editar / 0: Nuevo

# $titulo = ($editar==1)?'Editar Estado':'Nuevo Estado';

?>
    
    <form action="?ctrl=CtrlPersona&accion=guardar" method="post">
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
                <input class="form-control" type="text" name="nombre" value="<?=$nombre?>">
            </div>
            <div class="col">
                Apellido: 
                <input class="form-control" type="text" name="apellido" value="<?=$apellido?>">
            </div>
        </div>
        <div class="row">
            <div class="col">
                Dni:
                <input type="text" class="form-control" name="dni" value="<?=$dni?>">
            </div>
            <div class="col">
                Direccion: 
                <input type="text" class="form-control" name="direccion" value="<?=$direccion?>"> 
            </div>
        </div>
        <div class="row">
            <div class="col">
                Fecha Nac: 
                <input class="form-control" type="Date" name="fechanac" value="<?=$fechanac?>">
            </div>
            <div class="col">
                Nº Telefono: 
                <input class="form-control" type="text" name="telefono" value="<?=$telefono?>">
            </div>
        </div>
        <div class="row">
            <div class="col">
                Correo: 
                <input class="form-control" type="text" name="correo" value="<?=$correo?>">
            </div>
            <div class="col">
                Usuario: 
                <input class="form-control" type="text" name="usuario" value="<?=$usuario?>">
            </div>
        </div>
        <div class="row">
            <div class="col">
                Clave: 
                <input class="form-control" type="text" name="clave" value="<?=$clave?>">
            </div>
            <div class="col">
                <br>
                Sexo: <br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                    <label class="form-check-label" for="inlineCheckbox1">Masculino</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                    <label class="form-check-label" for="inlineCheckbox2">Femenino</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                    <label class="form-check-label" for="inlineCheckbox2">Prefiero no Decirlo</label>
                </div>
            </div>
        </div>
        <br>
        <input class="form-control btn btn-success" type="submit" value="Guardar">
    </form>

    <a href="?ctrl=CtrlTrabajador">Retornar</a>
