<?php
session_start();

// Establecer el idioma predeterminado
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'es'; // Español por defecto
}

// Cambiar el idioma si el usuario selecciona uno
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    if (in_array($lang, ['es', 'en', 'fr'])) { // Idiomas permitidos
        $_SESSION['lang'] = $lang;
    }
}

// Cargar las traducciones según el idioma seleccionado
$lang = $_SESSION['lang'];
$translations = [
    'es' => [
        'navigation' => 'Navegación',
        'home' => 'Inicio',
        'catalog' => 'Catálogo de Productos',
        'services' => 'Servicios',
        'promotions' => 'Promociones',
        'contact' => 'Contacto',
        'contact_us' => 'Contáctanos',
        'address' => 'Av. de la Salud 1234, Ciudad',
        'phone' => '(555) 123-4567',
        'email' => 'contacto@farmaventa.com',
        'hours' => 'Lun-Vie: 8:00 - 20:00',
        'copyright' => 'Todos los derechos reservados.',
        'developed_by' => 'Desarrollado con ❤️ por Nuestro Equipo',
    ],
    'en' => [
        'navigation' => 'Navigation',
        'home' => 'Home',
        'catalog' => 'Product Catalog',
        'services' => 'Services',
        'promotions' => 'Promotions',
        'contact' => 'Contact',
        'contact_us' => 'Contact Us',
        'address' => 'Health Avenue 1234, City',
        'phone' => '(555) 123-4567',
        'email' => 'contact@farmaventa.com',
        'hours' => 'Mon-Fri: 8:00 - 20:00',
        'copyright' => 'All rights reserved.',
        'developed_by' => 'Developed with ❤️ by Our Team',
    ],
    'fr' => [
        'navigation' => 'Navigation',
        'home' => 'Accueil',
        'catalog' => 'Catalogue de Produits',
        'services' => 'Services',
        'promotions' => 'Promotions',
        'contact' => 'Contact',
        'contact_us' => 'Contactez-nous',
        'address' => 'Avenue de la Santé 1234, Ville',
        'phone' => '(555) 123-4567',
        'email' => 'contact@farmaventa.com',
        'hours' => 'Lun-Ven: 8:00 - 20:00',
        'copyright' => 'Tous droits réservés.',
        'developed_by' => 'Développé avec ❤️ par Notre Équipe',
    ],
];
?>
 
 
 
 
 
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROYECTO SENE</title>
    <script src="https://kit.fontawesome.com/c1df782baf.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/c1df782baf.js"></script>
    <link rel="stylesheet" href="fontawesome-free-5.15.3-web/css/all.min.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-thin-rounded/css/uicons-thin-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="stylesheet" href="./css/estilo.css">
    <link rel="stylesheet" href="./css/servicio.css">

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
            <a href="index.php">Inicio</a>
            <a href="sobre.php">Sobre nosotros</a>
            <a href="">Servicios</a>
            <a href="farmacos.php">Farmacos</a>
          
            <a href="contacto.php">Contacto</a>
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


         <div class="technology">
            <div class="main-technology">
                
                <div class="inner-technology">
                    <span></span>
                    <i class="fi fi-tr-hands-heart"></i>
                    <h2>Calidad y Seguridad</h2>
                    <p>Nuestra farmacia @sene utiliza tecnología de vanguardia y emplea un equipo de verdaderos expertos en la especialidad.</p>
                </div>

                <div class="inner-technology">
                    <span></span>
                    <i class="fi fi-rr-doctor"></i>
                    <h2>Calidad y Seguridad</h2>
                    <p>Nuestra farmacia @sene utiliza tecnología de vanguardia y emplea un equipo de verdaderos expertos en la especialidad.</p>
                </div>

                <div class="inner-technology">
                    <span></span>
                    <i class="fi fi-tr-user-md"></i>
                    <h2>Calidad y Seguridad</h2>
                    <p>Nuestra farmacia @sene utiliza tecnología de vanguardia y emplea un equipo de verdaderos expertos en la especialidad.</p>
                </div>
            </div>
        </div> 

        <div class="service-section">
    <h2 id="ourservices">Nuestros servicios</h2>
    <div class="inner-service-section">
        <div class="service-box">
            <i class="fas fa-user-friends"></i>
        <h2>Buen Tratamiento</h2>
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
        </div>
        <div class="service-box">
            <i class="fas fa-clinic-medical"></i>
        <h2>Farma Venta</h2>
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
        </div>
        <div class="service-box">
            <i class="fas fa-user-plus"></i>
        <h2>Promocion</h2>
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
        </div>
        <div class="service-box">
            <i class="fas fa-ambulance"></i>
        <h2>Tratamiento Corporal</h2>
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
        </div>
    </div>
</div>



<div class="work-section">
    <div class="inner-work-section">
        <h1>Como Lo Hacemos</h1>
        <h3 class="text-work">
    En FarmaVenta nos dedicamos a ofrecer medicamentos de calidad, <br>
    garantizando la salud y el bienestar de nuestros pacientes. <br>
    Nuestro compromiso es brindar un servicio confiable y accesible para todos.
</h3>
            <div class="myimages">
                <div class="inner-images">
                    <img src="img/team6.jpg" alt="">
                    <p> Dra. Ana Lucia 
                        ut perspiciatis unde omnis iste natus error si</p>
                    
                </div>
                <div class="inner-images">
                    <img src="img/team5.jpg" alt="">
                    <p> Dr. Jose Luis Nga
                        ut perspiciatis unde omnis iste natus error si</p>
                    
                </div>
            </div>
        </div>
    <div class="inner-work-section scnclass">
        <h2>Nuestra Creatividad</h2>
        <p class="creative-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
        <a href="#" class="btn"><i class="fas fa-play-circle"></i> <span> Tratamiento corporal</span></a>
        <p class="creative-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
        <a href="#" class="btn"><i class="fas fa-play-circle"></i> <span> Tratamiento corporal</span></a>
        <a href="#" class="btn"><i class="fas fa-play-circle"></i> <span> Tratamiento corporal</span></a>
        <a href="#" class="btn"><i class="fas fa-play-circle"></i> <span> Tratamiento corporal</span></a>
    </div>
</div>


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
                    <li><a href="#" class="hover:text-blue-200 transition duration-200">Catálogo de Productos</a></li>
                    <li><a href="#" class="hover:text-blue-200 transition duration-200">Servicios</a></li>
                    <li><a href="#" class="hover:text-blue-200 transition duration-200">Promociones</a></li>
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
</body>