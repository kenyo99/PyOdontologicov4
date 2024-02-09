DELIMITER / /

CREATE FUNCTION GETNUMEROTICKET() RETURNS VARCHAR(10) DETERMINISTIC BEGIN DECLARE 
	Declare Contador int DEFAULT 0;
	Select max(right(numero, 8)) into Contador from comprobante_pago;
	IF (Contador IS NULL) THEN set Contador = 0;
	end if;
	return concat( 'T-', right( concat('00000000', Contador + 1), 8 ) );
	END / /


DELIMITER;

