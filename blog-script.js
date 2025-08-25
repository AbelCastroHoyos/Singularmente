// Variable para almacenar todos los artículos cargados
let allBlogArticles = [];
const pdfsPath = 'assets/pdfs/';
const imagesPath = 'assets/images/blog/';

// Función para cargar todos los artículos del blog
async function loadAllBlogArticles() {
    const blogAllArticlesContainer = document.querySelector('.blog-all-articles-container');
    const noResultsMessage = document.getElementById('noResultsMessage');

    if (!blogAllArticlesContainer) {
        console.warn('Contenedor de todos los artículos del blog no encontrado. Saltando la carga.');
        return;
    }

    try {
        const response = await fetch('data/articles.json'); // Asegúrate de que esta ruta sea correcta
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        allBlogArticles = await response.json(); // Guarda todos los artículos

        // Ordenar los artículos por fecha de forma descendente (más reciente primero)
        allBlogArticles.sort((a, b) => new Date(b.date) - new Date(a.date));

        displayBlogArticles(allBlogArticles); // Muestra todos los artículos inicialmente

    } catch (error) {
        console.error('Error al cargar todos los artículos del blog:', error);
        blogAllArticlesContainer.innerHTML = '<p class="error-message">No se pudieron cargar los artículos del blog en este momento. Por favor, inténtalo más tarde.</p>';
        if (noResultsMessage) noResultsMessage.style.display = 'block'; // Muestra el mensaje de error si aplica
    }
}

// Función para mostrar un conjunto de artículos (filtrados o todos)
function displayBlogArticles(articlesToDisplay) {
    const blogAllArticlesContainer = document.querySelector('.blog-all-articles-container');
    const noResultsMessage = document.getElementById('noResultsMessage');

    blogAllArticlesContainer.innerHTML = ''; // Limpiar el contenedor

    if (articlesToDisplay.length === 0) {
        if (noResultsMessage) noResultsMessage.style.display = 'block';
        return;
    } else {
        if (noResultsMessage) noResultsMessage.style.display = 'none';
    }

    articlesToDisplay.forEach(article => {
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
        blogAllArticlesContainer.insertAdjacentHTML('beforeend', articleHtml);
    });
}

// Función para filtrar artículos por texto de búsqueda
function filterBlogArticles() {
    const searchInput = document.getElementById('blogSearchInput');
    const clearButton = document.getElementById('clearSearchButton');
    const searchText = searchInput.value.toLowerCase();

    if (searchText.length > 0) {
        clearButton.style.display = 'block';
    } else {
        clearButton.style.display = 'none';
    }

    const filteredArticles = allBlogArticles.filter(article => {
        // Busca en título o extracto
        return article.title.toLowerCase().includes(searchText) ||
               article.excerpt.toLowerCase().includes(searchText);
    });

    displayBlogArticles(filteredArticles);
}

// Event Listeners para la búsqueda
document.addEventListener('DOMContentLoaded', () => {
    loadAllBlogArticles(); // Cargar todos los artículos al iniciar la página

    const searchInput = document.getElementById('blogSearchInput');
    const clearButton = document.getElementById('clearSearchButton');

    if (searchInput) {
        searchInput.addEventListener('input', filterBlogArticles); // Filtra en cada cambio de input
    }
    if (clearButton) {
        clearButton.addEventListener('click', () => {
            searchInput.value = ''; // Limpia el input
            filterBlogArticles(); // Muestra todos los artículos de nuevo
        });
    }
});