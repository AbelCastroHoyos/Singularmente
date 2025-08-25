<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salud Mental - Psicología y Neuropsicología</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="menu-toggle" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>            
            <nav id="mainNav">
                <ul>
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="#services">Servicios</a></li>
                    <li><a href="#equipo">Equipo Singularmente</a></li>
                    <li><a href="#testimonials">Testimonios</a></li>
                    <li><a href="#contact">Contáctenos</a></li>
                    <li><a href="#blog">Blog</a></li> 
                    <li><a href="#appointment-form" class="btn btn-primary scroll-to-form">Solicita tu Cita</a></li>
                </ul>
            </nav>
            <div class="social-icons">
            <!--<div class="social-links">-->
                    <a href="https://wa.me/573226530630?text=Hola,%20quiero%20saber%20más%20sobre%20los%20servicios%20de%20SINGULARMENTE." target="_blank"  alt="WhatsApp"><i class="fab fa-whatsapp fa-2x"></i></a>
                    <a href="https://www.instagram.com/singularmente_saludmental" target="_blank" alt="Instagram"><i class="fab fa-instagram fa-2x"></i></a>
                    <a href="#" target="_blank" alt="facebook"><i class="fab fa-facebook fa-2x"></i></a>
            </div>
<!--                 <a href="#"><img src="Images/facebook-icon.svg" alt="Facebook"></a>
                <a href="#"><img src="Images/instagram-icon.svg" alt="Instagram"></a>
                <a href="#"><img src="Images/youtube-icon.svg" alt="YouTube"></a>
 -->            
            <!--</div>-->
    </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="inicio">
        <div class="container">
            <div class="hero-text">
                <div class="hero-logo">
                    <img src="Images/logo.png" alt="Logo">
                </div>
                <p class="subtitle">Si requieres acompañamiento especializado para cuidar tu salud mental y comprender tus experiencias vitales, tenemos un equipo dispuesto para ti. Trabajamos con profesionalismo, calidez y dedicación.</p>
                <h1>Salud Mental<br>Psicología y Neuropsicología</h1>
                <div class="buttons">
                    <!--button>Solicita tu cita</button-->
                    <a href="#appointment-form" class="btn btn-primary scroll-to-form">Solicita tu Cita</a>
                    <button>Aprende más</button>
                </div>
            </div>
            <div class="hero-image">
                <img src="Images/psychologist.jpg" alt="Psicóloga">
            </div>
        </div>
    </section>

        <!-- Sección de Estadísticas -->
        <section class="stats" id="stats">
            <div class="container">
                <!-- Texto superior -->
                <div class="stats-header">
                    <p class="stats-subtitle">Estadísticas</p>
                    <h2>Nuestros resultados en números</h2>
                </div>
    
                <!-- Tres círculos marrones -->
                <div class="circles">
                    <div class="circle"></div>
                    <div class="circle"></div>
                    <div class="circle"></div>
                </div>
    
                <!-- Tres columnas de resultados -->
                <div class="stats-grid">
                    <div class="stat-item">
                        <p class="stat-label">Pacientes atendidos</p>
                        <p class="stat-number">+ 1,000</p>
                        <p class="stat-description">En el ejercicio profesional</p>
                    </div>
                    <div class="stat-item">
                        <p class="stat-label">Sesiones realizadas</p>
                        <p class="stat-number">+ 26,300</p>
                        <p class="stat-description">con éxito comprobado</p>
                    </div>
                    <div class="stat-item">
                        <p class="stat-label">Experiencia</p>
                        <p class="stat-number">8 Años</p>
                        <p class="stat-description">Promedio por profesional</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tercera Sección: Acerca de y Nuestro Equipo -->
        <section class="about-team" id="equipo">
            <div class="container">
                <!-- Columna izquierda: Acerca de -->
                <div class="about-column">
                    <p class="about-subtitle">Acerca de</p>
                    <h2 class="about-title">Singularmente - Salud Mental</h2>
                    <div class="circles">
                        <div class="circle"></div>
                        <div class="circle"></div>
                        <div class="circle"></div>
                    </div>
                    <p class="about-text">En SINGULARMENTE somos el resultado de un concierto de cinco voces de mujeres profesionales en salud mental que escuchan la complejidad de ser humano, voces polinizantes en un espacio de vida. Aunamos teoría y práctica para identificar factores de riesgo y factores protectores, vulnerabilidades y potencialidades en el caso a caso. Lo hacemos desde enfoques diferenciales que reconocen la integralidad de las personas desde las dimensiones de lo biológico, el contexto, lo vivido y el sentido de la experiencia en relaciones intersubjetivas.</p>
                    <br>
                    <p class="about-text">En SINGULARMENTE promovemos el autocuidado, la capacidad de resignificar de manera única una experiencia, para así tomar nuevas iniciativas. Protegemos un enfoque de derecho donde la salud mental no es un objetivo, sino más bien un recurso a preservar.</p>
                    <br>
                    <p class="about-text">Ofrecemos servicios de coworking profesional con la posibilidad de pertenecer a nuestro staff clínico para compartir desde la formulación de casos, diversas experiencias de intervención desde el campo de la psicología clínica en sus diferentes enfoques y con una mirada integrativa.</p>
                </div>

                <!-- Columna derecha: Nuestro Equipo -->
                <div class="team-column">
                    <h2 class="team-title">Nuestro Equipo</h2>
                    <!-- Miembro 1 -->
                    <div class="team-member">
                        <div class="member-photo">
                            <img src="Images/Monica.jpg" alt="Mónica Echeverry">
                        </div>
                        <div class="member-info">
                            <h3 class="member-name">Mónica María Gaitán R.</h3>
                            <p class="member-description">Psicología clínica, con experiencia desde hace casi 10 años. En la actualidad con una maestría en formación, en clínica psicológica basada en razonamiento clínico de enfoque integrativo.
                                Practico el oficio de la escucha con calma y con la disposición necesaria para alojar lo más auténtico de cada quien, lo disruptivo y lo imprevisible.</p>
                        </div>
                    </div>
                    <!-- Miembro 2 -->
                    <div class="team-member">
                        <div class="member-photo">
                            <img src="Images/Natalia.jpg" alt="Natalia Giraldo">
                        </div>
                        <div class="member-info">
                            <h3 class="member-name">Natalia Giraldo</h3>
                            <p class="member-description">Psicóloga, Magíster en Neuropsicología con 6 años de experiencia en el ámbito clínico, enfocada en procesos de evaluación, diagnóstico y rehabilitación cognitiva personalizada en niños y adultos, bajo un enfoque interdisciplinario que posibilite intervenciones efectivas y mejorar la calidad de vida de los pacientes.</p>
                        </div>
                    </div>
                    <!-- Miembro 3 -->
                    <div class="team-member">
                        <div class="member-photo">
                            <img src="Images/vanessaR.jpg" alt="Vanessa Restrepo Muñoz">
                        </div>
                        <div class="member-info">
                            <h3 class="member-name">Vanessa Restrepo</h3>
                            <p class="member-description">Magíster en psicología clínica de enfoque dinámico, 8 años de experiencia en terapias con adolescentes y adultos, acompañando procesos encaminados a encontrar una verdad subjetiva que permita construir formas de habitar el mundo con sentido.</p>
                        </div>
                    </div>
                    <!-- Miembro 4
                    <div class="team-member">
                        <div class="member-photo">
                            <img src="Images/VanessaS.jpg" alt="Vanessa Serna">
                        </div>
                        <div class="member-info">
                            <h3 class="member-name">Vanessa Serna</h3>
                            <p class="member-description">Psicóloga clínica, con 8 años de experiencia, en el área Gestaltica, Magister en formación en Psicoterapia e Intérprete de Lengua de Señas. Además, conferencista y tallerista experiencial. Enfoque en orientación a jóvenes, adultos y personas en situación de discapacidad (Síndrome de Down, Leve, Moderado, Personas Sordas) junto a sus familias, para identificar estrategias de capacidad autónomas para una vida enfocada en el aquí y ahora.</p>
                        </div>
                    </div> -->
                    <!-- Miembro 5 -->
                    <div class="team-member">
                        <div class="member-photo">
                            <img src="Images/Tania.jpg" alt="Tania Henao">
                        </div>
                        <div class="member-info">
                            <h3 class="member-name">Tania Cardona</h3>
                            <p class="member-description">Psicóloga clínica, con 8 años de experiencia trabajando el trauma y diversas situaciones perturbadoras de la vida. Me enfoco en acompañar al paciente para que resignifique sus vivencias dolorosas  y elabore nuevas formas de vincularse en el mundo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<!-- Cuarta Sección: Ventajas -->
