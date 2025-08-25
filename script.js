function toggleMenu() {
    const menuToggle = document.querySelector('.menu-toggle');
    const nav = document.getElementById('mainNav');
    menuToggle.classList.toggle('active');
    nav.classList.toggle('active');
}

// Efecto de desplazamiento al hacer scroll
window.addEventListener('scroll', () => {
    const helpSection = document.querySelector('.help-section');
    const helpCard = document.querySelector('.help-card');
    const sectionTop = helpSection.getBoundingClientRect().top;

    if (sectionTop < 0) {
        helpSection.classList.add('scrolled');
    } else {
        helpSection.classList.remove('scrolled');
    }
});

// Configuración del carrusel
const carouselTrack = document.querySelector('.carousel-track');
const carouselItems = document.querySelectorAll('.carousel-item');
const prevButton = document.querySelector('.carousel-button.prev');
const nextButton = document.querySelector('.carousel-button.next');
const dotsContainer = document.querySelector('.carousel-dots');

let currentIndex = 0;
let isTransitioning = false; // Evitar múltiples transiciones simultáneas

// Crear puntos indicadores
carouselItems.forEach((_, index) => {
    const dot = document.createElement('div');
    dot.classList.add('carousel-dot');
    if (index === 0) dot.classList.add('active');
    dot.addEventListener('click', () => moveToIndex(index));
    dotsContainer.appendChild(dot);
});

function moveToIndex(index) {
    if (isTransitioning) return;

    if (index >= carouselItems.length) {
        index = 0;
    } else if (index < 0) {
        index = carouselItems.length - 1;
    }

    isTransitioning = true;
    const offset = -index * 100;
    carouselTrack.style.transform = `translateX(${offset}%)`;

    // Actualizar puntos
    document.querySelectorAll('.carousel-dot').forEach((dot, i) => {
        if (i === index) {
            dot.classList.add('active');
        } else {
            dot.classList.remove('active');
        }
    });

    currentIndex = index;
}

// Clonar el primer y último elemento para un carrusel infinito suave
const firstItemClone = carouselItems[0].cloneNode(true);
const lastItemClone = carouselItems[carouselItems.length - 1].cloneNode(true);

carouselTrack.appendChild(firstItemClone);
carouselTrack.insertBefore(lastItemClone, carouselItems[0]);

// Ajustar la posición inicial para el clon del primer elemento
carouselTrack.style.transition = 'none';
carouselTrack.style.transform = `translateX(-100%)`; // Mueve al clon del último elemento
void carouselTrack.offsetWidth; // Trigger reflow
carouselTrack.style.transition = 'transform 0.5s ease-in-out';

// Manejar la transición y el "salto" para el infinito
carouselTrack.addEventListener('transitionend', () => {
    isTransitioning = false;
    if (currentIndex === carouselItems.length) {
        carouselTrack.style.transition = 'none';
        carouselTrack.style.transform = `translateX(-100%)`;
        currentIndex = 0;
        document.querySelectorAll('.carousel-dot').forEach((dot, i) => {
            if (i === currentIndex) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });
        void carouselTrack.offsetWidth; // Trigger reflow
        carouselTrack.style.transition = 'transform 0.5s ease-in-out';
    } else if (currentIndex === -1) {
        carouselTrack.style.transition = 'none';
        carouselTrack.style.transform = `translateX(-${carouselItems.length * 100}%)`;
        currentIndex = carouselItems.length - 1;
        document.querySelectorAll('.carousel-dot').forEach((dot, i) => {
            if (i === currentIndex) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });
        void carouselTrack.offsetWidth; // Trigger reflow
        carouselTrack.style.transition = 'transform 0.5s ease-in-out';
    }
});

prevButton.addEventListener('click', () => {
    if (isTransitioning) return;
    isTransitioning = true;
    currentIndex--;
    const offset = -currentIndex * 100 - 100; // Ajuste para los clones
    carouselTrack.style.transform = `translateX(${offset}%)`;

    // Actualizar puntos
    document.querySelectorAll('.carousel-dot').forEach((dot, i) => {
        if (i === (currentIndex === -1 ? carouselItems.length - 1 : currentIndex)) {
            dot.classList.add('active');
        } else {
            dot.classList.remove('active');
        }
    });
});

nextButton.addEventListener('click', () => {
    if (isTransitioning) return;
    isTransitioning = true;
    currentIndex++;
    const offset = -currentIndex * 100 - 100; // Ajuste para los clones
    carouselTrack.style.transform = `translateX(${offset}%)`;

    // Actualizar puntos
    document.querySelectorAll('.carousel-dot').forEach((dot, i) => {
        if (i === (currentIndex === carouselItems.length ? 0 : currentIndex)) {
            dot.classList.add('active');
        } else {
            dot.classList.remove('active');
        }
    });
});


