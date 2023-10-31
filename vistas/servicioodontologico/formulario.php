<?php
    $id = isset ($data['idservicio'])?$data['idservicio']:"";
    $nombre = isset ($data['nombre'])?$data['nombre']:"";
    $descripcion = isset ($data['descripcion'])?$data['descripcion']:"";
    $precio = isset ($data['precio'])?$data['precio']:"";
    
   /*  $clave = isset ($data['clave'])?$data['clave']:""; */

$editar = ($id != '')?1:0;  # 1: Editar / 0: Nuevo

# $titulo = ($editar==1)?'Editar Estado':'Nuevo Estado';

?>
<style>
    .titulo{
        color: black;
    }
</style>
    
    <form action="?ctrl=CtrlServicioOdontologico&accion=guardar" method="post">
        <input class="form-control" type="text" id="id" name="id" value="<?=$id?>" hidden>
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar Servicio..."
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
                <input class="form-control" id="nombre" type="text" name="nombre" value="<?=$nombre?>" >
            </div>
            <div class="col">
                Descripción: 
                <input class="form-control" id="descripcion" type="text" name="descripcion" value="<?=$descripcion?>" >
            </div>
        </div>
        <div class="row">
            <div class="col">
                Precio:
                <input type="text" class="form-control" id="precio" name="precio" value="<?=$precio?>" placeholder="S/.">
            </div>
            
        </div>
        <br>
        
        <button class="form-control btn btn-success" type="submit"> 
            <i class="fa-solid fa-floppy-disk"></i> Guardar</button>
          
        

        
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