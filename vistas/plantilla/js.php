
<!-- 
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
 -->

 
<script type="text/javascript">
  $(function () {
     
   'use strict'
        let msg='<?=$msg['titulo']?>';
        
        toastr.success(msg)

        if(msg!=''){
            let icono = (msg=='Error')?'error':'success';
            $.toast({
                heading: msg,
                text: '<?=$msg['cuerpo']?>',
                icon: icono,
                position: 'top-right',
                showHideTransition: 'plain',
                // bgColor: 'green',
                    textColor: 'white',
                    hideAfter: 2000
            });
        }
   
        $("#txtBuscar").keyup(function (e) { 
            e.preventDefault();
            let clave= $("#txtBuscar").val().trim();
            if (clave){
                $("table").find('tbody tr').hide();

                $('table tbody tr').each(function(){
                    let nombres=$(this).children().eq(1);
                    let apellidos=$(this).children().eq(2);
                    let dni=$(this).children().eq(3);
                    if (
                      nombres.text().toUpperCase().includes(clave.toUpperCase())
                      ||
                      apellidos.text().toUpperCase().includes(clave.toUpperCase())
                      ||
                      dni.text().toUpperCase().includes(clave.toUpperCase())

                      ){
                        $(this).show();
                    }
                });
            }else{
                $("table").find('tbody tr').show();

            }
        });
        
        $('.nuevo').click( function(){ 
            let linkNuevo=$(this).html();
            // alert(linkNuevo)
            $(this).html('<i class="fa fa-spinner"></i> Cargando...');
            $('.modal-title').html('Nuevo Registro');
            $.ajax({
                url:'index.php',
                type:'get',
                data:{'ctrl':'<?=isset($_GET['ctrl'])?$_GET['ctrl']:''?>','accion':'nuevo'}
            }).done(function(datos){
                $('.nuevo').html(linkNuevo);
                $('#body-form').html(datos);
                $('#modal-form').modal('show');
            }).fail(function(){
                $('.nuevo').html(linkNuevo);
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
        $('.asignarCargo').click( function(e){ 
          e.preventDefault();
           let linkNuevo=$(this).html();
            // alert('Cambiando')
            var id= $(this).data('id');
            var nombre= $(this).data('nombre');

            $(this).html('<i class="fa fa-spinner"></i> Cargando...');

            $('.modal-title').html('Cargo para: '+nombre);
            $.ajax({
                url:'index.php',
                type:'get',
                data:{'ctrl':'<?=isset($_GET['ctrl'])?$_GET['ctrl']:''?>','accion':'asignarCargo','id':id}
            }).done(function(datos){
                $(this).html(linkNuevo)
                $('#body-form').html(datos);

                $('#modal-form').modal('show');
            }).fail(function(){
                $(this).html(linkNuevo)
                alert("error");
            });
            $(this).html(linkNuevo)
        });
        $('#cambiarClave').click( function(e){ 
          e.preventDefault();
           // let linkNuevo=$(this).html();
            // alert('Cambiando')
            $(this).html('<i class="fa fa-spinner"></i> Cargando...');
            $('.modal-title').html('Cambiar Clave');
            $.ajax({
                url:'index.php',
                type:'get',
                data:{'ctrl':'<?=isset($_GET['ctrl'])?$_GET['ctrl']:''?>','accion':'showCambiarClave'}
            }).done(function(datos){
                // $('.nuevo').html(linkNuevo);
                $('#body-form').html(datos);
                $('#modal-form').modal('show');
            }).fail(function(){
                // $('.nuevo').html(linkNuevo);
                alert("error");
            });
        });
        $('.editar').click( function(){ 
            var id= $(this).data('id');
            $('.modal-title').html('Editando el Reg.: '+id);
            $.ajax({
                url:'index.php',
                type:'get',
                data:{'ctrl':'<?=isset($_GET['ctrl'])?$_GET['ctrl']:'';?>','accion':'editar','id':id}
            }).done(function(datos){
                $('#body-form').html(datos);
                $('#modal-form').modal('show');
            }).fail(function(){
                alert("error");
            });
        });
        $('.eliminar').click( function(){ 
            var id= $(this).data('id');
            var nombre= $(this).data('nombre');
           
            $('.modal-title').html('<i class="fa fa-trash"></i> Eliminando el Reg.: '+id );
            
            $('.reg-eliminacion').html('Registro: <code>' + nombre +'</code>');
            
            $('#btn-confirmar').attr('href', '?ctrl=<?=isset($_GET['ctrl'])?$_GET['ctrl']:'';?>&accion=eliminar&id='+id);
            
            $('#modal-eliminar').modal('show');
            
        });
        $('.cambiarClave').click( function(){ 
            var id= $(this).data('id');
            var nombre= $(this).data('nombre');
           
            $('.modal-title').html('<i class="fa fa-trash"></i> Restablecer clave');
            
            $('.reg-eliminacion').html('Registro: <code>' + nombre +'</code>');
            
            $('#btn-confirmar').attr('href', '?ctrl=<?=isset($_GET['ctrl'])?$_GET['ctrl']:'';?>&accion=restablecerClave&id='+id);
            
            $('#modal-eliminar').modal('show');
            
        });
        $('#imprimirPDF').click(function (e) { 
            e.preventDefault();
            let link=$(this).html();
            // alert(link)
            $(this).html('<i class="fa fa-spinner"></i> Descargando...');
            var datos= <?=json_encode(isset($data)?$data:'');?>;
            let titulo=$('#titulo').html();
            
            
            var doc = new jsPDF('p')
                 // doc.addImage(logo, 'JPEG', 10, 10,20,22);

                doc.setFontSize(20)
                doc.setTextColor(255, 0, 0) // Rojo
                doc.text(35, 25, titulo)
                let columnas =[]
                columnas.push( Object.keys(datos[0]) )
                
                let data = [] 

                for (let i in datos) {
                    data.push( Object.values(datos[i]));
                    
                }
                
            doc.autoTable({ 
                head: columnas,
                body: data,
                    margin:{top:40}
                })
                
            $('#imprimirPDF').html(link);
            doc.save(titulo)
            
        });

        $('.imprimirCita').click(function(){
            var id= $(this).data('id');
            let fecha;
            let detalle;
            let estado;
            let paciente;
            let doctor;
           //  alert(id)
            $('table tbody tr').each(function(){
                      let item=$(this).children().eq(0);
                      
                      if (item.text() == id){
                        
                        fecha=$(this).children().eq(1);
                        detalle=$(this).children().eq(2);
                        estado=$(this).children().eq(3);
                        paciente=$(this).children().eq(4);
                        doctor=$(this).children().eq(5);
                      } 
                    });
                    // alert(detalle.text())
            
            var doc = new jsPDF('p')
                
                doc.setFontSize(20)
                doc.setTextColor(0, 0, 255) // azul
                doc.setFontType("bold")
                doc.text(100, 25, 'Citas')

                doc.setFontType("normal")
                doc.setTextColor(0, 0, 0) 
                doc.setFontSize(12)

                /* doc.text(40, 40, 'Paciente : ')
                doc.text(70, 40, paciente.text())
 */
                dibujaFila (doc, 40,40, 'Paciente : ',paciente.text())

                dibujaFila (doc, 40,50, 'Fecha y hora: ',fecha.text())

                dibujaFila (doc, 40,60, 'Servicio : ',detalle.text())

                dibujaFila (doc, 40,70, 'Doctor : ',doctor.text())

                dibujaFila (doc, 40,80, 'Estado : ',estado.text())

                /* doc.text(40, 50, 'Fecha y hora: ' )
                doc.text(70, 50, fecha.text()) */
                
                /*doc.text(40, 60, 'Servicio : ' )
                doc.text(70, 60, detalle.text())

                doc.text(40, 70, 'Doctor : ')
                doc.text(70, 70, doctor.text())

                doc.text(40, 80, 'Estado : ')
                doc.text(70, 80, estado.text())*/
                

              doc.save('citas.pdf')
              //doc.autoPrint()
              /* global jsPDF 
              // You'll need to make your image into a Data URL
              // Use http://dataurl.net/#dataurlmaker
              var imgData =

              var doc = new jsPDF();

              doc.setFontSize(40);
              doc.text("Octonyan loves jsPDF", 35, 25);
              doc.addImage(imgData, "JPEG", 15, 40, 180, 180);

              // Set the document to automatically print via JS
              doc.autoPrint();*/

        });
        function dibujaFila(doc, x, y, titulo, texto){
          doc.text(x, y, titulo)
          doc.text(x+30, y, texto)
          // Dibuja la lineas - Grilla
          doc.line(x-4,y-4,x+150,y-4)
          doc.line(x-4,y-4,x-4,y+3)

          doc.line(x-4,y+3,x+150,y+3)
          doc.line(x+150,y-4,x+150,y+3)



        }

$("#calendar").fullCalendar({
    header: {
      left: "prev,next today",
      center: "title",
      right: "month,agendaWeek,agendaDay"
    },

    locale: 'es',
    
    defaultView: "month",
    navLinks: true, 
    editable: true,
    eventLimit: true, 
    selectable: true,
    selectHelper: false,

  //Nuevo Evento
    select: function(start, end){
        $("#exampleModal").modal();
        $("input[name=fecha_inicio]").val(start.format('DD-MM-YYYY'));
        
        var valorFechaFin = end.format("DD-MM-YYYY");
        var F_final = moment(valorFechaFin, "DD-MM-YYYY").subtract(1, 'days').format('DD-MM-YYYY'); //Le resto 1 dia
        $('input[name=fecha_fin').val(F_final);  

      },
        
      events: [
        <?php
        if (isset($data))
        if (is_array($data))
        foreach ($data as $d) { ?>
            {
            _id: '<?=$d['idcitas']; ?>',
            title: '<?=$d['observaciones']; ?>',
            start: '<?=$d['fecha']; ?>',
            end:   '<?=$d['fin']; ?>',
            color: 'yellow'
            },
          <?php } ?>
      ],


  //Eliminar Evento
  eventRender: function(event, element) {
      element
        .find(".fc-content")
        .prepend("<span id='btnCerrar'; class='closeon material-icons'>&#xe5cd;</span>");
      
      //Eliminar evento
      element.find(".closeon").on("click", function() {

    var pregunta = confirm("Deseas Borrar este Evento?");   
    if (pregunta) {

      $("#calendar").fullCalendar("removeEvents", event._id);

      $.ajax({
              type: "POST",
              url: 'deleteEvento.php',
              data: {id:event._id},
              success: function(datos)
              {
                $(".alert-danger").show();

                setTimeout(function () {
                  $(".alert-danger").slideUp(500);
                }, 3000); 

              }
          });
        }
      });
    },


  //Moviendo Evento Drag - Drop
  eventDrop: function (event, delta) {
    var idEvento = event._id;
    var start = (event.start.format('DD-MM-YYYY'));
    var end = (event.end.format("DD-MM-YYYY"));

      $.ajax({
          url: 'drag_drop_evento.php',
          data: 'start=' + start + '&end=' + end + '&idEvento=' + idEvento,
          type: "POST",
          success: function (response) {
          // $("#respuesta").html(response);
          }
      });
  },

  //Modificar Evento del Calendario 
  eventClick:function(event){
      var idEvento = event._id;
      $('input[name=idEvento').val(idEvento);
      $('input[name=evento').val(event.title);
      $('input[name=fecha_inicio').val(event.start.format('DD-MM-YYYY'));
      $('input[name=fecha_fin').val(event.end.format("DD-MM-YYYY"));

      $("#modalUpdateEvento").modal();
    },

  });
  
//Oculta mensajes de Notificacion
  setTimeout(function () {
    $(".alert").slideUp(300);
  }, 3000); 


  });
</script>