// Auto-avance del carrusel
/*
let autoplayInterval;
function startAutoplay() {
    autoplayInterval = setInterval(() => {
        nextButton.click(); // Simula un clic en el botón Siguiente
    }, 5000); // Cambia cada 5 segundos
}

function stopAutoplay() {
    clearInterval(autoplayInterval);
}

// Iniciar auto-avance cuando la página carga
startAutoplay();

// Detener/reanudar en hover
carouselTrack.addEventListener('mouseenter', stopAutoplay);
carouselTrack.addEventListener('mouseleave', startAutoplay);
*/


// ------------------------------------------------------------------------------------------------
// Funcionalidad de Modales y Formulario de Citas
// ------------------------------------------------------------------------------------------------

// Captura de elementos del DOM
const appointmentForm = document.querySelector('.appointment-form');
const privacyConsentModal = document.getElementById('privacyConsentModal');
const noConsentModal = document.getElementById('noConsentModal');
const acceptPrivacyBtn = document.getElementById('acceptPrivacy');
const denyPrivacyBtn = document.getElementById('denyPrivacy');
const closeNoConsentBtn = document.getElementById('closeNoConsent');
const acceptCheckbox = document.getElementById('acceptCheckbox');
const submitButton = document.querySelector('.appointment-form button[type="submit"]'); // Asumiendo que el botón submit es el único tipo submit en el formulario
const toastContainer = document.getElementById('toast-container');


// Función para mostrar un modal
function showModal(modalElement) {
    if (modalElement) {
        modalElement.style.display = 'flex'; // Usar flex para centrado
        modalElement.classList.add('show');
    }
}

// Función para ocultar un modal
function hideModal(modalElement) {
    if (modalElement) {
        modalElement.classList.remove('show');
        modalElement.addEventListener('transitionend', function handler() {
            modalElement.style.display = 'none';
            modalElement.removeEventListener('transitionend', handler);
        }, { once: true });
    }
}

// Función para mostrar mensajes toast
function showToast(message, type = 'info', duration = 5000) {
    const toast = document.createElement('div');
    toast.classList.add('toast');
    toast.classList.add(type); // 'success', 'error', 'info'

    let iconHtml = '';
    if (type === 'success') {
        iconHtml = '<i class="fas fa-check-circle icon"></i>';
    } else if (type === 'error') {
        iconHtml = '<i class="fas fa-times-circle icon"></i>';
    } else {
        iconHtml = '<i class="fas fa-info-circle icon"></i>';
    }

    toast.innerHTML = `${iconHtml} <span>${message}</span>`;

    toastContainer.appendChild(toast);

    // Forzar reflow para la animación de entrada
    void toast.offsetWidth;
    toast.classList.add('show');

    setTimeout(() => {
        toast.classList.remove('show');
        toast.addEventListener('transitionend', () => toast.remove());
    }, duration);
}

// Función para manejar el estado de carga del formulario
function setFormLoading(isLoading) {
    if (isLoading) {
        submitButton.disabled = true;
        submitButton.textContent = 'Enviando...';
        // Opcional: añadir un spinner si tienes uno en CSS
        // submitButton.classList.add('loading');
    } else {
        submitButton.disabled = false;
        submitButton.textContent = 'Solicitar Cita';
        // submitButton.classList.remove('loading');
    }
}

// Función para enviar la solicitud de cita a la API
async function submitAppointment(fullName, phone, email, date, serviceType) {
    setFormLoading(true);
    try {
        const formData = {
            action: 'submit_appointment',
            fullName,
            phone,
            email,
            date,
            serviceType
        };

        const response = await fetch('api.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(formData)
        });

        if (!response.ok) {
            // Manejar respuestas HTTP no exitosas (400, 500, etc.)
            const errorText = await response.text(); // Leer como texto para ver el error PHP si lo hay
            console.error('Error de red o servidor (HTTP no OK):', response.status, errorText);
            showToast('Error de servidor: No se pudo completar la solicitud de cita. Por favor, inténtalo de nuevo más tarde.', 'error');
            setFormLoading(false);
            return; // Salir de la función
        }

        const data = await response.json();

        if (data.success) {
            showToast(data.message || '¡Gracias por solicitar tu cita! Nos pondremos en contacto contigo pronto.', 'success');
            appointmentForm.reset();
        } else {
            showToast(data.message || 'Ha ocurrido un error al procesar tu solicitud.', 'error');
        }
        setFormLoading(false);

    } catch (error) {
        console.error('Error general en la solicitud de cita:', error);
        showToast('Ha ocurrido un error al conectar con el servidor. Por favor, inténtalo de nuevo más tarde.', 'error');
        setFormLoading(false);
    }
}

