
CREATE OR REPLACE FUNCTION totalizar_valor_total_factura()
RETURNS VOID AS $$
DECLARE
    id_factura_det FACTURAS.id_factura%TYPE;
    total_valor NUMERIC;
BEGIN
    FOR id_factura_det IN SELECT id_factura FROM FACTURAS LOOP

        SELECT (f.valor - f.valor_descuento + f.iva) 
        INTO total_valor
        FROM FACTURAS f
        WHERE f.id_factura = id_factura_det;

        UPDATE FACTURAS
        SET valor_total = total_valor
        WHERE id_factura = id_factura_det;

    END LOOP;
END;
$$ LANGUAGE plpgsql;



/*SELECT totalizar_valor_total_factura();*/