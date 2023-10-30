<?php
$hoy     = date("d-m-Y");
$diasSemana = [
  'Dom.','Lun.','Mar.','Mie.','Jue.','Vie.','Sab.'
  
];
# $inicio     = date('d/m/Y',mktime(0, 0, 0, date("m")  , date("d")+1, date("Y")));


$inicio= date("d-m-Y",strtotime($hoy."+ 1 days"));

$fin        = date("d-m-Y",strtotime($inicio."+ 6 days")); 
$datos=[];
while ($inicio < $fin){
  $datos[$inicio]=[
    ''
  ];
}
?>
<h1>Separe su Cita:</h1>
<div class="content">
<?php
while($inicio < $fin) {
?>

  <div class="row">
    <div class="col-3">

      <?=$diasSemana[(date('w',strtotime($inicio)))];
      ?>
      <?=$inicio?>
      <br>
      <?=date("d-m-Y",strtotime($data[0]['fecha']))?>
      <?=date("h:i",strtotime($data[0]['fecha']))?>

    </div>
    <?php 
    for ($i=8; $i <= 16; $i++) { 
      ?>
  <div class="col-1">
      <button class="btn">
        <?="$i:00"?>
        <br>
        Libre
      </button>
    </div>
      <?php
    }
    ?>

    
    </div>
<?php
  $inicio= date("d-m-Y",strtotime($inicio."+ 1 days"));
}
?>
</div>