create database ventas;
use ventas;


CREATE TABLE clientes (
   id_clientes int primary key auto_increment,
   nombre varchar(50),
   foto varchar(100),
   telefono varchar(50),
   email varchar(50)
);

CREATE TABLE proveedores (
   id int primary key auto_increment,
   nombre varchar(50),
   foto varchar(100),
   telefono varchar(50),
   email varchar(50)
);

CREATE TABLE productos (
   id_producto int primary key auto_increment,
   nombre varchar(50),
   foto varchar(100),
   fecha_caducidad varchar(50),
   id_proveedor int,
   FOREIGN KEY (id_proveedor) REFERENCES proveedores(id)
);

CREATE TABLE pedido (
   id int primary key auto_increment,
   id_producto int,
   id_cliente int,
   estado ENUM('pendiente', 'atendido') NOT NULL,
   FOREIGN KEY (id_cliente) REFERENCES clientes(id_clientes),
   FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
);

CREATE TABLE usuarios (
   id_usuario int primary key auto_increment,
   nombre varchar(50),
   email varchar(50),
   contrasena varchar(100)
);

CREATE TABLE stock (
   id_stock int primary key auto_increment,
   id_producto int,
   cantidad int,
   FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
);