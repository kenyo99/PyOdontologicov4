<?php 
$hoy = getdate();
$dia = substr("0".$hoy['mday'], -2);  // returns "abcde"

$fecha = $hoy['year']."-".$hoy['mon']."-".$dia;
?>
<script>

document.addEventListener('DOMContentLoaded', function() {
  let myModal = new bootstrap.Modal(document.getElementById('myModal'));
  let myForm = document.getElementById('myForm');

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        //locales: 'all',
        locale: 'es',
        initialDate: '<?=$fecha?>',
        initialView: 'timeGridWeek',
        //timeZone: 'local',
        selectable: true,
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      //right: 'timeGridWeek'
    },
    // events: 'http://localhost/calendarjs/eventos.php',
    events: '?ctrl=CtrlCita&accion=citasFull01',
    

    dateClick: function(info) {
      // alert('Click en ' + info.dateStr);
      document.getElementById('fecha_inicio').value = info.dateStr;
      myModal.show();

    },
    /* select: function(info) {
      alert('Seleccionado ' + info.startStr + ' hasta ' + info.endStr);
    } */
  });

  calendar.render();

    myForm.addEventListener('submit',function (e) {
      e.preventDefault();

         const url ='?ctrl=CtrlCita&accion=reservarCita';
        const http = new XMLHttpRequest();
        http.open('POST',url,true);
        http.send(new FormData(myForm));
        http.onreadystatechange = function () {
          if (this.readyState==4 && this.status == 200){
           // console.log(this.responseText);
           calendar.refetchEvents();
            myModal.hide();

          } 
          } 
      })
  });

       

    </script>
<div id="calendar"></div>

<div class="modal" id="myModal"  tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Registrar Nueva Cita</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  <form id="myForm" class="form-horizontal">
		<div class="form-group">
			<label for="evento" class="col-sm-12 control-label">Motivo de la Cita</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="evento" id="evento" placeholder="Nombre del Evento" required/>
			</div>
		</div>
    <div class="form-group">
      <label for="fecha_inicio" class="col-sm-12 control-label">Fecha / Hora</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio" placeholder="Fecha Inicio">
      </div>
    </div>



	   <div class="modal-footer">
      	<button type="submit" class="btn btn-success">Guardar Evento</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
    	</div>
	</form>
      
    </div>
  </div>
</div>


