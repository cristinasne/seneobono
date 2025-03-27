<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atención de Pedidos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .table-container {
            margin-top: 20px;
        }
        .badge-pendiente {
            background-color: #ffc107;
            color: #000;
        }
        .badge-atendido {
            background-color: #198754;
            color: #fff;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .card-header {
            background-color: #f1f5f9;
            border-bottom: 1px solid #eee;
        }
        .btn-action {
            margin-right: 5px;
        }
        .filter-section {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <!-- Header y menú de navegación -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 rounded">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <i class="fas fa-pills me-2"></i>
                    Sistema Farmaco
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                <i class="fas fa-clipboard-list me-1"></i>Gestión de Pedidos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="atender_pedidos.php">
                                <i class="fas fa-check-circle me-1"></i>Atender Pedidos
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Panel de filtros -->
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-filter me-2"></i>Filtros de Pedidos</h3>
            </div>
            <div class="card-body">
                <div class="filter-section">
                    <form id="filterForm" method="GET" class="row g-3">
                        <div class="col-md-4">
                            <label for="filtroEstado" class="form-label">Estado</label>
                            <select class="form-select" id="filtroEstado" name="estado">
                                <option value="todos" <?php echo (!isset($_GET['estado']) || $_GET['estado'] == 'todos') ? 'selected' : ''; ?>>Todos</option>
                                <option value="pendiente" <?php echo (isset($_GET['estado']) && $_GET['estado'] == 'pendiente') ? 'selected' : ''; ?>>Pendientes</option>
                                <option value="atendido" <?php echo (isset($_GET['estado']) && $_GET['estado'] == 'atendido') ? 'selected' : ''; ?>>Atendidos</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="filtroCliente" class="form-label">Cliente</label>
                            <select class="form-select" id="filtroCliente" name="cliente">
                                <option value="">Todos los clientes</option>
                                <?php
                                include 'conexion.php';
                                
                                $sql = "SELECT id_clientes, nombre FROM clientes ORDER BY nombre";
                                $resultado = $conexion->query($sql);
                                
                                if ($resultado->num_rows > 0) {
                                    while($fila = $resultado->fetch_assoc()) {
                                        $selected = (isset($_GET['cliente']) && $_GET['cliente'] == $fila["id_clientes"]) ? 'selected' : '';
                                        echo "<option value='" . $fila["id_clientes"] . "' $selected>" . $fila["nombre"] . "</option>";
                                    }
                                }
                                
                                $conexion->close();
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-search me-1"></i>Filtrar
                            </button>
                            <a href="atender_pedidos.php" class="btn btn-secondary">
                                <i class="fas fa-redo me-1"></i>Restablecer
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabla de pedidos -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2><i class="fas fa-tasks me-2"></i>Listado de Pedidos</h2>
                <a href="index.php" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Nuevo Pedido
                </a>
            </div>
            <div class="card-body">
                <div class="table-container">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Producto</th>
                                <th>Cliente</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaPedidos">
                            <?php
                            include 'conexion.php';
                            
                            // Construir la consulta SQL con filtros
                            $sql = "SELECT p.id, pr.nombre AS nombre_producto, c.nombre AS nombre_cliente, 
                                           p.estado, p.fecha_registro
                                   FROM pedido p
                                   INNER JOIN productos pr ON p.id_producto = pr.id_producto
                                   INNER JOIN clientes c ON p.id_cliente = c.id_clientes
                                   WHERE 1=1";
                            
                            if (isset($_GET['estado']) && $_GET['estado'] != 'todos') {
                                $sql .= " AND p.estado = '" . $_GET['estado'] . "'";
                            }
                            
                            if (isset($_GET['cliente']) && !empty($_GET['cliente'])) {
                                $sql .= " AND p.id_cliente = " . $_GET['cliente'];
                            }
                            
                            $sql .= " ORDER BY p.fecha_registro DESC";
                            
                            $resultado = $conexion->query($sql);
                            
                            if ($resultado->num_rows > 0) {
                                while($fila = $resultado->fetch_assoc()) {
                                    $badgeClass = ($fila["estado"] == "atendido") ? "badge-atendido" : "badge-pendiente";
                                    $estadoTexto = ($fila["estado"] == "atendido") ? "Atendido" : "Pendiente";
                                    
                                    echo "<tr>";
                                    echo "<td>" . $fila["id"] . "</td>";
                                    echo "<td>" . $fila["nombre_producto"] . "</td>";
                                    echo "<td>" . $fila["nombre_cliente"] . "</td>";
                                    echo "<td><span class='badge " . $badgeClass . "'>" . $estadoTexto . "</span></td>";
                                    echo "<td>" . $fila["fecha_registro"] . "</td>";
                                    
                                    if ($fila["estado"] == "pendiente") {
                                        echo "<td>
                                                <button class='btn btn-sm btn-success btn-action' onclick='atenderPedido(" . $fila["id"] . ")'>
                                                    <i class='fas fa-check'></i> Atender
                                                </button>
                                                <button class='btn btn-sm btn-info btn-action' onclick='verDetalles(" . $fila["id"] . ")'>
                                                    <i class='fas fa-eye'></i>
                                                </button>
                                              </td>";
                                    } else {
                                        echo "<td>
                                                <button class='btn btn-sm btn-warning btn-action' onclick='revertirEstado(" . $fila["id"] . ")'>
                                                    <i class='fas fa-undo'></i> Revertir
                                                </button>
                                                <button class='btn btn-sm btn-info btn-action' onclick='verDetalles(" . $fila["id"] . ")'>
                                                    <i class='fas fa-eye'></i>
                                                </button>
                                              </td>";
                                    }
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center'>No hay pedidos que coincidan con los filtros</td></tr>";
                            }
                            
                            $conexion->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Detalles del Pedido -->
    <div class="modal fade" id="modalDetalles" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title"><i class="fas fa-info-circle me-2"></i>Detalles del Pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="detallesPedido">
                    <!-- El contenido se cargará dinámicamente -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Código PHP para el archivo cambiar_estado.php -->
    <?php
    // Guardar este código en un archivo llamado cambiar_estado.php
    /*
    <?php
    include 'conexion.php';

    if(isset($_GET['id']) && isset($_GET['estado'])) {
        $id = $_GET['id'];
        $estado = $_GET['estado'];
        
        // Validar el estado
        if($estado != 'pendiente' && $estado != 'atendido') {
            header("Location: atender_pedidos.php?mensaje=error");
            exit;
        }
        
        $sql = "UPDATE pedido SET estado = ? WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("si", $estado, $id);
        
        if($stmt->execute()) {
            header("Location: atender_pedidos.php?mensaje=exito");
        } else {
            header("Location: atender_pedidos.php?mensaje=error");
        }
        
        $stmt->close();
        $conexion->close();
    }
    ?>
    */
    ?>

    <!-- Código PHP para el archivo detalles_pedido.php -->
    <?php
    // Guardar este código en un archivo llamado detalles_pedido.php
    /*
    <?php
    include 'conexion.php';
    
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $sql = "SELECT p.id, pr.nombre AS nombre_producto, pr.descripcion AS desc_producto, 
                       c.nombre AS nombre_cliente, c.telefono, c.email,
                       p.estado, p.fecha_registro
                FROM pedido p
                INNER JOIN productos pr ON p.id_producto = pr.id_producto
                INNER JOIN clientes c ON p.id_cliente = c.id_clientes
                WHERE p.id = ?";
        
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if($resultado->num_rows > 0) {
            $pedido = $resultado->fetch_assoc();
            
            $html = '<div class="card border-0">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-shopping-cart me-2"></i>Pedido #' . $pedido["id"] . '</h5>
                            <p class="text-muted">Fecha: ' . $pedido["fecha_registro"] . '</p>
                            
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h6><i class="fas fa-box me-2"></i>Información del Producto</h6>
                                    <ul class="list-group">
                                        <li class="list-group-item">Nombre: <strong>' . $pedido["nombre_producto"] . '</strong></li>
                                        <li class="list-group-item">Descripción: ' . $pedido["desc_producto"] . '</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h6><i class="fas fa-user me-2"></i>Información del Cliente</h6>
                                    <ul class="list-group">
                                        <li class="list-group-item">Nombre: <strong>' . $pedido["nombre_cliente"] . '</strong></li>
                                        <li class="list-group-item">Teléfono: ' . $pedido["telefono"] . '</li>
                                        <li class="list-group-item">Email: ' . $pedido["email"] . '</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>';
            
            echo $html;
        } else {
            echo '<div class="alert alert-warning">No se encontró información para este pedido.</div>';
        }
        
        $stmt->close();
        $conexion->close();
    }
    ?>
    */
    ?>

    <!-- Bootstrap Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    // Funciones para atender y revertir estado de pedidos
    function atenderPedido(id) {
        if(confirm('¿Marcar este pedido como atendido?')) {
            window.location.href = 'cambiar_estado.php?id=' + id + '&estado=atendido';
        }
    }

    function revertirEstado(id) {
        if(confirm('¿Volver a marcar este pedido como pendiente?')) {
            window.location.href = 'cambiar_estado.php?id=' + id + '&estado=pendiente';
        }
    }

    function verDetalles(id) {
        // Hacer una petición AJAX para obtener los detalles del pedido
        fetch('detalles_pedido.php?id=' + id)
            .then(response => response.text())
            .then(data => {
                // Cargar los detalles en el modal
                document.getElementById('detallesPedido').innerHTML = data;
                
                // Abrir el modal
                var modalDetalles = new bootstrap.Modal(document.getElementById('modalDetalles'));
                modalDetalles.show();
            })
            .catch(error => console.error('Error:', error));
    }

    // Mostrar alertas para las operaciones
    document.addEventListener('DOMContentLoaded', function() {
        // Verificar si hay mensajes en la URL
        const urlParams = new URLSearchParams(window.location.search);
        const mensaje = urlParams.get('mensaje');
        
        if(mensaje === 'exito') {
            showToast('Operación realizada con éxito', 'success');
        } else if(mensaje === 'error') {
            showToast('Ocurrió un error en la operación', 'danger');
        }
    });

    // Función para mostrar notificaciones tipo toast
    function showToast(message, type) {
        // Crear elemento toast
        const toastEl = document.createElement('div');
        toastEl.className = `toast align-items-center text-white bg-${type} border-0 position-fixed bottom-0 end-0 m-3`;
        toastEl.setAttribute('role', 'alert');
        toastEl.setAttribute('aria-live', 'assertive');
        toastEl.setAttribute('aria-atomic', 'true');
        
        toastEl.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;
        
        document.body.appendChild(toastEl);
        
        const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
        toast.show();
        
        // Eliminar el elemento después de ocultarse
        toastEl.addEventListener('hidden.bs.toast', function () {
            toastEl.remove();
        });
    }
    </script>
</body>
</html>