<section class="advantages" id="advantages">
    <div class="container">
        <!-- Título y subtítulo -->
        <p class="advantages-subtitle">Ventajas</p>
        <h2 class="advantages-title">¿Por qué elegirnos?</h2>

        <!-- Tres puntos decorativos -->
        <div class="circles">
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
        </div>

        <!-- Texto descriptivo -->
        <p class="advantages-description">
            Muchos clientes en el Valle de Aburra nos eligen. Ofrecemos terapia de<br>
            salud mental efectiva en grupos e individualmente.
        </p>

        <!-- Tarjetas de ventajas -->
        <div class="advantages-cards">
            <!-- Tarjeta 1 -->
            <div class="card">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="60" height="60">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17v-2h2v2h-2zm2.07-7.75-.9.92C12.45 15.3 12 16 12 17h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"/>
                    </svg>
                </div>
                <h3 class="card-title">Experiencia y Profesionalismo</h3>
                <p class="card-text">Nuestro equipo cuenta con formación profesional y nivel de maestría o estudios especializados que permiten brindar una atención con calidad, además de la experiencia en clínica que posibilita un acompañamiento personalizado de acuerdo con las necesidades de los pacientes.</p>
            </div>

            <!-- Tarjeta 2 -->
            <div class="card">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="60" height="60">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3-13.5V9h-4v2h4v2.5l3.5-3.5zm-6 4L5.5 9 6 8.5 8.5 11H6v2h2.5z"/>
                    </svg>
                </div>
                <h3 class="card-title">Enfoque Interdisciplinario</h3>
                <p class="card-text">Integramos la psicología, neuropsicología y otras áreas de la salud para proporcionar intervenciones personalizadas y basadas en evidencia. Trabajamos en coordinación con especialistas, asegurando una evaluación profunda y un tratamiento integral que potencia el bienestar emocional, cognitivo y conductual de cada paciente.</p>
            </div>

            <!-- Tarjeta 3 -->
            <div class="card">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="60" height="60">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-4h2v2h-2zm0-10h2v6h-2z"/>
                    </svg>
                </div>
                <h3 class="card-title">Acompañamiento y Confianza</h3>
                <p class="card-text">Brindamos un espacio seguro y empático donde los pacientes pueden expresarse sin temor. Creemos en la importancia del acompañamiento continuo, permitiendo que cada persona avance en su proceso con el apoyo adecuado para alcanzar su equilibrio emocional y bienestar.</p>
            </div>
        </div>
    </div>
