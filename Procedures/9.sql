
CREATE OR REPLACE FUNCTION totalizar_valor_iva_factura()
RETURNS VOID AS $$
DECLARE
    cur_id_factura CURSOR FOR
        SELECT DISTINCT df.id_factura FROM DETALLE_FACTURA df;
    id_factura_det DETALLE_FACTURA.id_factura%TYPE;
    total_valor_iva_factura NUMERIC;
BEGIN
    OPEN cur_id_factura;
    LOOP
        FETCH NEXT FROM cur_id_factura INTO id_factura_det;
        EXIT WHEN NOT FOUND;

        SELECT SUM(df.valor_iva) INTO total_valor_iva_factura
        FROM DETALLE_FACTURA df
        WHERE df.id_factura = id_factura_det;

        UPDATE FACTURAS
        SET iva = total_valor_iva_factura
        WHERE FACTURAS.id_factura = id_factura_det;
    END LOOP;
    CLOSE cur_id_factura;
END;
$$ LANGUAGE plpgsql;


/*SELECT totalizar_valor_iva_factura();*/