// Manejador del envío principal del formulario
appointmentForm.addEventListener('submit', async (event) => {
    event.preventDefault(); // Evita el envío tradicional del formulario

    // Captura los valores del formulario
    const fullName = document.getElementById('fullname').value;
    const phone = document.getElementById('phone').value;
    const email = document.getElementById('email').value;
    const date = document.getElementById('date').value;
    const serviceType = document.getElementById('service-type').value;

    // Validación básica
    if (!fullName || !phone || !email || !date || !serviceType) {
        showToast('Por favor, completa todos los campos obligatorios, incluyendo el tipo de servicio.', 'error');
        return;
    }

    setFormLoading(true); // Inicia estado de carga

    // Primer paso: Verificar consentimiento
    try {
        const checkConsentResponse = await fetch('api.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'check_consent', email: email })
        });

        if (!checkConsentResponse.ok) {
            const errorText = await checkConsentResponse.text();
            console.error('Error de red o servidor al verificar consentimiento (HTTP no OK):', checkConsentResponse.status, errorText);
            showToast('Error al verificar el consentimiento. Por favor, inténtalo de nuevo más tarde.', 'error');
            setFormLoading(false);
            return;
        }

        const consentData = await checkConsentResponse.json();

        if (consentData.success && consentData.has_consent) {
            // El usuario ya dio consentimiento, proceder directamente con el envío de la cita
            await submitAppointment(fullName, phone, email, date, serviceType);
        } else if (consentData.success && !consentData.has_consent) {
            // No ha dado consentimiento, mostrar el modal de privacidad
            showModal(privacyConsentModal);

            // Guardar datos temporalmente para usarlos después de la aceptación
            privacyConsentModal.dataset.formData = JSON.stringify({ fullName, phone, email, date, serviceType });
            setFormLoading(false); // Desactivar carga porque esperamos interacción del usuario
        } else {
            // Manejar errores de la API al verificar el consentimiento
            showToast(consentData.message || 'Error desconocido al verificar el consentimiento.', 'error');
            setFormLoading(false);
        }
    } catch (error) {
        console.error('Error general al verificar el consentimiento:', error);
        showToast('Ha ocurrido un error de conexión al verificar el consentimiento. Por favor, inténtalo de nuevo más tarde.', 'error');
        setFormLoading(false);
    }
});

// Listener para el checkbox de aceptación en el modal de privacidad
acceptCheckbox.addEventListener('change', () => {
    if (acceptCheckbox.checked) {
        acceptPrivacyBtn.disabled = false;
    } else {
        acceptPrivacyBtn.disabled = true;
    }
});

// Listener para el botón "Aceptar y Continuar" del modal de privacidad
acceptPrivacyBtn.addEventListener('click', async () => {
    hideModal(privacyConsentModal); // Ocultar modal de privacidad

    setFormLoading(true); // Activar estado de carga

    const formData = JSON.parse(privacyConsentModal.dataset.formData);
    const { fullName, phone, email, date, serviceType } = formData;

    try {
        const recordConsentResponse = await fetch('api.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'record_consent', email: email, accepted: true })
        });

        if (!recordConsentResponse.ok) {
            const errorText = await recordConsentResponse.text();
            console.error('Error de red o servidor al registrar consentimiento (HTTP no OK):', recordConsentResponse.status, errorText);
            showToast('Error al registrar el consentimiento. Por favor, inténtalo de nuevo.', 'error');
            setFormLoading(false);
            return;
        }

        const recordConsentData = await recordConsentResponse.json();

        if (recordConsentData.success) {
            showToast(recordConsentData.message || '¡Consentimiento registrado con éxito! Procesando tu cita...', 'success');
            // Ahora que el consentimiento está registrado, proceder con el envío de la cita
            await submitAppointment(fullName, phone, email, date, serviceType);
        } else {
            showToast(recordConsentData.message || 'Error al registrar el consentimiento.', 'error');
            setFormLoading(false);
        }
    } catch (error) {
        console.error('Error general al registrar el consentimiento:', error);
        showToast('Ha ocurrido un error de conexión al registrar el consentimiento.', 'error');
        setFormLoading(false);
    }
    // No reseteamos el formulario aquí, se hace en submitAppointment
});

// Listener para el botón "No Acepto" del modal de privacidad
denyPrivacyBtn.addEventListener('click', () => {
    hideModal(privacyConsentModal);
    showModal(noConsentModal); // Mostrar modal de "no consentimiento"
    setFormLoading(false); // Asegurarse de desactivar el estado de carga
    appointmentForm.reset(); // Reiniciar formulario si no acepta
});

