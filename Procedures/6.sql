CREATE OR REPLACE FUNCTION calcular_valor_detalle_factura()
RETURNS VOID AS $$
BEGIN

    UPDATE DETALLE_FACTURA
    SET valor = precio * cantidad;

END;
$$ LANGUAGE plpgsql;


/*SELECT calcular_valor_detalle_factura();*/