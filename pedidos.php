

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #2ec8a6;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }
        .sidebar a:hover {
            background-color:rgb(213, 226, 245);
        }
        .sidebar a.active {
            background-color: rgb(213, 226, 245);
        }
        .content {
            padding: 20px;
        }
        .foto-preview {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 p-0 sidebar">
                <h3 class="p-3">FARMAVENTASENE</h3>
                <a href="proveedores.php"><i class="fa-solid fa-book"></i> Inicio</a>

                <a href="proveedores.php"><i class="fas fa-truck"></i> Proveedores</a>
                <a href="productos.php" ><i class="fas fa-box"></i> Productos</a>
                <a href="clientes.php" ><i class="fas fa-users"></i> Clientes</a>
                <a href="clientes.php" class="active" ><i class="fas fa-users"></i> Pedidos</a>
            </div>
            
            <!-- Contenido principal -->
            <div class="col-md-10 content">
                <h2>Gestión de Pedidos</h2>
                
           
                <div class="container py-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2><i class="fas fa-clipboard-list"></i> Gestión de Pedidos</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPedido">
                    <i class="fas fa-plus"></i> Nuevo Pedido
                </button>
            </div>
            <div class="card-body">
                <div class="table-container">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Producto</th>
                                <th>Cliente</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaPedidos">
                            <?php
                            include 'conexion.php';
                            
                            // Consulta SQL con INNER JOIN para obtener los nombres
                            $sql = "SELECT p.id, pr.nombre AS nombre_producto, c.nombre AS nombre_cliente 
                                   FROM pedido p
                                   INNER JOIN productos pr ON p.id_producto = pr.id_producto
                                   INNER JOIN clientes c ON p.id_cliente = c.id_clientes";
                            
                            $resultado = $conexion->query($sql);
                            
                            if ($resultado->num_rows > 0) {
                                while($fila = $resultado->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $fila["id"] . "</td>";
                                    echo "<td>" . $fila["nombre_producto"] . "</td>";
                                    echo "<td>" . $fila["nombre_cliente"] . "</td>";
                                    echo "<td>
                                            <button class='btn btn-sm btn-warning btn-action' onclick='editarPedido(" . $fila["id"] . ")'><i class='fas fa-edit'></i></button>
                                            <button class='btn btn-sm btn-danger btn-action' onclick='eliminarPedido(" . $fila["id"] . ")'><i class='fas fa-trash'></i></button>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center'>No hay pedidos registrados</td></tr>";
                            }
                            
                            $conexion->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Registro de Pedido -->
    <div class="modal fade" id="modalPedido" tabindex="-1" aria-labelledby="modalPedidoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalPedidoLabel"><i class="fas fa-shopping-cart"></i> Registro de Pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formPedido" action="guardar_pedido.php" method="POST">
                        <input type="hidden" id="pedidoId" name="pedidoId">
                        
                        <div class="mb-3">
                            <label for="producto" class="form-label"><i class="fas fa-box"></i> Producto</label>
                            <select class="form-select" id="producto" name="id_producto" required>
                                <option value="">Seleccione un producto</option>
                                <?php
                                include 'conexion.php';
                                
                                $sql = "SELECT id_producto, nombre FROM productos ORDER BY nombre";
                                $resultado = $conexion->query($sql);
                                
                                if ($resultado->num_rows > 0) {
                                    while($fila = $resultado->fetch_assoc()) {
                                        echo "<option value='" . $fila["id_producto"] . "'>" . $fila["nombre"] . "</option>";
                                    }
                                }
                                
                                $conexion->close();
                                ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="cliente" class="form-label"><i class="fas fa-user"></i> Cliente</label>
                            <select class="form-select" id="cliente" name="id_cliente" required>
                                <option value="">Seleccione un cliente</option>
                                <?php
                                include 'conexion.php';
                                
                                $sql = "SELECT id_clientes, nombre FROM clientes ORDER BY nombre";
                                $resultado = $conexion->query($sql);
                                
                                if ($resultado->num_rows > 0) {
                                    while($fila = $resultado->fetch_assoc()) {
                                        echo "<option value='" . $fila["id_clientes"] . "'>" . $fila["nombre"] . "</option>";
                                    }
                                }
                                
                                $conexion->close();
                                ?>
                            </select>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Guardar Pedido
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




            </div>
        </div>
    </div>

    
    <!-- Bootstrap Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    // Funciones para editar y eliminar pedidos
    function editarPedido(id) {
        // Hacer una petición AJAX para obtener los datos del pedido
        fetch('obtener_pedido.php?id=' + id)
            .then(response => response.json())
            .then(data => {
                // Rellenar el formulario con los datos
                document.getElementById('pedidoId').value = data.id;
                document.getElementById('producto').value = data.id_producto;
                document.getElementById('cliente').value = data.id_cliente;
                
                // Abrir el modal
                var modal = new bootstrap.Modal(document.getElementById('modalPedido'));
                modal.show();
            })
            .catch(error => console.error('Error:', error));
    }

    function eliminarPedido(id) {
        if(confirm('¿Está seguro que desea eliminar este pedido?')) {
            window.location.href = 'eliminar_pedido.php?id=' + id;
        }
    }

    // Mostrar alertas para las operaciones
    document.addEventListener('DOMContentLoaded', function() {
        // Verificar si hay mensajes en la URL
        const urlParams = new URLSearchParams(window.location.search);
        const mensaje = urlParams.get('mensaje');
        
        if(mensaje === 'exito') {
            alert('Operación realizada con éxito');
        } else if(mensaje === 'error') {
            alert('Ocurrió un error en la operación');
        } else if(mensaje === 'eliminado') {
            alert('Pedido eliminado correctamente');
        }
    });
    </script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
