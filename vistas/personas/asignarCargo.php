<form action="?ctrl=CtrlPersona&accion=guardarCargo" method="post">

    <input class="form-control" type="text" name="id" value="<?=$id?>" readonly>
Número de Colegiatura:
<input class="form-control" type="text" name="colegiatura">
<br>
 Cargo: <br>
        <input type="radio" name="cargo" value='1' required> ADMINISTRADOR <br>
        <input type="radio" name="cargo" value='2' required> DOCTOR <br>
        <input type="radio" name="cargo" value='3' required > ASISTENTE <br>

    <input class="form-control btn btn-success" type="submit" value="Cambiar">
</form>