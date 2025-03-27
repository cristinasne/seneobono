<?php
session_start();

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Credenciales de los super administradores
    $superAdmins = [
        "cristina" => "123", // Usuario 1: admin1 con contraseña password123
        "sene" => "456"  // Usuario 2: admin2 con contraseña password456
    ];

    // Obtener los datos del formulario
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Verificar si las credenciales son válidas
    if (isset($superAdmins[$username]) && $superAdmins[$username] === $password) {
        // Credenciales válidas, iniciar sesión
        $_SESSION['super_admin'] = $username;
        header("Location: inicio.php"); // Redirigir al dashboard de inicio
        exit;
    } else {
        // Credenciales inválidas
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color:rgb(41, 156, 205);
        }
        .login-form {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .login-form h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h2 class="text-center">Super Administrador</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>