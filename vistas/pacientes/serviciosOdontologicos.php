
<h1><?=$titulo?></h1>
<h3>
    Para: <b><span id="paciente"><?=$nombre?></span></b>
</h3>


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


<div class="content">
    <div class="row">
        <div class="col-7">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        
                        <th>Id</th>
                        <th>Servicio</th>
                        <th>Precio S/.</th>
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
                    <form id="miPpto" action="?ctrl=CtrlPaciente&accion=generarTicket&idPaciente=<?=$id?>" method="post">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-info" title="Generar Ticket">
                                <i class="fa-solid fa-file-arrow-down"></i>
                                Generar Ticket
                            </button>
                            
                            <a class="btn btn-danger" href="#" id="descargar" title="Descargar PDF"> 
                                <i class="fa-solid fa-file-arrow-down"></i>
                                Descargar pdf  
                            </a>
    
                        </div>
                    
                    <table id="miPresupuesto" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Precio S/.</th>
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
                                    <input id="totalPpto1" hidden value="0" name="ppto">
                                    </b>
                                </td>
                                <td>
                                    <span id="total"></span>
                                </td>
                
                            </tr>
                        </tfoot>
                    </table>
                    </form>

        </div>
    </div>
    
</div>

    <a class="btn btn-info" href="?ctrl=CtrlPaciente&accion=listar">
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
        doc.text(60,30,"Proforma de Presupuesto")

        doc.setFontSize(14)
        doc.setTextColor(0, 0, 0) // Rojo
        doc.text(15,40,"Paciente: "+ $('#paciente').text())
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
    let precio2 = parseFloat(precio).toFixed(2)
    let total = precio2 * cantidad
    total = total.toFixed(2);
    var nuevaFila = '<tr id="ppto">'+
        '<td>' + id + 
        '<input name="id[]" type="text" hidden value="'+id+'">' +
        '<input name="cantidad[]" type="text" hidden value="'+cantidad+'">' +
        '<input name="precio[]" type="text" hidden value="'+precio2+'">' +
        '</td>'+
        '<td>' + servicio + '</td>'+
        '<td>' + precio2 + '</td>'+
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

        $('#totalPpto1').val(sum)
        

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
        $('#totalPpto1').val(sum)
        
    });

}



</script>

