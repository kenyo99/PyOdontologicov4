
<h1><?=$titulo?> para <span id="paciente"><?=$nombre?></span></h1>


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





<div class="d-grid gap-2 d-md-flex justify-content-md-end">
  
    <a class="btn btn-success" href="#" id="descargar"> 
        <i class="fa-solid fa-file-arrow-down"></i>
        Descargar  
    </a>

</div>
<div class="content">
    <div class="row">
        <div class="col-7">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        
                        <th>Id</th>
                        <th>Servicio</th>
                        <!-- <th>Descripcion</th> -->
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th colspan="2">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (is_array($data))
                        foreach ($data as $d) { ?>
                        <tr id="miFila">
                            
                            <td><?=$d['idservicio']?></td>
                            <td><b>
                                <?=$d['nombre']?>
                                </b><br>
                                <?=$d['descripcion']?>
                            </td>
                            <td><?=$d['precio']?></td>
                            <td width="100"><input type="number" value="1" min="1" class="form-control"></td>

                            <td>
                                <button type="button" id="addPpto" class="btn btn-outline-info">Agregar</button>
                                
                                
                                
                            </td>
                            
                        </tr>
                    
                    
                    
                    <?php } ?>
                    
                </tbody>          
            </table>
        </div>
    
        <div class="col-5">
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
                                <td colspan="4" align="right">
                                    <b>
                                    Total Ppto:
                                    </b>
                                </td>
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

   


    <script>
        let suma = 0.00;
$(document).ready(function (){	
    
    $('#descargar').click(function (e) { 
        e.preventDefault();
        let doc = new jsPDF();
        doc.setFontSize(20)
        doc.setTextColor(255, 0, 0) // Rojo
        doc.text(40,40,"Proforma de Presupuesto")
        doc.setFontSize(14)
        doc.setTextColor(0, 0, 0) // Rojo
        doc.text(40,50,"Paciente: "+ $('#paciente').text())
        let now = new Date();
        doc.setFontSize(10)
        doc.text(180,25,now.toLocaleDateString());

         doc.autoTable({  
        html: '#miPresupuesto',  
        startY: 70,  
        theme: 'grid',  
        /* columnStyles: {  
            0: {  
                cellWidth: 180,  
            },  
            1: {  
                cellWidth: 180,  
            },  
            2: {  
                cellWidth: 180,  
            }  
        },  
        styles: {  
            minCellHeight: 40  
        }   */
    })  
    doc.save('Presupuesto.pdf'); 


        /* doc.html($('#miPresupuesto'), {
            callback: function (doc) {
            doc.save('Presupuesto.pdf');
            },
            margin: [60, 60, 60, 60],
            x: 32,
            y: 50,
        }); */

    });

    $("[id*='addPpto']").click(function(e) {
        var trSel=$(this).closest("[id*='miFila']");	
        /* var chk = trSel.find('input[type="checkbox"]').is(":checked"); */
        /* if (chk){ */
            /* alert('Esta habilitado') */
            let id=trSel.children().eq(0);
            let servicio=trSel.children().eq(1);
            let precio=trSel.children().eq(2);
            var cantidad = trSel.find('input[type="number"]').val();

            agregarFila(id.text(),servicio.html(),precio.text(),cantidad)

            trSel.addClass('agregado');
        /* }else{
            alert('Primero habilite para poder agregarlo')
        } */
    });

});

function agregarFila(id,servicio,precio,cantidad){
    let p = parseFloat(precio).toFixed(2)
    let total = p * cantidad
    total = total.toFixed(2);
    var nuevaFila = '<tr id="ppto">'+
        '<td>' + id + '</td>'+
        '<td>' + servicio + '</td>'+
        '<td>' + p + '</td>'+
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