</section>

<!-- Quinta Sección: Ayuda y Soporte -->
<section class="help-section" id="help">
    <!-- Imagen de fondo -->
    <div class="background-image"></div>

    <!-- Tarjeta semitransparente -->
    <div class="help-card">
        <p class="help-subtitle">Ayuda y soporte</p>
        <h2 class="help-title">Puedes confiar en nosotros</h2>
        <div class="circles">
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
        </div>
        <p class="help-text bold">La vida nos presenta momentos retadores a todos y en ocasiones no contamos con las estrategias adecuadas para manejarlos o nos quedamos encerrados en una sola perspectiva de la realidad. No necesitas atravesar por esas circunstancias en soledad, recibir atención psicológica y neuropsicológica a tiempo puede ayudarte a tener una mejor calidad de vida, tomar decisiones asertivas, considerar otras perspectivas, ser funcional, vivir con propósito y entender qué experiencias te han llevado a ser lo que eres, para elegir continuar con tu camino desde la aceptación o cambiar de rumbo con determinación, sensibilidad y conciencia.</p>
        <p class="help-text">En Singularmente brindamos un acompañamiento humano y profesional, respetando siempre las particularidades de cada persona con la que trabajamos y honrando la confianza que depositan en nosotros con una práctica profesional orientada por el principio de no maleficencia y una total confidencialidad de los procesos.</p>
    </div>
</section>

