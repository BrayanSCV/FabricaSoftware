CREATE OR REPLACE FUNCTION calcular_valor_iva_detalle_factura()
RETURNS VOID AS $$
BEGIN
    
    UPDATE DETALLE_FACTURA
    SET valor_iva = valor * (iva / 100.0);

END;
$$ LANGUAGE plpgsql;

/*SELECT calcular_valor_iva_detalle_factura();*/