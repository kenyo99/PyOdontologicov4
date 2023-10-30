<?php
    $id = isset ($data['idpersonas'])?$data['idpersonas']:"";
    $nombre = isset ($data['nombre'])?$data['nombre']:"";
    $apellido = isset ($data['apellido'])?$data['apellido']:"";
    $fecharec = isset ($data['fecharec'])?$data['fecharec']:"";
    $idpaciente = isset ($data['idpeciente'])?$data['idpeciente']:"";
    $idpersonal = isset ($data['idpersonal'])?$data['idpersonal']:"";
    $observaciones = isset ($data['observaciones'])?$data['observaciones']:"";
    $idestados = isset ($data['idestados'])?$data['idestados']:"";

$editar = ($id != '')?1:0;  # 1: Editar / 0: Nuevo

# $titulo = ($editar==1)?'Editar Estado':'Nuevo Estado';

?>
    
    <form action="?ctrl=CtrlAgregarCita&accion=guardar" method="post">
        id: <input class="form-control" type="text" name="id" value="<?=$id?>" readonly>
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
                Filtrar Fecha: 
                <input class="form-control" type="Date" name="fecharec" value="<?=$fecharec?>">
            </div>
            <div class="col">
                Horarios Disponibles:
                <select class="btn btn-success btn-sm dropdown-toggle" name="cars" id="cars">
                    <option value="volvo">8:00 a 9:00</option>
                    <option value="saab">9:00 a 10:00</option>
                    <option value="mercedes">10:00 a 11:00</option>
                    <option value="audi">11:00 a 12:00</option>
                    <option value="audi">13:00 a 14:00</option>
                    <option value="audi">14:00 a 15:00</option>
                    <option value="audi">15:00 a 16:00</option>
                    <option value="audi">16:00 a 15:00</option>
                    
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col">
                Nombre del Dr.: 
                <input class="form-control" type="text" name="correo" value="<?=$idpersonal?>">
            </div>
            <div class="col">
                Tema de Consulta: 
                <input class="form-control" type="text" name="observaciones" value="<?=$observaciones?>">
            </div>
        </div>
        <br>
        <input class="form-control btn btn-success" type="submit" value="Guardar">
    </form>

    <a href="?ctrl=CtrlTrabajador">Retornar</a>
