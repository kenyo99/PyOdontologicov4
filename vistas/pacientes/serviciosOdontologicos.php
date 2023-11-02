
<h1><?=$titulo?></h1>


<style>
        tr.resaltar td {
            background: #e0e0e0;
        }
        tr.agregado td {
            background: #d0fdd7;
        }
        td .input{
            margin: 0;
        }
       
</style>

<a href="?ctrl=CtrlPaciente&accion=getServiciosOdontologicos&id=<?=$id?>" class="btn btn-success">
    <i class="fa fa-plus-circle"></i> 
    Generar Presupuesto
</a>
<span><b>TOTAL PPTO: </b></span>S/ <span id="total">0.00</span>


<div class="d-grid gap-2 d-md-flex justify-content-md-end">
  
    <a class="btn btn-success" href="./vistas/pacientes/excel.php"> 
        <i class="fa-solid fa-file-arrow-down"></i>
        Descargar en Excel  
    </a>

</div>
<div class="content">
    <div class="row">
        <div class="col-8">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>Id</th>
                        <th>Servicio</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Descripcion</th>
                        <th colspan="2">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (is_array($data))
                        foreach ($data as $d) { ?>
                        <tr id="miFila">
                            <td>
                                <input type="checkbox" class="form-check-label" id="chk" role="switch" value="<?=$d['idservicio']?>">
                                
                            </td>
                            <td><?=$d['idservicio']?></td>
                            <td><?=$d['nombre']?></td>
                            <td>S/.<?=$d['precio']?></td>
                            <td width="100"><input type="number" value="1" min="1" class="form-control"></td>
                            <td><?=$d['descripcion']?></td>

                            <td>
                                <button type="button" id="addPpto" class="btn btn-outline-info">Agregar</button>
                                
                                <a data-id="<?=$d["idservicio"]?>" class="btn btn-primary editar" href="#" title="Editar">
                                    <i class="fa-solid fa-pencil"></i>  
                                </a>
                                
                            </td>
                            
                        </tr>
                    
                    
                    
                    <?php } ?>
                    
                </tbody>          
            </table>
        </div>
    
        <div class="col-4">
                    <h3>Mi Presupuesto</h3>
                    <table id="miPresupuesto" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th width="100">Cant.</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            

                        </thead>
                        <tbody>
                            
                        </tbody>
                        <tfoot>
                            <tr id="totalPpto">
                                <td colspan="4">Total Ppto:</td>
                                <td>
                                    <span id="total"></span>
                                </td>
                
                            </tr>
                        </tfoot>
                    </table>

        </div>
    </div>
    
</div>
    
    <a href="?ctrl=CtrlPaciente&accion=getServiciosOdontologicos&id=<?=$id?>" class="btn btn-success">
        <i class="fa fa-plus-circle"></i> 
        Agregar
    </a>
    <br>
    <a class="btn btn-light" href="?">
        <i class="fa-solid fa-rotate-left"></i>
        Retornar
    </a>

    <!--<div class="content">
        <div class="row">
            <div class="col-8">
                <h3>Servicios</h3>
                <table id="miTabla" class="table">
                    <thead>
                        <tr>
                        <th width="100">#</th>
                        <th width="100">Item</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th width="100">Cant.</th>
                        <th width="150"></th>
                        </tr>
                        

                    </thead>
                    <tbody>
                        <tr id="miFila">
                            <td>
                                <div class="form-check form-switch">
                                    <input type="checkbox" id="chk" class="form-check-input" role="switch">
                                </div>
                            </td>
                            <td>1</td>
                            <td>Extracción</td>
                            <td>50</td>
                            <td><input type="number" value="1" class="form-control"></td>
                            <td><button type="button" id="addPpto" class="btn btn-outline-info">Agregar</button></td>
            
                        </tr>
                        <tr id="miFila">
                            <td>
                                <div class="form-check form-switch">
                                    <input type="checkbox" id="chk" class="form-check-input" role="switch">
                                </div>
                            </td>
                            <td>2</td>
                            <td>Curación</td>
                            <td>30</td>
                            <td>
                                
                                <input type="number" value="1" class="form-control">
                                
                               
                            </td>
                            <td><button type="button" id="addPpto" class="btn btn-outline-info">Agregar</button></td>
                        </tr>
                        <tr id="miFila">
                            <td>
                                <div class="form-check form-switch">
                                    <input type="checkbox" id="chk" class="form-check-input" role="switch">
                                </div>
                            </td>
                            <td>3</td>
                            <td>Endondoncia</td>
                            <td>180</td>
                            <td><input type="number" value="1" class="form-control"></td>
                            <td><button type="button" id="addPpto" class="btn btn-outline-info">Agregar</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <h3>Mi Presupuesto</h3>
                <table id="miPresupuesto" class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th width="100">Cant.</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        

                    </thead>
                    <tbody>
                        
                    </tbody>
                    <tfoot>
                        <tr id="totalPpto">
                            <td colspan="4">Total Ppto:</td>
                            <td>
                                <span id="total"></span>
                            </td>
            
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>-->
    
    
    <script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>

    <script>
        let suma = 0.00;
$(document).ready(function (){	
    

    $("[id*='chk']").click(function(e) {
		var trSel=$(this).closest("[id*='miFila']");		
		var chk = $(this).is(":checked");
		if(chk){				
			trSel.addClass('resaltar');

		}else{
			trSel.removeClass('resaltar');
			trSel.removeClass('agregado');
		}
		

	});

    $("[id*='addPpto']").click(function(e) {
        var trSel=$(this).closest("[id*='miFila']");	
        var chk = trSel.find('input[type="checkbox"]').is(":checked");
        if (chk){
            /* alert('Esta habilitado') */
            let id=trSel.children().eq(1);
            let servicio=trSel.children().eq(2);
            let precio=trSel.children().eq(3);
            var cantidad = trSel.find('input[type="number"]').val();

            agregarFila(id.text(),servicio.text(),precio.text(),cantidad)

            trSel.addClass('agregado');
        }else{
            alert('Primero habilite para poder agregarlo')
        }
    });

});

function agregarFila(id,servicio,precio,cantidad){
    let total = precio * cantidad
    total = total.toFixed(2);
    var nuevaFila = '<tr id="ppto">'+
        '<td>' + id + '</td>'+
        '<td>' + servicio + '</td>'+
        '<td>' + precio + '</td>'+
        '<td>' + cantidad + '</td>'+
        '<td class="subtotal">' + total + '</td>'+
        '<td> <button type="button" id="retirarPpto" class="btn btn-outline-danger" title="Retirar">-</button></td>'
      '</tr>';
      

   $('#miPresupuesto tbody').append(nuevaFila);
   
   let sum = 0
        $('.subtotal').each(function() {
            sum += parseFloat($(this).text());
        });

        $('#total').html(sum.toFixed(2)) 
        

   $("[id*='retirarPpto']").on('click',function() {

        var trSel=$(this).closest("[id*='ppto']");	
        /* var subTotal = trSel.children().eq(4);
        console.log(subTotal.text())
        suma -= parseFloat(subTotal.text()); */
        trSel.remove();
        let sum = 0
        $('.subtotal').each(function() {
            sum += parseFloat($(this).text());
        });

        $('#total').html(sum.toFixed(2))  
    });

}


</script>

