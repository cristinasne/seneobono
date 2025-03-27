<?php
$servidor = "localhost";
$user = "root";
$pass = "";
$db = "sesiones";

$conn = mysqli_connect($servidor, $user, $pass, $db);
if ($conn) {
    //echo "conexion exitosa";
}