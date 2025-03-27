<?php
include "conexion.php";

// Inicializar variables
$id_clientes = "";
$nombre = "";
$telefono = "";
$email = "";
$foto = "";
$alerta = "";

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['registrar'])) {
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        
        // Manejo de la foto
        $foto = "";
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $dir_subida = 'uploads/';
            if (!file_exists($dir_subida)) {
                mkdir($dir_subida, 0777, true);
            }
            
            $nombre_archivo = uniqid() . "_" . $_FILES['foto']['name'];
            $fichero_subido = $dir_subida . $nombre_archivo;
            
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $fichero_subido)) {
                $foto = $fichero_subido;
            }
        }
        
        // Insertar datos en la base de datos
        $sql = "INSERT INTO clientes (nombre, telefono, email, foto) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssss", $nombre, $telefono, $email, $foto);
        
        if ($stmt->execute()) {
            $alerta = '<div class="alert alert-success">Cliente registrado correctamente</div>';
            // Limpiar variables
            $nombre = "";
            $telefono = "";
            $email = "";
            $foto = "";
        } else {
            $alerta = '<div class="alert alert-danger">Error al registrar cliente: ' . $conexion->error . '</div>';
        }
        $stmt->close();
    }
    
    // Procesar eliminación
    if (isset($_POST['eliminar'])) {
        $id_eliminar = $_POST['id_eliminar'];
        
        // Obtener la foto para eliminarla si existe
        $sql_foto = "SELECT foto FROM clientes WHERE id_clientes = ?";
        $stmt = $conexion->prepare($sql_foto);
        $stmt->bind_param("i", $id_eliminar);
        $stmt->execute();
        $stmt->bind_result($foto_eliminar);
        $stmt->fetch();
        $stmt->close();
        
        // Eliminar el registro
        $sql = "DELETE FROM clientes WHERE id_clientes = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id_eliminar);
        
        if ($stmt->execute()) {
            // Eliminar foto si existe
            if (!empty($foto_eliminar) && file_exists($foto_eliminar)) {
                unlink($foto_eliminar);
            }
            $alerta = '<div class="alert alert-success">Cliente eliminado correctamente</div>';
        } else {
            $alerta = '<div class="alert alert-danger">Error al eliminar cliente: ' . $conexion->error . '</div>';
        }
        $stmt->close();
    }
    
    // Procesar edición
    if (isset($_POST['editar'])) {
        $id_clientes = $_POST['id_editar'];
        
        // Obtener datos actuales
        $sql = "SELECT id_clientes, nombre, telefono, email, foto FROM clientes WHERE id_clientes = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id_clientes);
        $stmt->execute();
        $stmt->bind_result($id_clientes, $nombre, $telefono, $email, $foto);
        $stmt->fetch();
        $stmt->close();
    }
    
    // Procesar actualización
    if (isset($_POST['actualizar'])) {
        $id_clientes = $_POST['id_clientes'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $foto_actual = $_POST['foto_actual'];
        
        // Verificar si se subió una nueva foto
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $dir_subida = 'uploads/';
            if (!file_exists($dir_subida)) {
                mkdir($dir_subida, 0777, true);
            }
            
            $nombre_archivo = uniqid() . "_" . $_FILES['foto']['name'];
            $fichero_subido = $dir_subida . $nombre_archivo;
            
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $fichero_subido)) {
                // Eliminar foto anterior si existe
                if (!empty($foto_actual) && file_exists($foto_actual)) {
                    unlink($foto_actual);
                }
                $foto = $fichero_subido;
            } else {
                $foto = $foto_actual;
            }
        } else {
            $foto = $foto_actual;
        }
        
        // Actualizar datos
        $sql = "UPDATE clientes SET nombre = ?, telefono = ?, email = ?, foto = ? WHERE id_clientes = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssssi", $nombre, $telefono, $email, $foto, $id_clientes);
        
        if ($stmt->execute()) {
            $alerta = '<div class="alert alert-success">Cliente actualizado correctamente</div>';
            // Limpiar variables
            $id_clientes = "";
            $nombre = "";
            $telefono = "";
            $email = "";
            $foto = "";
        } else {
            $alerta = '<div class="alert alert-danger">Error al actualizar cliente: ' . $conexion->error . '</div>';
        }
        $stmt->close();
    }
}

// Obtener todos los clientes
$sql = "SELECT id_clientes, nombre, telefono, email, foto FROM clientes ORDER BY id_clientes DESC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome para íconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Estilos personalizados -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color:#2ec8a6;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }
        .sidebar a:hover {
            background-color: rgb(213, 226, 245);
        }
        .sidebar a.active {
            background-color:rgb(213, 226, 245);
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
                <a href="productos.php"><i class="fas fa-box"></i> Productos</a>
                <a href="clientes.php" class="active"><i class="fas fa-users"></i> Clientes</a>
                <a href="./pedidos.php" ><i class="fas fa-users"></i> Pedidos</a>
            </div>
            
            <!-- Contenido principal -->
            <div class="col-md-10 content">
                <h2>Gestión de Clientes</h2>
                
                <?php echo $alerta; ?>
                
                <!-- Formulario de registro/edición -->
                <div class="card mb-4">
                    <div class="card-header">
                        <?php echo empty($id_clientes) ? 'Registrar nuevo cliente' : 'Editar cliente'; ?>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_clientes" value="<?php echo $id_clientes; ?>">
                            <input type="hidden" name="foto_actual" value="<?php echo $foto; ?>">
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono; ?>" required>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                                    <?php if (!empty($foto)) { ?>
                                        <div class="mt-2">
                                            <img src="<?php echo $foto; ?>" class="foto-preview">
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <?php if (empty($id_clientes)) { ?>
                                <button type="submit" name="registrar" class="btn btn-primary">Registrar</button>
                            <?php } else { ?>
                                <button type="submit" name="actualizar" class="btn btn-success">Actualizar</button>
                                <a href="clientes.php" class="btn btn-secondary">Cancelar</a>
                            <?php } ?>
                        </form>
                    </div>
                </div>
                
                <!-- Tabla de clientes -->
                <div class="card">
                    <div class="card-header">
                        Lista de Clientes
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Foto</th>
                                        <th>Nombre</th>
                                        <th>Teléfono</th>
                                        <th>Email</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($resultado->num_rows > 0) {
                                        while ($fila = $resultado->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?php echo $fila['id_clientes']; ?></td>
                                                <td>
                                                    <?php if (!empty($fila['foto'])) { ?>
                                                        <img src="<?php echo $fila['foto']; ?>" class="foto-preview">
                                                    <?php } else { ?>
                                                        <i class="fas fa-user fa-2x text-secondary"></i>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $fila['nombre']; ?></td>
                                                <td><?php echo $fila['telefono']; ?></td>
                                                <td><?php echo $fila['email']; ?></td>
                                                <td>
                                                    <form method="POST" style="display: inline;">
                                                        <input type="hidden" name="id_editar" value="<?php echo $fila['id_clientes']; ?>">
                                                        <button type="submit" name="editar" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </form>
                                                    <form method="POST" style="display: inline;" onsubmit="return confirm('¿Está seguro de eliminar este cliente?');">
                                                        <input type="hidden" name="id_eliminar" value="<?php echo $fila['id_clientes']; ?>">
                                                        <button type="submit" name="eliminar" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No hay clientes registrados</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
