<?php
// Configuración de la conexión a la base de datos
$host = "localhost";
$usuario = "root";
$clave = "";
$bd = "ventas";

// Crear conexión
$conexion = new mysqli($host, $usuario, $clave, $bd);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Establecer caracteres utf8
$conexion->set_charset("utf8");
?>
