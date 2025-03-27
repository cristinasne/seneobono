<?php
// Archivo: guardar_pedido.php (versión corregida)
// Función: Guardar o actualizar un pedido en la base de datos

// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_producto = $_POST["id_producto"];
    $id_cliente = $_POST["id_cliente"];
    
    // Validar que los datos no estén vacíos
    if(empty($id_producto) || empty($id_cliente)) {
        header("Location: index.php?mensaje=falta_datos");
        exit;
    }
    
    // Si existe un ID, es una actualización
    if(isset($_POST["pedidoId"]) && !empty($_POST["pedidoId"])) {
        $id = $_POST["pedidoId"];
        
        // Preparar la consulta SQL para actualizar
        $sql = "UPDATE pedido SET id_producto = ?, id_cliente = ? WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("iii", $id_producto, $id_cliente, $id);
        
        // Mensaje para mostrar
        $mensaje_tipo = "actualizado";
    } else {
        // Es un nuevo registro - versión corregida sin la columna 'estado'
        $sql = "INSERT INTO pedido (id_producto, id_cliente) VALUES (?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ii", $id_producto, $id_cliente);
        
        // Mensaje para mostrar
        $mensaje_tipo = "creado";
    }
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Obtener el ID del pedido recién insertado si es un nuevo registro
        if(!isset($_POST["pedidoId"]) || empty($_POST["pedidoId"])) {
            $id_pedido = $conexion->insert_id;
        }
        
        // Redirigir a la página principal con mensaje de éxito
        header("Location: pedidos.php?mensaje=exito&tipo=$mensaje_tipo");
    } else {
        // Error al ejecutar la consulta
        header("Location: pedidos.php?mensaje=error&sql=" . urlencode($conexion->error));
    }
    
    // Cerrar la sentencia y la conexión
    $stmt->close();
    $conexion->close();
} else {
    // Si no se ha enviado por POST, redirigir a la página principal
    header("Location: pedidos.php");
}
?>