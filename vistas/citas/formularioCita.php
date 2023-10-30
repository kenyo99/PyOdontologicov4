<?php
date_default_timezone_set('America/Lima');

$ahora = time();
$unDiaEnSegundos = 24 * 60 * 60;
$manana = $ahora + $unDiaEnSegundos;
$hasta = $ahora + $unDiaEnSegundos*5;
#var_dump(date("d-m-Y",$manana));exit;

    $id = isset ($data['idpersonas'])?$data['idpersonas']:"";
    /* $nombre = isset ($data['nombre'])?$data['nombre']:"";
    $apellido = isset ($data['apellido'])?$data['apellido']:""; */
    $fecharec = isset ($data['fecharec'])?$data['fecharec']:date("Y-m-d",$manana);
    $desde=date("Y-m-d",$ahora);
    $hasta=date("Y-m-d",$hasta);
    
    $idpaciente = isset ($data['idpeciente'])?$data['idpeciente']:"";
    $idpersonal = isset ($data['idpersonal'])?$data['idpersonal']:"";
    $observaciones = isset ($data['observaciones'])?$data['observaciones']:"";
    $idestados = isset ($data['idestados'])?$data['idestados']:"";

$editar = ($id != '')?1:0;  # 1: Editar / 0: Nuevo

# $titulo = ($editar==1)?'Editar Estado':'Nuevo Estado';

?>
    
    <form action="?ctrl=CtrlCita&accion=guardar" method="post">
        id: <input class="form-control" type="text" name="id" value="<?=$id?>" readonly>
        <div class="row">
            <div class="col">
                Nombre: 
                <input readonly class="form-control" type="text" name="nombre" value="<?=$_SESSION['nombre']?>">
            </div>

        </div>
        <div class="row">
            <div class="col">
                Filtrar Fecha: 
                <input class="form-control" type="date" 
                    name="fecharec" value="<?=$fecharec?>"
                    min="<?=$desde?>" max="<?=$hasta?>">
            </div>
            <div class="col">
                Horarios Disponibles:
                <select class="btn btn-success btn-sm dropdown-toggle" name="hora" >
                    <option value="8:00">8:00 a 9:00</option>
                    <option value="9:00">9:00 a 10:00</option>
                    <option value="10:00">10:00 a 11:00</option>
                    <option value="11:00">11:00 a 12:00</option>
                    <option value="13:00">13:00 a 14:00</option>
                    <option value="14:00">14:00 a 15:00</option>
                    <option value="15:00">15:00 a 16:00</option>
                    <option value="16:00">16:00 a 15:00</option>
                    
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col">
                Tema de Consulta: 
                <input class="form-control" type="text" name="evento" value="<?=$observaciones?>">
            </div>
        </div>
        <br>
        <input class="form-control btn btn-success" type="submit" value="Guardar">
    </form>

    <a href="?ctrl=CtrlCita">Retornar</a>
