<?php
    $id = isset ($data['idpersonas'])?$data['idpersonas']:"";
    $nombre = isset ($data['nombre'])?$data['nombre']:"";
    $apellido = isset ($data['apellido'])?$data['apellido']:"";
    $dni = isset ($data['dni'])?$data['dni']:"";
    $direccion = isset ($data['direccion'])?$data['direccion']:"";
    $fechanac = isset ($data['fecha_nacimiento'])?$data['fecha_nacimiento']:"";
    $telefono = isset ($data['telefono'])?$data['telefono']:"";
    $correo = isset ($data['correo'])?$data['correo']:"";
    $usuario = isset ($data['usuario'])?$data['usuario']:"";
   /*  $clave = isset ($data['clave'])?$data['clave']:""; */

$editar = ($id != '')?1:0;  # 1: Editar / 0: Nuevo

# $titulo = ($editar==1)?'Editar Estado':'Nuevo Estado';

?>
<style>
    .titulo{
        color: black;
    }
</style>
    
    <form action="?ctrl=CtrlPaciente&accion=guardarPaciente" method="post">
        <input class="form-control" type="text" id="id" name="id" value="<?=$id?>" hidden>
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar por DNI..."
                aria-label="Search" aria-describedby="basic-addon2" id="txtDNI">
            <div class="input-group-append">
                <button class="btn btn-success" type="button" id="buscarDNI">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                Nombre: 
                <input class="form-control" id="nombre" type="text" name="nombre" value="<?=$nombre?>" required readonly >
            </div>
            <div class="col">
                Apellido: 
                <input class="form-control" id="apellido" type="text" name="apellido" value="<?=$apellido?>"  required readonly>
            </div>
        </div>
        <div class="row">
            <div class="col">
                Dni:
                <input type="text" class="form-control" id="dni" name="dni" value="<?=$dni?>"  required readonly>
            </div>
            <div class="col">
                Direccion: 
                <input type="text" class="form-control" id="direccion" name="direccion" value="<?=$direccion?>"  required readonly> 
            </div>
        </div>
        <div class="row">
            <div class="col">
            <br>    
            Tipo <br>
                <input type="radio" name="tipo" value='1' required > Niño <br>
                <input type="radio" name="tipo" value='2' required> Adulto <br>
            </div>
        </div>
        <br>
        
        <button class="btn btn-success col-5 mx-auto" type="submit"> 
            <i class="fa-solid fa-floppy-disk"></i> Guardar</button>
          
        <a class="btn btn-danger col-5 mx-auto nuevoPersona" href="#"> 
            <i class="fa fa-plus-circle "> </i> 
            Nuevo Paciente  
        </a>

        
        <!--<input class=" btn btn-success " type="submit" value="Guardar">
        <input class=" btn btn-success" type="submit" value="Guardar">-->
    </form>
        
    <a class="titulo" href="?ctrl=CtrlPaciente">Retornar</a>

    <script>
        $(function () {

           $("#buscarDNI").click(function (e) { 
            e.preventDefault();
            
            let dni = $('#txtDNI').val()

           // alert('Buscando por DNI: ' + dni)
           $.ajax({
                    url:'index.php',
                    type:'get',
                    data:{'ctrl':'<?=isset($_GET['ctrl'])?$_GET['ctrl']:'';?>','accion':'buscarxDNI','dni':dni}
                }).done(function(datos){
                    // let misDatos = datos
                    /* $('#body-form').html(datos); */
                    /* $('#modal-form').modal('show'); */
                    //alert(datos)
                    if (datos!=0){
                    var misDatos =  JSON.parse(datos); 
                    console.log(misDatos)
                    $('#id').val(misDatos[0]['idpersonas'])
                    $('#nombre').val(misDatos[0]['nombre'])
                    $('#apellido').val(misDatos[0]['apellido'])
                    $('#dni').val(misDatos[0]['dni'])
                    $('#direccion').val(misDatos[0]['direccion'])   
                    } else {
                        alert('DNI: '+ dni + '\n No Encontrado!!! \n\n Si desea puede agregar Nuevo Paciente')
                    }                           

                }).fail(function(){
                    alert("error");
                });

           });
           $('.nuevoPersona').click( function(){ 
            let linkNuevo=$(this).html();
            let boton=$(this)
            // alert(linkNuevo)
            $(this).html('<i class="fa fa-spinner"></i> Cargando...');
            $('.modal-titlePersona').html('Nuevo Registro');
            $.ajax({
                url:'index.php',
                type:'get',
                data:{'ctrl':'<?=isset($_GET['ctrl'])?$_GET['ctrl']:''?>','accion':'nuevoPersona'}
            }).done(function(datos){
                 boton.html(linkNuevo);
                $('#body-formPersona').html(datos);
                $('#modal-formPersona').modal('show');
            }).fail(function(){
                 boton.html(linkNuevo);
                alert("error");
            });
        });

        })
    </script>