<!-- Sección de Servicios -->
<section class="services" id="services">
    <div class="container">
        <!-- Texto superior -->
        <p class="services-subtitle">Qué Ofrecemos</p>
        <h2 class="services-title">Servicios</h2>

        <!-- Puntos decorativos -->
        <div class="circles">
            <div class="decorative-circle"></div>
            <div class="decorative-circle"></div>
            <div class="decorative-circle"></div>
        </div>

        <!-- Descripción -->
        <p class="services-description">
            Te ofrecemos todos los servicios necesarios para tu salud Psicológica y Neuropsicológica.
        </p>

        <!-- Carrusel de servicios -->
        <div class="carousel">
            <!-- Flecha izquierda -->
            <button class="carousel-button prev" aria-label="Anterior">&#10094;</button>

            <!-- Contenedor de los elementos del carrusel -->
            <div class="carousel-track">
                <!-- Elemento 4: Terapia infantil -->
                <div class="carousel-item">
                    <img src="Images/Psicologia Infantil.jpg" alt="Terapia infantil">
                    <h2>Psicología infantil</h2>
                    <p>Busca apoyar a los niños para comprender y manejar sus emociones - comportamientos. Asimismo, proporcionar estrategias de afrontamiento en situaciones difíciles de la vida diaria, entornos familiares y habilidades para la vida.</p>
                    <!--<p class="price">$90K por sesión</p>-->
                </div>

                <!-- Elemento 1: Sesiones individuales -->
                <div class="carousel-item">
                    <img src="Images/Psicologia Adolescentes.JPG" alt="Psicología adolescentes">
                    <h2>Psicología adolescentes</h2>
                    <p>En esta etapa vital que está atravesada por tantos cambios y preguntas acerca de la identidad, el cuerpo, las relaciones familiares y  sociales; en ocasiones surge mucha confusión,  podemos acompañar a tejer respuestas y encontrar formas adecuadas de vivir y entender la adolescencia.</p>
                    <!--<p class="price">$100K por sesión</p>-->
                </div>

                <!-- Elemento 2: Terapia de pareja -->
                <div class="carousel-item">
                    <img src="Images/Terapia de Pareja.jpg" alt="Terapia de pareja">
                    <h2>Terapia de pareja</h2>
                    <p>La expresión de los pensamientos y emociones de manera empática y respetuosa es fundamental en el establecimiento de vínculos saludables. Te acompañamos en este proceso y te brindamos estrategias.</p>
                    <!--<p class="price">$120K por sesión</p>-->
                </div>

                <!-- Elemento 3: Depresión y duelo -->
                <div class="carousel-item">
                    <img src="Images/Psicología Adultos.JPG" alt="Psicología jovenes y adultos">
                    <h2>Psicología jovenes y adultos</h2>
                    <p>Acompañamiento terapéutico en el cual se promueve un espacio seguro y confidencial para abordar las diferentes necesidades de cada individuo, favoreciendo el bienestar emocional y la salud mental.</p>
                    <!--<p class="price">$110K por sesión</p>-->
                </div>

                <!-- Elemento 5: Tratamiento post traumático -->
                <div class="carousel-item">
                    <img src="Images/Terapia familiar.jpg" alt="Terapia familiar">
                    <h2>Terapia familiar</h2>
                    <p>Este espacio favorece la comunicación entre los miembros del hogar, posibilitando la sana expresión emocional, el fortalecimiento de vínculos afectivos y herramientas para el manejo de los conflictos.</p>
                    <!--<p class="price">$110K por sesión</p>-->
                </div>

                <!-- Elemento 6: Neuropsicología -->
                <div class="carousel-item">
                    <img src="Images/Evaluacion Neuropsicologica.JPG" alt="Neuropsicología">
                    <h2>Evaluación Neuropsicologica</h2>
                    <p>A través de pruebas especializadas, analizamos capacidad intelectual y funciones como memoria, atención, lenguaje y funcionamiento ejecutivo para identificar necesidades y diseñar intervenciones personalizadas. Ideal para diagnósticos y planes de tratamiento.</p>
                    <!--<p class="price">$130K por sesión</p>-->
                </div>

                <!-- Elemento 6: Rehabilitación Neuropsicología -->
                <div class="carousel-item">
                    <img src="Images/Rehabilitación Neuropsicologica.jpg" alt="Reabilitación Neuropsicología">
                    <h2>Rehabilitación Neuropsicologica</h2>
                    <p>Nuestro servicio esta diseñado para niños, jóvenes y adultos que presenten dificultades en procesos cognitivos como la atención, memoria, lenguaje, funcionamiento ejecutivo y dispositivos de aprendizaje; pero también para aquellos que deseen realizar estimulación y entrenamiento de sus capacidades.</p>
                    <!--<p class="price">$130K por sesión</p>-->
                </div>

                <!-- Elemento 6: Talleres de estimulación cognitiva para adultos mayores -->
                <div class="carousel-item">
                    <img src="Images/Estimulacion Cognitiva Adultos.jpg" alt="Talleres estimulación cognitiva">
                    <h2>Estimulación cognitiva adultos</h2>
                    <p>Sesiones grupales que ayudan a mantener las habilidades cognitivas como la memoria, la atención, el lenguaje y las funciones ejecutivas, ademas de prevenir el deterioro y disminuir el impacto de enfermedades neurodegenerativas. También fomentan la interacción social y bienestar emocional.</p>
                    <!--<p class="price">$130K por sesión</p>-->
                </div>

                <!-- Elemento 6: Terapias de lectoescritura para niños -->
                <div class="carousel-item">
                    <img src="Images/Talleres de Lectoescritura.jpg" alt="Talleres estimulación cognitiva">
                    <h2>Talleres de lectoescritura</h2>
                    <p>Se realizan tanto individuales como grupales según necesidad. El objetivo es apoyar el acceso y desarrollo de los dispositivos básicos de aprendizaje (lectura, escritura y cálculo) para niños que estén presentando dificultades y alteraciones en estos procesos.</p>
                    <!--<p class="price">$130K por sesión</p>-->
                </div>

                <!-- Elemento 7: Alquiler de consultorios -->
                <div class="carousel-item">
                    <img src="Images/office-rental.jpg" alt="Alquiler de consultorios">
                    <h2>Alquiler de consultorios</h2>
                    <p>Singular Mente es un coworking especializado en salud mental, cuenta con 5 consultorios equipados para la práctica clínica. Ideal para atender a niños, jóvenes y adultos, brindando flexibilidad en alquiler por horas o paquetes. Ofrecemos un espacio cómodo, seguro y acogedor, diseñado para profesionales comprometidos con el bienestar mental. Cada detalle está pensado para enriquecer la experiencia de terapeutas y pacientes.</p>
                    <!--<p class="price">$25K por hora</p>-->
                </div>
            </div>

            <!-- Flecha derecha -->
            <button class="carousel-button next" aria-label="Siguiente">&#10095;</button>
        </div>

        <!-- Puntos indicadores -->
        <div class="carousel-dots">
            <!-- Los puntos se generan dinámicamente con JavaScript -->
        </div>
    </div>
