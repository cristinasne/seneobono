<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y obtener los datos del formulario
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);
    $subject = filter_var(trim($_POST['subject']), FILTER_SANITIZE_STRING);
    $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

    // Validar que los campos requeridos no estén vacíos
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "<script>alert('Por favor, completa todos los campos obligatorios.');</script>";
        exit;
    }

    // Validar formato de correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Por favor, ingresa un correo electrónico válido.');</script>";
        exit;
    }

    // Configurar el correo
    $to = "mariacristinasene22@gmail.com"; // Cambia esto por tu dirección de correo
    $subjectEmail = "Nuevo mensaje de contacto: $subject";

    // Crear el contenido del correo en formato HTML
    $body = "
    <html>
    <head>
        <title>Nuevo mensaje de contacto</title>
    </head>
    <body>
        <h2>Has recibido un nuevo mensaje de contacto</h2>
        <p><strong>Nombre:</strong> $name</p>
        <p><strong>Correo:</strong> $email</p>
        <p><strong>Teléfono:</strong> $phone</p>
        <p><strong>Asunto:</strong> $subject</p>
        <p><strong>Mensaje:</strong></p>
        <p>$message</p>
    </body>
    </html>
    ";

    // Encabezados del correo
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Enviar el correo
    if (mail($to, $subjectEmail, $body, $headers)) {
        echo "<script>alert('¡Mensaje enviado con éxito!');</script>";
    } else {
        echo "<script>alert('Hubo un error al enviar el mensaje. Inténtalo de nuevo.');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROYECTO SENE</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c1df782baf.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-thin-rounded/css/uicons-thin-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="stylesheet" href="./css/estilo.css">
    <link rel="stylesheet" href="./css/contacto.css">

</head>
<body>
<header>
        
<div class="logo">
    <img src="img/logo5.jpg" alt="">
    <span class="logo-text">
        <span class="farma">FARMA</span><span class="sene">SENE</span>
    </span>
</div>

        <nav class="navbar">
            <a href="">Inicio</a>
            <a href="sobre.php">Sobre nosotros</a>
            <a href="servicios.php">Servicios</a>
            <a href="farmacos.php">Farmacos</a>
          
            <a href="">Contactos</a>
            <a href="iniciar.php">Admin</a>
        </nav>


    </header>
<!-- encabezado -->

<div class="main-home">

<div class="home">
    <div class="home-left-content">
    <span>bienvenido a la farmaventa @SENE</span>
<h2>Nos dedicamos ofrecer<br> medicamentos de calidad</h2>
<p class="lorem">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
</p>
</div>

                <div class="home-right-content">
                    <img src="img/hero.jpg" alt="">
                </div>
            </div>
        </div>


          <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center hero-content">
                    <h1 class="display-4 fw-bold mb-4">Contacto</h1>
                    <p class="lead mb-4">Estamos aquí para ayudarte. Contáctanos para resolver tus dudas o solicitar nuestros servicios.</p>
                    <a href="#contact-form" class="btn btn-light btn-lg px-4 me-md-2">Escríbenos</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Información de Contacto -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-4 mb-4">
                    <div class="contact-card">
                        <div class="icon-box">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3 class="h4 mb-3">Nuestra Ubicación</h3>
                        <p class="mb-0">ciudad de la Paz</p>
                        <p class="mb-0">farmaventasene</p>
                        <p>Ciudad de la Paz </p>
                        <a href="#map" class="btn btn-outline-primary mt-3">Ver en mapa</a>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4">
                    <div class="contact-card">
                        <div class="icon-box">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h3 class="h4 mb-3">Teléfonos</h3>
                        <p class="mb-2"><i class="fas fa-headset me-2 text-primary"></i> Atención al cliente:</p>
                        <p class="mb-3 fw-bold">+240 222 827088</p>
                        <p class="mb-2"><i class="fas fa-first-aid me-2 text-primary"></i> Consultas farmacéuticas:</p>
                        <p class="mb-0 fw-bold">+240 555 986375</p>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4">
                    <div class="contact-card">
                        <div class="icon-box">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3 class="h4 mb-3">Correo Electrónico</h3>
                        <p class="mb-2"><i class="fas fa-user-friends me-2 text-primary"></i> Atención al cliente:</p>
                        <p class="mb-3">clientes@farmaventa.com</p>
                        <p class="mb-2"><i class="fas fa-briefcase me-2 text-primary"></i> Oportunidades laborales:</p>
                        <p class="mb-0">empleo@farmaventa.com</p>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title d-inline-block">Horario de Atención</h2>
                </div>
            </div>
            
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <h3 class="h5 mb-3">Sucursales Físicas</h3>
                                    <ul class="hours-list">
                                        <li>
                                            <span>Lunes a Viernes</span>
                                            <span class="fw-bold">8:00 AM - 9:00 PM</span>
                                        </li>
                                        <li>
                                            <span>Sábados</span>
                                            <span class="fw-bold">9:00 AM - 7:00 PM</span>
                                        </li>
                                        <li>
                                            <span>Domingos</span>
                                            <span class="fw-bold">10:00 AM - 6:00 PM</span>
                                        </li>
                                    </ul>
                                </div>
                                
                                <div class="col-md-6">
                                    <h3 class="h5 mb-3">Atención Telefónica</h3>
                                    <ul class="hours-list">
                                        <li>
                                            <span>Lunes a Viernes</span>
                                            <span class="fw-bold">7:00 AM - 10:00 PM</span>
                                        </li>
                                        <li>
                                            <span>Sábados</span>
                                            <span class="fw-bold">8:00 AM - 8:00 PM</span>
                                        </li>
                                        <li>
                                            <span>Domingos</span>
                                            <span class="fw-bold">9:00 AM - 7:00 PM</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Formulario de Contacto y Mapa -->
    <section class="py-5 bg-light" id="contact-form">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-6">
                    <h2 class="section-title">Envíanos un Mensaje</h2>
                    <p class="mb-4">¿Tienes alguna pregunta o comentario? Completa el formulario y nos pondremos en contacto contigo lo antes posible.</p>
                    <form method="POST" action="contacto.php">
    <div class="row g-3">
        <div class="col-md-6">
            <label for="name" class="form-label">Nombre completo</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Tu nombre" required>
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@correo.com" required>
        </div>
        <div class="col-md-6">
            <label for="phone" class="form-label">Teléfono</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Tu número telefónico">
        </div>
        <div class="col-md-6">
            <label for="subject" class="form-label">Asunto</label>
            <select class="form-select" id="subject" name="subject" required>
                <option value="" selected disabled>Selecciona una opción</option>
                <option value="info">Información general</option>
                <option value="order">Consulta sobre pedido</option>
                <option value="product">Información de producto</option>
                <option value="complaint">Queja o sugerencia</option>
                <option value="other">Otro</option>
            </select>
        </div>
        <div class="col-12">
            <label for="message" class="form-label">Mensaje</label>
            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Escribe tu mensaje aquí..." required></textarea>
        </div>
        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="privacy" required>
                <label class="form-check-label" for="privacy">
                    He leído y acepto la <a href="#">política de privacidad</a>
                </label>
            </div>
        </div>
        <div class="col-12 mt-4">
            <button type="submit" class="btn btn-primary">Enviar mensaje</button>
        </div>
    </div>
</form>
                </div>
                
                <div class="col-lg-6" id="map">
                    <div class="map-container">
                        <!-- Aquí iría un mapa real, pero usamos un placeholder -->
                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background-color: #e5e7eb; color: #6b7280; font-weight: 500;">
                            <div class="text-center">
                                <i class="fas fa-map-marked-alt fa-4x mb-3 text-primary"></i>
                                <p>Aquí se mostraría el mapa interactivo</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gradient-to-r from-teal-600 to-blue-700 text-white py-12">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo y Descripción Breve -->
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center mb-4">
                    <img src="./img/logo5.jpg" alt="Logo Farmaventa" class="w-16 h-16 mr-4 rounded-full">
                    <h2 class="text-2xl font-bold">FarmaVenta</h2>
                </div>
                <p class="text-sm text-gray-200 mb-4">
                    Comprometidos con tu salud y bienestar. Ofrecemos productos farmacéuticos de calidad y servicio personalizado.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-white hover:text-blue-200 transition duration-300">
                        <i class="fab fa-facebook-f text-2xl"></i>
                    </a>
                    <a href="#" class="text-white hover:text-blue-200 transition duration-300">
                        <i class="fab fa-instagram text-2xl"></i>
                    </a>
                    <a href="#" class="text-white hover:text-blue-200 transition duration-300">
                        <i class="fab fa-twitter text-2xl"></i>
                    </a>
                </div>
            </div>

            <!-- Navegación -->
            <div>
                <h3 class="text-xl font-semibold mb-4 border-b border-blue-500 pb-2">Navegación</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-blue-200 transition duration-200">Inicio</a></li>
                    <li><a href="#" class="hover:text-blue-200 transition duration-200">Sobre Nosotros</a></li>
                    <li><a href="#" class="hover:text-blue-200 transition duration-200">Servicios</a></li>
                    <li><a href="#" class="hover:text-blue-200 transition duration-200">Farmacos</a></li>
                    <li><a href="#" class="hover:text-blue-200 transition duration-200">Contacto</a></li>
                </ul>
            </div>

            <!-- Información de Contacto -->
            <div>
                <h3 class="text-xl font-semibold mb-4 border-b border-blue-500 pb-2">Contáctanos</h3>
                <div class="space-y-2">
                    <p class="flex items-center">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        Av. de la Salud 1234, Ciudad
                    </p>
                    <p class="flex items-center">
                        <i class="fas fa-phone mr-2"></i>
                        (555) 123-4567
                    </p>
                    <p class="flex items-center">
                        <i class="fas fa-envelope mr-2"></i>
                        contacto@farmaventa.com
                    </p>
                    <p class="flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        Lun-Vie: 8:00 - 20:00
                    </p>
                </div>
            </div>
        </div>

        <!-- Línea de Copyright con Diseño Moderno -->
        <div class="mt-8 pt-6 border-t border-blue-600 text-center">
            <p class="text-sm text-gray-300">
                &copy; 2024 FarmaVenta. Todos los derechos reservados. 
                <span class="ml-4 hidden md:inline-block">
                    Desarrollado con ❤️ por Nuestro Equipo
                </span>
            </p>
        </div>
    </footer>

    <script>
    function toggleMenu() {
        const menu = document.getElementById('menu');
        menu.classList.toggle('active');
    }
</script>