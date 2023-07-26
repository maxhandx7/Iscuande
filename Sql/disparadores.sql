DELIMITER //
CREATE TRIGGER disminuir_cupos_after_insert_cita
AFTER INSERT ON citas FOR EACH ROW
BEGIN
    UPDATE cupos
    SET cupos = cupos - 1
    WHERE id = NEW.cupos;
END;
//
DELIMITER ;