</section>

<!-- Sección de Formulario -->
<section class="form-section" id="appointment-form">
    <!-- Imagen de fondo -->
    <div class="background-image"></div>

    <!-- Formulario -->
    <div class="form-card">
        <h2 class="form-title">SOLICITAR CITA</h2>
        <p class="form-subtitle">Agenda una cita con nosotros</p>
        <!-- Puntos decorativos -->
        <div class="circles">
            <div class="decorative-circle"></div>
            <div class="decorative-circle"></div>
            <div class="decorative-circle"></div>
        </div>

        <!-- Descripción -->
        <p class="form-description">
             Regálate la oportunidad de cuidar de tu salud mental con un profesional altamente calificado para acompañarte.
        </p>

        <!-- Formulario -->
        <form class="appointment-form">
            <!-- Campo: Nombre completo -->
            <div class="form-group">
                <label for="fullname">Ingresa tu nombre completo*</label>
                <input type="text" id="fullname" name="fullname" placeholder="Nombre completo" required>
            </div>

            <!-- Campo: Tipo de servicio -->
            <div class="form-group">
                <label for="service-type">Seleccione el tipo de servicio*</label>
                <select id="service-type" name="service-type" required>
                    <option value="">-- Seleccionar Servicio --</option>  <option value="Psicología">Psicología</option>
                    <option value="Neuropsicología">Neuropsicología</option>
                    <option value="Alquiler Consultorio">Alquiler Consultorio</option>
                </select>
            </div>
            

            <!-- Campo: Número de teléfono -->
            <div class="form-group">
                <label for="phone">Ingresa tu número de teléfono*</label>
                <input type="tel" id="phone" name="phone" placeholder="Número de teléfono" required>
            </div>

            <!-- Campo: Correo electrónico -->
            <div class="form-group">
                <label for="email">Ingresa tu e-mail*</label>
                <input type="email" id="email" name="email" placeholder="Correo electrónico" required>
            </div>

            <!-- Campo: Selección de fecha -->
            <div class="form-group">
                <label for="date">Elegir fecha*</label>
                <input type="date" id="date" name="date" required>
            </div>

            <!-- Botón de enviar -->
            <button type="submit" class="submit-button">Enviar</button>
        </form>
    </div>
</section>

<!-- Sección de Testimonios -->
<section class="testimonials" id="testimonials">
    <div class="container">
        <!-- Texto superior -->
        <p class="testimonials-subtitle">Testimonios</p>
        <h2 class="testimonials-title">Lo que dicen de Singularmente</h2>

        <!-- Puntos decorativos -->
        <div class="circles">
            <div class="decorative-circle"></div>
            <div class="decorative-circle"></div>
            <div class="decorative-circle"></div>
        </div>

        <!-- Descripción -->
        <p class="testimonials-description">
            Cada mes, ayudamos a más de 45 personas a encontrar el equilibrio y la paz mental.
        </p>

        <!-- Tarjetas de testimonios -->
        <div class="testimonials-cards">
            <!-- Tarjeta 1 -->
            <div class="testimonial-card">
                <div class="patient-photo">
                    <img src="Images/Sara_Vera.png" alt="Sara Vera García">
                </div>
                <h3 class="patient-name">Sara Vera García</h3>
                <div class="separator"></div>
                <p class="patient-testimonial">
                    Excelente servicio, muy ordenados, el lugar es impecable, muy amables y atentas. Todo el que ingresa al lugar menciona que la energía que se siente es increíble. Súper recomendado tanto para profesionales como para pacientes! ✨ El calor hogareño y la magia son el distintivo de este lugar.
                </p>
            </div>

            <!-- Tarjeta 2 -->
            <div class="testimonial-card">
                <div class="patient-photo">
                    <img src="Images/Carolina_Ceballos.png" alt="Carolina Ceballos R.">
                </div>
                <h3 class="patient-name">Carolina Ceballos R.</h3>
                <div class="separator"></div>
                <p class="patient-testimonial">
                    Es un excelente centro de apoyo, yo e tenido el placer de estar en consulta con la psicóloga Mónica Gaitán y actualmente mi hijo está en Diagnóstico con la Neuro Natalia y se a sentido muy feliz, el lugar es demasiado acogedor y hace que te sientas feliz 🥰🥰 ... Recomiendo a sus profesionales y la experiencia que allí se vive 💞.
                </p>
            </div>

            <!-- Tarjeta 3 -->
            <div class="testimonial-card">
                <div class="patient-photo">
                    <img src="Images/Maria_R.png" alt="María R. Londoño">
                </div>
                <h3 class="patient-name">María R. Londoño</h3>
                <div class="separator"></div>
                <p class="patient-testimonial">
                    Excelente trabajo, La experiencia y el profesionalismo de las personas y del lugar es increíble y muy acogedor, Mi psicóloga es Tania Cardona. excelente en lo que hace, con su energía, amor y esplendor crea alegría y tranquilidad, pero sobre todo impulso, motivación.
