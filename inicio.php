<?php
    session_start();
    
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
            background-color: rgb(213, 226, 245);
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
                <a href="inicio.php"><i class="fa-solid fa-book"></i> Inicio</a>
                <a href="inicio.php"><i class="fas fa-truck"></i> Proveedores</a>
                <a href="productos.php"><i class="fas fa-box"></i> Productos</a>
                <a href="clientes.php" class="active"><i class="fas fa-users"></i> Clientes</a>
                <a href="./pedidos.php"><i class="fas fa-users"></i> Pedidos</a>
            </div>

            <!-- Contenido principal -->
            <div class="col-md-10 content">
                <div class="row">
                    <!-- Gráficas -->
                    <div class="col-md-6">
                        <div class="card card-dashboard">
                            <div class="card-header bg-primary text-white">Pedidos Pendientes</div>
                            <div class="card-body">
                                <canvas id="pendingOrdersChart" class="chart-container"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-dashboard">
                            <div class="card-header bg-success text-white">Pedidos Efectuados</div>
                            <div class="card-body">
                                <canvas id="completedOrdersChart" class="chart-container"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabla de Clientes -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card card-dashboard">
                            <div class="card-header bg-dark text-white">Clientes</div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Teléfono</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>cristina</td>
                                            <td>cristina@gmail.com</td>
                                            <td>123456789</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Maria dolores</td>
                                            <td>maria@gmail.com</td>
                                            <td>987654321</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mensajes -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card card-dashboard">
                            <div class="card-header bg-secondary text-white">Mensajes Recibidos</div>
                            <div class="card-body">
                                <div class="message-box">
                                    <strong>Cliente:</strong> cristina<br>
                                    <small>Asunto: Consulta sobre pedido</small>
                                </div>
                                <div class="message-box">
                                    <strong>Cliente:</strong> Maria dolores<br>
                                    <small>Asunto: Problema con el pago</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Gráfica de Pedidos Pendientes
        const pendingOrdersCtx = document.getElementById('pendingOrdersChart').getContext('2d');
        const pendingOrdersChart = new Chart(pendingOrdersCtx, {
            type: 'bar',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
                datasets: [{
                    label: 'Pedidos Pendientes',
                    data: [12, 19, 3, 5, 2],
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Gráfica de Pedidos Efectuados
        const completedOrdersCtx = document.getElementById('completedOrdersChart').getContext('2d');
        const completedOrdersChart = new Chart(completedOrdersCtx, {
            type: 'line',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
                datasets: [{
                    label: 'Pedidos Efectuados',
                    data: [5, 10, 15, 12, 8],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</body>
</html>