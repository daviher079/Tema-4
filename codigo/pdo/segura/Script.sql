
CREATE DATABASE IF NOT EXISTS empresa;
USE empresa;

CREATE TABLE proveedores (nie INT, nombre NVARCHAR(50), contacto INT);
CREATE TABLE productos (codigo INT, nombre NVARCHAR(50), precio SMALLINT);
CREATE TABLE clientes (id_cliente INT, nombre NVARCHAR(50), dni VARCHAR(50), contacto INT, puntos INT);
CREATE TABLE empleados (id_empleado INT, nombre NVARCHAR(50), dni VARCHAR(50), cargo NVARCHAR(50));
CREATE TABLE cargo (id_cargo INT, nombre NVARCHAR(50), descripcion NVARCHAR(50));
CREATE TABLE lugar (id_sucursal INT, direccion NVARCHAR(50), contacto INT, miembros INT);

INSERT INTO proveedores VALUES (00001, 'NewPlay', 910354862); 
INSERT INTO proveedores VALUES (00003, 'MediaKoch', 930254187);
INSERT INTO productos VALUES (000008, 'Numcias Tales', 69.99);
INSERT INTO productos VALUES (000025, 'Blue Life Inception', 29.99);
INSERT INTO productos VALUES (000012, 'Nut of Peace', 49.99);
INSERT INTO clientes VALUES (2580401, 'Analisa Melano', '75263542L', 695241578, 675);
INSERT INTO clientes VALUES (2580401, 'Elmer Curio', '55147641G', 684235712, 123);
INSERT INTO clientes VALUES (2580401, 'Helen Chufe', '75236482B', 954236712, 54);
INSERT INTO clientes VALUES (2580401, 'Lola Mento', '15245678T', 980024563, 0);
INSERT INTO clientes VALUES (2580401, 'Benito Camela', '45237865E', 960324517, 1245);
INSERT INTO empleados VALUES (0005, 'Ellen Gualarga', '54823647D', 'Encargado');
INSERT INTO empleados VALUES (0156, 'Alex Tintor', '84236512S', 'Reponedor');
INSERT INTO empleados VALUES (0453, 'Elba Jonazo', '85369214W', 'Tendero');
INSERT INTO empleados VALUES (0054, 'Irma Tando', '44256378B', 'Tendero');
INSERT INTO cargo VALUES (254, 'Reponedor', 'Encargado del suministro de cada tienda y de colocar los diferentes productos en sus correspondientes repisas y estantes');
INSERT INTO cargo VALUES (274, 'Tendero', 'Encargado detras de la caja que atiende a los clientes, les cobra y aconseja en sus compras');
INSERT INTO lugar VALUES (158, 'Calle Zamora N-12 (Ávila)', 920645236, 5);
INSERT INTO lugar VALUES (054, 'Calle Pascual N-3 (Bilbao)', 963521487, 3);
INSERT INTO lugar VALUES (054, 'Centro Comercial Valdaravias (Murcia)', 912547863, 4);

<!-- Crear primero un usuario y luego asignarle los permisos necesarios -->
//CREATE USER EllenG IDENTIFIED BY PASSWORD '19920518';
GRANT ALL PRIVILEGES ON empresa.productos TO 'EllenG'@'localhost'
DROP USER EllenG;//

GRANT ALL PRIVILEGES ON empresa.productos TO 'EllenG'@'localhost'
-> IDENTIFIED BY '19920518' WITH GRANT OPTION;