Bastante recomendado!! ❤️‍🩹.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Sección de Preguntas Frecuentes -->
<section class="faq" id="faq">
    <div class="container">
        <!-- Texto superior -->
        <p class="faq-subtitle">Preguntas más frecuentes</p>
        <h2 class="faq-title">Preguntas frecuentes</h2>

        <!-- Puntos decorativos -->
        <div class="circles">
            <div class="decorative-circle"></div>
            <div class="decorative-circle"></div>
            <div class="decorative-circle"></div>
        </div>

        <!-- Contenedor de preguntas y respuestas -->
        <div class="faq-grid">
            <!-- Pregunta 1 -->
            <div class="faq-item">
                <div class="faq-question">
                    <span class="decorative-circle"></span>
                    <h3>¿Cómo y cuándo saber que necesito ayuda profesional psicológica?</h3>
                </div>
                <p class="faq-answer">
                    Cuando atravesamos una situación que sobrepase nuestra capacidad de respuesta, donde ni las estrategias de afrontamiento ya creadas a lo largo de la vida nos resultan útiles. Sobre todo cuando el malestar, la incomodidad, el dolor y el sufrimiento están afectando de manera significativa nuestras áreas importantes de la vida.
                </p>
            </div>

            <!-- Pregunta 2 -->
            <div class="faq-item">
                <div class="faq-question">
                    <span class="decorative-circle"></span>
                    <h3>¿Cuánto dura una terapia?</h3>
                </div>
                <p class="faq-answer">
                    El tiempo es relativo, y dependerá siempre de quien consulte y lo que desee trabajar en la terapia, su compromiso y responsabilidad con la misma, y por supuesto, de su ciclo vital. Incluso hay consultantes que asumen la responsabilidad de tener un terapeuta como guía en decisiones importantes, durante tiempos prolongados.
                </p>
            </div>

            <!-- Pregunta 3 -->
            <div class="faq-item">
                <div class="faq-question">
                    <span class="decorative-circle"></span>
                    <h3>¿Todos los psicólogos hacen lo mismo?</h3>
                </div>
                <p class="faq-answer">
                    No. Existen diferentes modelos y tipos de terapia. Por eso es tan importante que tengas muy claro qué buscas trabajar. Existen psicólogos que se enfocan en las relaciones de tu infancia y tipos de apego para sanarlos, otros que se enfocan en el presente y los pensamientos negativos para abordarlos de manera afirmativa, otros se enfocan en corregir la conducta, otros que trabajan en la resignificación de experiencias traumáticas, etc.
                </p>
            </div>

            <!-- Pregunta 4 -->
            <div class="faq-item">
                <div class="faq-question">
                    <span class="decorative-circle"></span>
                    <h3>¿Para qué ir a terapia?</h3>
                </div>
                <p class="faq-answer">
                    Ir terapia es una experiencia donde aprenderás a construir estrategias para vivir mejor contigo mismo y por ende con los demás. Se puede trabajar en las relaciones, los pensamientos, las emociones y las acciones que tomamos frente a determinadas situaciones.
                </p>
            </div>

            <!-- Pregunta 5 -->
            <div class="faq-item">
                <div class="faq-question">
                    <span class="decorative-circle"></span>
                    <h3>¿Lo que hablo con un terapeuta es confidencial?</h3>
                </div>
                <p class="faq-answer">
                    Los psicólogos tienen dentro de su código ético profesional la obligación de garantizar el secreto profesional. Será revelada sólo con el consentimiento de la persona o si lo exije la ley, excepto en aquellas circunstancias particulares donde existe un riesgo inminente para la persona o terceros.
                </p>
            </div>

            <!-- Pregunta 6 -->
            <div class="faq-item">
                <div class="faq-question">
                    <span class="decorative-circle"></span>
                    <h3>¿Qué decirle a un psicólogo en la primera consulta?</h3>
                </div>
                <p class="faq-answer">
                    Puedes intentar compartir qué te llevó a buscar ayuda, cómo te sientes emocionalmente en el presente, contarle si has notado cambios en ti, qué esperas lograr en terapia. El psicólogo te guiará y ayudará a expresarte a tu propio ritmo.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Sección de Eventos Gratuitos -->
