<?php
require_once './assets/Helper.php';

$id = isset ($data['idhistorias_clinicas'])?$data['idhistorias_clinicas']:"";
$observacion = isset ($data['observaciones'])?$data['observaciones']:"";
$alergias = isset ($data['alergias'])?$data['alergias']:"";
$enfermedades = isset ($data['enfermedades'])?$data['enfermedades']:"";
$fecha = isset ($data['fecha'])?$data['fecha']:"";
$gestacion = isset ($data['gestacion'])?$data['gestacion']:"";
$iddoctor = isset ($data['iddoctor'])?$data['iddoctor']:"";

$idpaciente = isset ($data['idpaciente'])?$data['idpaciente']:$_GET['idPaciente'];

$presion = isset ($data['presion'])?$data['presion']:"";
$sensibilidad = isset ($data['sensibilidad'])?$data['sensibilidad']:"";
$temperatura = isset ($data['temperatura'])?$data['temperatura']:"";

// Datos de paciente
$fecha_nacimiento = isset ($paciente['fecha_nacimiento'])?$paciente['fecha_nacimiento']:"";
$direccion = isset ($paciente['direccion'])?$paciente['direccion']:"";
$sexo = isset ($paciente['sexo'])?$paciente['sexo']:"";
$tipo = isset ($paciente['tipo'])?$paciente['tipo']:"";
$dni = isset ($paciente['dni'])?$paciente['dni']:"";

$telefono = isset ($paciente['telefono'])?$paciente['telefono']:"";

$nombre = isset ($paciente['nombre'])?$paciente['nombre']:"";
$apellido = isset ($paciente['apellido'])?$paciente['apellido']:"";

/* $fecha_nacimiento = isset ($data['fecha_nacimiento'])?$data['fecha_nacimiento']:"";
$direccion = isset ($data['direccion'])?$data['direccion']:"";
$sexo = isset ($data['sexo'])?$data['sexo']:"";
$tipo = isset ($data['tipo'])?$data['tipo']:"";
$dni = isset ($data['dni'])?$data['dni']:"";

$telefono = isset ($data['telefono'])?$data['telefono']:"";

$nombre = isset ($_GET['nombre'])?$_GET['nombre']:'';
$apellido = isset ($_GET['apellido'])?$_GET['apellido']:''; */

$edad = Helper::getEdad($fecha_nacimiento);


$editar = ($id != '')?1:0;  # 1: Editar / 0: Nuevo

# $titulo = ($editar==1)?'Editar Estado':'Nuevo Estado';

?>
    
    <form action="?ctrl=CtrlHistorias&accion=guardar" method="post">
        <!-- <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar por DNI..."
                aria-label="Search" aria-describedby="basic-addon2" id="txtBuscar">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div> -->

        <div class="row">
            <div class="col">
                <input type="text" hidden class="form-control" name="id" value="<?=$id?>">
                <input type="text" hidden class="form-control" name="idPaciente" value="<?=$idPaciente?>">
                <b> Nombre: </b>
                <span id="nombre"><?=$nombre?></span>
            </div>
            <div class="col">
                <b> Apellido: </b>
                <span id="nombre"><?=$apellido?></span>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <b> Edad: </b><span id="edad"><?=$edad?></span>
                
            </div>
            <div class="col">
                <b> Nº Telefono: </b>
                <span id="telefono"><?=$telefono?></span>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <b> Sexo: </b>
                 <span id="sexo"><?=$sexo?></span>
            </div>
            <div class="col">
                <b> Direccion: </b>
                 <span id="direccion"><?=$direccion?></span>
            </div>
        </div>
        <br>
        <div class="row">
                <div class="col">
                    Fecha de Atención: 
                    <input class="form-control" type="date" 
                        name="fecharec" value="<?=$fecharec?>"
                        min="<?=$desde?>" max="<?=$hasta?>">
                </div>
             
                <div class="col">
                    Observaciones:
                    <input class="form-control" type="text" name="observaciones" value="<?=$observacion?>">
                </div>

        </div>
        <div class="row">
            <div class="col">
                Enfermedad: 
                <input class="form-control" type="text" name="enfermedades" value="<?=$enfermedades?>">
            </div>
            <div class="col">
                Alergias: 
                <input class="form-control" type="text" name="alergias" value="<?=$alergias?>">
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
                    <label class="form-check-label" for="inlineCheckbox1" value='alta'>A</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="inlineCheckbox2" name="presion">
                    <label class="form-check-label" for="inlineCheckbox2" value='Baja'>B</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="inlineCheckbox2" name="presion">
                    <label class="form-check-label" for="inlineCheckbox2" value='N'>N</label>
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
