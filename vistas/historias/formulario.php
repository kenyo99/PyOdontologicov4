<?php
require_once './assets/Helper.php';

$id = isset ($data['idhistorias_clinicas'])?$data['idhistorias_clinicas']:"";
$observacion = isset ($data['observaciones'])?$data['observaciones']:"";
$alergias = isset ($data['alergias'])?$data['alergias']:"";
$alergias = isset ($data['enfermedades'])?$data['enfermedades']:"";
$fecha = isset ($data['fecha'])?$data['fecha']:"";
$gestacion = isset ($data['gestacion'])?$data['gestacion']:"";
$iddoctor = isset ($data['iddoctor'])?$data['iddoctor']:"";
$idpaciente = isset ($data['idpaciente'])?$data['idpaciente']:"";
$presion = isset ($data['presion'])?$data['presion']:"";
$sensibilidad = isset ($data['sensibilidad'])?$data['sensibilidad']:"";
$temperatura = isset ($data['temperatura'])?$data['temperatura']:"";
$fecha_nacimiento = isset ($data['fecha_nacimiento'])?$data['fecha_nacimiento']:"";
$direccion = isset ($data['direccion'])?$data['direccion']:"";
$sexo = isset ($data['sexo'])?$data['sexo']:"";
$tipo = isset ($data['tipo'])?$data['tipo']:"";
$dni = isset ($data['dni'])?$data['dni']:"";
$telefono = isset ($data['telefono'])?$data['telefono']:"";

$edad = Helper::getEdad($fecha_nacimiento);


$editar = ($id != '')?1:0;  # 1: Editar / 0: Nuevo

# $titulo = ($editar==1)?'Editar Estado':'Nuevo Estado';

?>
    
    <form action="?ctrl=CtrlHistorias&accion=guardar" method="post">
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
                <input type="text" class="form-control" name="id" value=<?=$id?>>
                Nombre: 
                <span id="nombre"><?=$nombre?></span>
            </div>
            <div class="col">
                Apellido: 
                <span id="nombre"><?=$apellido?></span>
            </div>
        </div>
        <div class="row">
            <div class="col">
                Edad: <span id="edad"><?=$edad?></span>
                
            </div>
            <div class="col">
                Nº Telefono: 
                <span id="telefono"><?=$telefono?></span>
            </div>
        </div>
        <div class="row">
            <div class="col">
                Sexo: 
                 <span id="telefono"><?=$sexo?></span>
            </div>
            <div class="col">
                Direccion: 
                 <span id="direccion"><?=$direccion?></span>
            </div>
        </div>
        <div class="row">
            <div class="col">
                Enfermedad: 
                <input class="form-control" type="text" name="enfermedad" value="<?=$enfermedad?>">
            </div>
            <div class="col">
                Alergias: 
                <input class="form-control" type="text" name="alegias" value="<?=$alergias?>">
            </div>
        </div>
        <div class="row">
            <div class="col">
                Sensibilidad-Medicamentos: 
                <input class="form-control" type="text" name="sensibilidad" value="<?=$sensibilidad?>">
            </div>
            <div class="col">
                <br>
                Presión: 
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="inlineCheckbox1" name="presion">
                    <label class="form-check-label" for="inlineCheckbox1">A</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="inlineCheckbox2" name="presion">
                    <label class="form-check-label" for="inlineCheckbox2">B</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="inlineCheckbox2" name="presion">
                    <label class="form-check-label" for="inlineCheckbox2">N</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                Gestación: 
                <input class="form-control" type="text" name="gestacion" value="<?=$gestacion?>">
            </div>
            <div class="col">
                Temperatura: 
                <input class="form-control" type="text" name="temperatura" value="<?=$temperatura?>">
            </div>
        </div>
        <br>
        <input class="form-control btn btn-success" type="submit" value="Guardar">
    </form>

    <a href="?ctrl=CtrlTrabajador">Retornar</a>