// Listener para cerrar el modal de "Atención" (no consentimiento)
closeNoConsentBtn.addEventListener('click', () => {
    hideModal(noConsentModal);
});

// Ocultar modales al hacer clic fuera del contenido (opcional, pero útil)
window.addEventListener('click', (event) => {
    if (event.target === privacyConsentModal) {
        hideModal(privacyConsentModal);
    }
    if (event.target === noConsentModal) {
        hideModal(noConsentModal);
    }
});

// Función para cargar y mostrar los 3 artículos más recientes del blog
async function loadRecentBlogArticles() {
    const blogCardsContainer = document.querySelector('.blog-cards'); // *** CORRECTO: Selector '.blog-cards' ***
    const pdfsPath = 'assets/pdfs/'; // Ruta donde están tus PDFs
    const imagesPath = 'assets/images/blog/'; // Ruta donde están tus miniaturas PNG

    if (!blogCardsContainer) {
        console.warn('Contenedor de artículos del blog (".blog-cards") no encontrado. Saltando la carga.');
        return;
    }

    try {
        const response = await fetch('data/articles.json'); // Asegúrate de que esta ruta sea correcta
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const articles = await response.json();

        // Ordenar los artículos por fecha de forma descendente (más reciente primero)
        articles.sort((a, b) => new Date(b.date) - new Date(a.date));

        // Seleccionar los 3 artículos más recientes
        const recentArticles = articles.slice(0, 3);

        blogCardsContainer.innerHTML = ''; // Limpiar cualquier contenido estático previo

        recentArticles.forEach(article => {
            // Formatear la fecha a un formato más legible (ej. "15 de febrero de 2025")
            const articleDate = new Date(article.date).toLocaleDateString('es-ES', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            const articleHtml = `
                <div class="blog-card">
                    <a href="${pdfsPath}${article.pdf_file}" target="_blank">
                        <img src="${imagesPath}${article.image}" alt="${article.title}" class="blog-image">
                    </a>
                    <h3 class="blog-post-title">
                        <a href="${pdfsPath}${article.pdf_file}" target="_blank">${article.title}</a>
                    </h3>
                    <p class="blog-date">${articleDate}</p>
                    <p class="blog-post-excerpt">${article.excerpt}</p>
                    <a href="${pdfsPath}${article.pdf_file}" target="_blank" class="blog-read-more">Leer más</a>
                </div>
            `;
            blogCardsContainer.insertAdjacentHTML('beforeend', articleHtml);
        });

    } catch (error) {
        console.error('Error al cargar los artículos del blog:', error);
        blogCardsContainer.innerHTML = '<p class="error-message">No se pudieron cargar los artículos del blog en este momento. Por favor, inténtalo más tarde.</p>';
    }
}

// Llamar a la función cuando el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', loadRecentBlogArticles);

// --- Smooth Scroll para enlaces de ancla ---
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault(); // Evita el comportamiento predeterminado de salto brusco

        // Obtiene el ID de la sección (por ejemplo, '#about')
        const targetId = this.getAttribute('href');

        // Si estamos en la misma página (index.php) o si el enlace es a otra página y luego a un ancla
        if (targetId.startsWith('#')) {
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                // Calcula la posición para el scroll, ajustando por el header fijo
                const headerOffset = document.querySelector('header')?.offsetHeight || 0; // Obtiene la altura del header si existe
                const elementPosition = targetElement.getBoundingClientRect().top + window.scrollY;
                const offsetPosition = elementPosition - headerOffset - 5; // Resta la altura del header y un poco más de padding

                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth" // Hace el scroll suave
                });

                // Cierra el menú móvil si está abierto (asumiendo tu función toggleMenu)
                const mainNav = document.getElementById('mainNav');
                if (mainNav && mainNav.classList.contains('active')) {
                    toggleMenu(); // Llama a tu función para cerrar el menú
                }
            }
        }
    });
});

// Este bloque es para cuando el usuario llega a index.php desde otra página (ej. blog.php)
// con un hash en la URL (ej. index.php#services)
document.addEventListener('DOMContentLoaded', () => {
    if (window.location.hash) {
        const targetId = window.location.hash;
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            const headerOffset = document.querySelector('header')?.offsetHeight || 0;
            const elementPosition = targetElement.getBoundingClientRect().top + window.scrollY;
            const offsetPosition = elementPosition - headerOffset - 5;

            // Espera un poco para asegurar que la página y el header estén renderizados
            setTimeout(() => {
                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            }, 100); // Pequeño retraso para asegurar el correcto cálculo
        }
    }
});