<section class="events" id="events">
    <div class="container">
        <!-- Texto superior -->
        <p class="events-subtitle">Unete</p>
        <h2 class="events-title">Eventos Gratuitos</h2>

        <!-- Puntos decorativos -->
        <div class="circles">
            <div class="decorative-circle"></div>
            <div class="decorative-circle"></div>
            <div class="decorative-circle"></div>
        </div>

        <!-- Descripción -->
        <p class="events-description">
            A menudo organizamos eventos públicos gratuitos que pueden ayudar a todos a conocerse mejor a sí mismos.
        </p>

        <!-- Listado de eventos -->
        <div class="events-list">
            <!-- Evento 1 -->
            <div class="event-item">
                <!-- Columna 1: Fecha -->
                <div class="event-date">
                    <span class="event-day">20</span>
                    <span class="event-month">Febrero</span>
                </div>

                <!-- Columna 2: Nombre y tipo de evento -->
                <div class="event-info">
                    <h3 class="event-name">Trastornos de la alimentación en jovenes entre los 15 y los 25 años</h3>
                    <p class="event-type">Conferencia</p>
                </div>

                <!-- Columna 3: Dirección y horario -->
                <div class="event-location">
                    <p class="event-address">Camara de comercio Calle 38 Sur 45-45</p>
                    <p class="event-time">17:00 - 18:30</p>
                </div>

                <!-- Columna 4: Botón de registro -->
                <div class="event-action">
                    <a href="#" class="register-button">Registrarse</a>
                </div>
            </div>

            <!-- Línea divisoria -->
            <div class="event-divider"></div>

            <!-- Evento 2 -->
            <div class="event-item">
                <div class="event-date">
                    <span class="event-day">25</span>
                    <span class="event-month">Febrero</span>
                </div>
                <div class="event-info">
                    <h3 class="event-name">Razones para hacer trampa</h3>
                    <p class="event-type">Conferencia</p>
                </div>
                <div class="event-location">
                    <p class="event-address">Casa de la Juventud Carrera 43 36Sur-25</p>
                    <p class="event-time">18:00 - 19:00</p>
                </div>
                <div class="event-action">
                    <a href="#" class="register-button">Registrarse</a>
                </div>
            </div>

            <!-- Línea divisoria -->
            <div class="event-divider"></div>

            <!-- Evento 3 -->
            <div class="event-item">
                <div class="event-date">
                    <span class="event-day">03</span>
                    <span class="event-month">Marzo</span>
                </div>
                <div class="event-info">
                    <h3 class="event-name">Inteligencia artificial y Psicología experimental, una aproximación</h3>
                    <p class="event-type">Conversatorio</p>
                </div>
                <div class="event-location">
                    <p class="event-address">Singularmente Trasnv 32A Sur 31E - 36</p>
                    <p class="event-time">18:00 - 19:30</p>
                </div>
                <div class="event-action">
                    <a href="#" class="register-button">Registrarse</a>
                </div>
            </div>
        </div>

        <!-- Botón para ver más eventos (si hay más de 3) -->
        <div class="events-more">
            <button class="more-button">Ver más eventos</button>
        </div>
    </div>
</section>

<!-- Sección del Blog -->
<section class="blog" id="blog">
    <div class="container">
        <!-- Texto superior -->
        <p class="blog-subtitle">Blog</p>
        <h2 class="blog-title">Descubra artículos interesantes sobre salud mental y bienestar.</h2>

        <!-- Puntos decorativos -->
        <div class="circles">
            <div class="decorative-circle"></div>
            <div class="decorative-circle"></div>
            <div class="decorative-circle"></div>
        </div>

        <!-- Descripción -->
        <p class="blog-description">
            Queremos compartir contigo novedades escritas por investigadores y publicaciones relevnates en salud mental.
        </p>

        <!-- Tarjetas de publicaciones -->
        <div class="blog-cards">
        </div>

        <!-- Botón "Leer más" -->
        <div class="blog-more">
            <a href="blog.php" class="more-button">Ver todas las publicaciones</a>
        </div>
    </div>
