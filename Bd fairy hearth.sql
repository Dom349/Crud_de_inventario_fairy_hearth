
CREAR  BASE DE DATOS  inventario_crud ;

usar inventario_crud;

CREATE TABLE  inventario de fairy hearth (
  Dirección de sucursal INT(10),
  Nom. De empleado VARCHAR(15) NOT NULL,
  Nom. Del producto VARCHAR(15) NOT NULL,
  NUM. De existencias INT(3),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
  actualizado_en TIMESTAMP PREDETERMINADO CURRENT_TIMESTAMP
);
