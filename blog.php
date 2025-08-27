<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - SingularMente</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles.css"> 
    <link rel="stylesheet" href="blog-styles.css"> 
</head>
<body>
    <header>
        <div class="container">
            <div class="menu-toggle" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>            
            <nav id="mainNav">
                <ul>
                    <li><a href="index.php#about">Inicio</a></li>
                    <li><a href="index.php#services">Servicios</a></li>
                    <li><a href="index.php#equipo">Equipo SingularMente</a></li>
                    <li><a href="index.php#testimonials">Testimonios</a></li>
                    <li><a href="index.php#contact">Contáctenos</a></li>
                    <li><a href="index.php#blog">Blog</a></li>
                    <li><a href="index.php#appointment-form" class="btn btn-primary scroll-to-form">Solicita tu Cita</a></li>
                </ul>
            </nav>
            <div class="social-icons">
            <!--<div class="social-links">-->
                    <a href="https://wa.me/573226530630?text=Hola,%20quiero%20saber%20más%20sobre%20los%20servicios%20de%20SINGULARMENTE." target="_blank"  alt="WhatsApp"><i class="fab fa-whatsapp fa-2x"></i></a>
                    <a href="https://www.instagram.com/singularmente_saludmental" target="_blank" alt="Instagram"><i class="fab fa-instagram fa-2x"></i></a>
                    <a href="#" target="_blank" alt="facebook"><i class="fab fa-facebook fa-2x"></i></a>
            </div>            
        </div>
    </header>

    <main class="blog-main-content">
        <div class="container">
            <h1 class="page-title">Todas las publicaciones</h1>
            <div class="search-section">
                <div class="search-container">
                    <label for="blogSearchInput" class="search-label"></label> <input type="text" id="blogSearchInput" placeholder="Buscar por título o contenido..." aria-label="Buscar artículos por título o contenido">
                    <button id="clearSearchButton" class="clear-search-btn" type="button" style="display: none;">X</button> </div>
            </div>
            <div class="blog-all-articles-container blog-cards">
                </div>

            <p id="noResultsMessage" style="display: none; text-align: center; margin-top: 30px;">No se encontraron artículos que coincidan con tu búsqueda.</p>
        </div>
    </main>

<!-- Footer -->
    <footer>
        <div class="container">
            <div class="logo">
                <img src="logo.png" alt="Logo">
            </div>
            <nav>
                <ul>
                <ul>
                    <li><a href="politica-de-privacidad.html" target="_blank">Política de Privacidad</a></li>
                    <li><a href="politica-de-privacidad.html" target="_blank">Emergencias Salud Mental</a></li>
                </ul>
                </ul>
            </nav>
            <div class="social-icons">
                <a href="#"><img src="Images/facebook-icon.svg" alt="Facebook"></a>
                <a href="#"><img src="Images/instagram-icon.svg" alt="Instagram"></a>
                <a href="#"><img src="Images/youtube-icon.svg" alt="YouTube"></a>
            </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date("Y"); ?> <strong>SingularMente.</strong> Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    <div id="toast-container"></div>
    <script src="script.js"></script> <script src="blog-script.js"></script> 
</body>
</html>