</section>

<!-- Sección de Contacto y Mapa -->
<section class="contact-map" id="contact">
    <!-- Tarjeta de contacto -->
    <div class="contact-card">
        <div class="contact-contact">
            <div class="contact-content">
                <p class="contact-subtitle">Programe una visita</p>
                <h2 class="contact-title">Contacto</h2>

                <!-- Puntos decorativos -->
                <div class="circles">
                    <div class="decorative-circle"></div>
                    <div class="decorative-circle"></div>
                    <div class="decorative-circle"></div>
                </div>

                <!-- Subtítulo -->
                <h3 class="contact-subheading">Singular Mente</h3>

                <!-- Dirección -->
                <p class="contact-address">
                    Transversal 32A Sur Nro. 31E - 36<br>
                    Barrio La Magnolia, Envigado
                </p>

                <!-- Teléfono y correo -->
                <p class="contact-info">
                    +57 322 653 06 30<br>
                    info@singularmente.com.co
                </p>

                <!-- Íconos de redes sociales -->
                <div class="social-icons">
                    <a href="#"><img src="Images/facebook-icon.svg" alt="Facebook"></a>
                    <a href="#"><img src="Images/instagram-icon.svg" alt="Instagram"></a>
                    <a href="#"><img src="Images/youtube-icon.svg" alt="YouTube"></a>
                </div>

                <!-- Botón "Solicitar cita previa" -->
                 <a href="#appointment-form" class="btn btn-primary scroll-to-form">Solicita tu Cita</a>
            </div>
        </div>
    </div>

    <!-- Mapa de Google Maps -->
    <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d991.6654109692632!2d-75.58275301598415!3d6.176030892476212!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e468250906533d9%3A0x861fe381dd8143d9!2sTv.%2032a%20Sur%20%2331e-36%2C%20Zona%209%2C%20Envigado%2C%20Antioquia!5e0!3m2!1sen!2sco!4v1739752603271!5m2!1sen!2sco" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</section>

<!-- Footer -->
    <footer>
        <div class="container">
            <div class="logo">
                <img src="logo.png" alt="Logo">
            </div>
            <nav>
                <ul>
                    <li><a href="politica-de-privacidad.html" target="_blank">Política de Privacidad</a></li>
                    <li><a href="politica-de-privacidad.html" target="_blank">Emergencias Salud Mental</a></li>
                </ul>
            </nav>
            <div class="social-icons">
                <a href="#"><img src="Images/facebook-icon.svg" alt="Facebook"></a>
                <a href="#"><img src="Images/instagram-icon.svg" alt="Instagram"></a>
                <a href="#"><img src="Images/youtube-icon.svg" alt="YouTube"></a>
            </div>
        </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date("Y"); ?> Singularmente. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    <div id="privacyConsentModal" class="modal">
        <div class="modal-content">
            <h2>Aviso de Privacidad y Tratamiento de Datos Personales</h2>
            <p>En *Singularmente*, recolectamos sus datos de identificación, contacto, financieros y, de forma indispensable para su tratamiento, *datos sensibles de salud mental (diagnósticos e historial clínico)*.</p>
            <p>Estos datos son necesarios para la prestación de nuestros servicios terapéuticos, facturación y comunicaciones relevantes. *No compartimos sus datos con terceros.*</p>
            <p>Al aceptar, confirma haber leído y comprendido nuestra completa <a href="politica-de-privacidad.html" target="_blank">Política de Tratamiento de Datos Personales</a>, donde se detallan las finalidades, sus derechos y los canales para ejercerlos. La entrega de datos sensibles es facultativa, aunque su no autorización podría impedir la prestación del servicio.</p>

            <div class="checkbox-container">
                <input type="checkbox" id="acceptCheckbox">
                <label for="acceptCheckbox">He leído y acepto la Política de Tratamiento de Datos Personales de Singularmente.</label>
            </div>

            <div class="modal-buttons">
                <button id="acceptPrivacy" class="btn btn-primary" disabled>Aceptar y Continuar</button>
                <button id="denyPrivacy" class="btn btn-secondary">No Acepto</button>
            </div>
        </div>
    </div>

    <div id="noConsentModal" class="modal">
        <div class="modal-content">
            <h2>Atención</h2>
            <p>Para poder procesar tu solicitud de cita, es indispensable que nos autorices el uso de tus datos personales. Sin esta autorización, no podemos gestionar tu reserva.</p>
            <div class="modal-buttons">
                <button id="closeNoConsent" class="btn btn-primary">Entendido</button>
            </div>
        </div>
    </div>
    <div id="toast-container"></div>
    <script src="script.js"></script>
    
</body>
</html>