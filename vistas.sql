-----------------------
CREATE VIEW v_personal
AS
SELECT
    personal.idpersonas,
    personal.colegiatura,
    personal.idtipo,
    tipo_personal.tipo
FROM personal
    INNER JOIN tipo_personal ON personal.idtipo = tipo_personal.idtipo
------------------------

create VIEW v_cita as
SELECT
    *,
    addtime(fecha, '00:30:00') as fin
FROM `citas`

-----------------------------
CREATE VIEW v_pacientes
AS
select
    `pe`.`idpersonas` AS `idpersonas`,
    `pe`.`nombre` AS `nombre`,
    `pe`.`apellido` AS `apellido`,
    `pe`.`dni` AS `dni`,
    `pe`.`direccion` AS `direccion`,
    `pe`.`fecha_nacimiento` AS `fecha_nacimiento`,
    `pe`.`telefono` AS `telefono`,
    `pe`.`correo` AS `correo`,
    `pe`.`usuario` AS `usuario`,
    `pe`.`clave` AS `clave`,
    `pe`.`fecha_alta` AS `fecha_alta`,
    `pe`.`estados_idestados` AS `estados_idestados`,
    `pe`.`idsexos` AS `idsexos`,
    `pa`.`idtipo_paciente` AS `idtipo_paciente`,
    `t`.`tipo` AS `tipo`,
    `s`.`nombre` AS `sexo`
from ( ( (
                `dental99`.`personas` `pe`
                join `dental99`.`paciente` `pa` on(
                    `pa`.`idpersonas` = `pe`.`idpersonas`
                )
            )
            join `dental99`.`tipo_paciente` `t` on(
                `pa`.`idtipo_paciente` = `t`.`idtipo_paciente`
            )
        )
        join `dental99`.`sexos` `s` on(`pe`.`idsexos` = `s`.`idsexos`)
    )

----------------------------
CREATE VIEW v_personal01
AS
SELECT
	personas.idpersonas,
    personas.nombre,
    personas.apellido,
    personal.colegiatura,
    tipo_personal.tipo
FROM personal
    INNER JOIN tipo_personal ON personal.idtipo = tipo_personal.idtipo
    INNER JOIN personas on personal.idpersonas = personas.idpersonas
-------------------------------

drop view v_historias_clinicas 
--------------
CREATE VIEW
    v_historias_clinicas AS
SELECT
    hc.*,
    p.nombre as nomPaciente,
    p.apellido as apePaciente,
    p.dni,
    p.direccion,
    p.telefono,
    p.fecha_nacimiento,
    p.sexo,
    p.tipo,
    d.nombre as nomDoctor,
    d.apellido as apeDoctor,
    d.colegiatura
FROM historias_clinicas hc
    INNER JOIN v_pacientes p ON hc.idpaciente = p.idpersonas
    INNER JOIN v_personal01 d ON hc.iddoctor = d.idpersonas
------------///////////////////////////////
CREATE VIEW v_cita01 AS
SELECT
    c.idcitas,
    c.fecha,
    c.observaciones,
    c.idpaciente,
    c.idpersonal,
    pl.nombre as NomPersonal,
    p.nombre as NomPaciente,
    e.nombre as NomEstado,
    addtime(fecha, '00:30:00') as fin
FROM citas c 
	INNER JOIN estados e ON c.idestados = e.idestados
    INNER JOIN v_pacientes p ON c.idpaciente = p.idpersonas
    INNER JOIN v_personal01 pl ON c.idpersonal = pl.idpersonas

--------------------------------
CREATE VIEW v_comprobante00 AS
select
    `pe`.`idpersonas` AS `idpersonas`,
    `pe`.`nombre` AS `nombre`,
    `pe`.`apellido` AS `apellido`,
    `pe`.`dni` AS `dni`,
    `pe`.`direccion` AS `direccion`,
    `pe`.`fecha_nacimiento` AS `fecha_nacimiento`,
    `pe`.`telefono` AS `telefono`,
    `pe`.`correo` AS `correo`,
    `pe`.`usuario` AS `usuario`,
    `pe`.`clave` AS `clave`,
    `pe`.`fecha_alta` AS `fecha_alta`,
    `pe`.`estados_idestados` AS `estados_idestados`,
    `pe`.`idsexos` AS `idsexos`,
    `pa`.`idtipo_paciente` AS `idtipo_paciente`,
    `t`.`tipo` AS `tipo`,
    `s`.`nombre` AS `sexo`,
    cp.idpago,
    cp.numero,
    cp.total,
    cp.fecha
from ( ( (
                `dental99`.`personas` `pe`
                join `dental99`.`paciente` `pa` on(
                    `pa`.`idpersonas` = `pe`.`idpersonas`
                )
            )
            join `dental99`.`tipo_paciente` `t` on(
                `pa`.`idtipo_paciente` = `t`.`idtipo_paciente`
            )
        )
        join `dental99`.`sexos` `s` on(`pe`.`idsexos` = `s`.`idsexos`)
    )
    LEFT join comprobante_pago cp ON cp.idpersonas = `pa`.`idpersonas`

    