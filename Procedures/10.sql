CREATE OR REPLACE FUNCTION calcular_valor_descuento_factura()
RETURNS VOID AS $$
DECLARE
    cur_id_factura CURSOR FOR
        SELECT DISTINCT df.id_factura FROM DETALLE_FACTURA df;
    id_factura_det DETALLE_FACTURA.id_factura%TYPE;
    total_valor_descuento_factura NUMERIC;
BEGIN
    OPEN cur_id_factura;
    LOOP
        FETCH NEXT FROM cur_id_factura INTO id_factura_det;
        EXIT WHEN NOT FOUND;

       
        SELECT SUM((df.precio * df.cantidad) * (f.descuento / 100.0))
        INTO total_valor_descuento_factura
        FROM DETALLE_FACTURA df
        INNER JOIN FACTURAS f ON df.id_factura = f.id_factura
        WHERE df.id_factura = id_factura_det;

        
        UPDATE FACTURAS
        SET valor_descuento = total_valor_descuento_factura
        WHERE FACTURAS.id_factura = id_factura_det;
    END LOOP;
    CLOSE cur_id_factura;
END;
$$ LANGUAGE plpgsql;



/*SELECT * FROM calcular_valor_descuento_factura();*/