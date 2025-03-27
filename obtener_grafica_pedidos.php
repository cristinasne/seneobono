<?php
include 'conexion.php';

// Consulta para contar los pedidos por estado
$sql = "SELECT estado, COUNT(*) AS total FROM pedido GROUP BY estado";
$resultado = $conexion->query($sql);

// Inicializar los datos
$data = ['pendientes' => 0, 'atendidos' => 0];

// Procesar los resultados
while ($fila = $resultado->fetch_assoc()) {
    if ($fila['estado'] === 'pendiente') {
        $data['pendientes'] = $fila['total'];
    } elseif ($fila['estado'] === 'atendido') {
        $data['atendidos'] = $fila['total'];
    }
}

// Devolver los datos en formato JSON
echo json_encode($data);

// Cerrar la conexión
$conexion->close();
?>