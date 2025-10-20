// 🔧 Selección de elementos del DOM
const contenedor = document.querySelector('.anuncioListado'); // Contenedor donde se mostrarán los anuncios
const buscarBtn = document.querySelector('button[name="bBuscarAnuncio"]'); // Botón de búsqueda por nombre
const buscarInput = document.querySelector('input[name="buscarAnuncio"]'); // Campo de texto para escribir el nombre del anuncio
const categoriaLinks = document.querySelectorAll('.anuncioFiltroCategorias a'); // Enlaces de las categorías para filtrar
const selectOrden = document.querySelector('#anuncioOrdenar'); // Selector para ordenar los anuncios por precio

// 🔍 Buscar por nombre al hacer clic en el botón
buscarBtn.addEventListener('click', async () => {
  const texto = buscarInput.value.trim(); // Obtiene el texto ingresado y elimina espacios
  if (!texto) return; // Si el campo está vacío, no hace nada

  try {
    // Realiza una petición GET al backend para buscar anuncios por nombre
    const response = await axios.get(`index.php?controller=FiltradoController&accion=apiBuscarPorNombre&texto=${encodeURIComponent(texto)}`);
    renderAnuncios(response.data); // Muestra los resultados en pantalla
  } catch (error) {
    console.error("Error al buscar por nombre:", error); // Muestra error en consola si la petición falla
  }
});

// 🧭 Filtrar por categoría al hacer clic en un enlace
categoriaLinks.forEach(link => {
  link.addEventListener('click', async (e) => {
    e.preventDefault(); // Evita que el enlace recargue la página
    const categoria = link.textContent.trim(); // Obtiene el nombre de la categoría desde el texto del enlace

    try {
      // Realiza una petición GET al backend para filtrar anuncios por categoría
      const response = await axios.get(`index.php?controller=FiltradoController&accion=apiPorCategoria&categoria=${encodeURIComponent(categoria)}`);
      renderAnuncios(response.data); // Muestra los resultados filtrados
    } catch (error) {
      console.error("Error al filtrar por categoría:", error); // Muestra error en consola si la petición falla
    }
  });
});

// 💰 Ordenar por precio al cambiar el valor del selector
selectOrden.addEventListener('change', async () => {
  const valor = selectOrden.value; // Obtiene el valor seleccionado
  let orden = 'ASC'; // Por defecto, orden ascendente
  if (valor === 'Precio más alto') orden = 'DESC'; // Si se selecciona "Precio más alto", cambia a descendente

  try {
    // Realiza una petición GET al backend para ordenar los anuncios por precio
    const response = await axios.get(`index.php?controller=FiltradoController&accion=apiOrdenarPorPrecio&orden=${orden}`);
    renderAnuncios(response.data); // Muestra los anuncios ordenados
  } catch (error) {
    console.error("Error al ordenar por precio:", error); // Muestra error en consola si la petición falla
  }
});

// 🧱 Función para renderizar los anuncios en el DOM
function renderAnuncios(anuncios) {
  contenedor.innerHTML = ''; // Limpia el contenedor antes de mostrar nuevos anuncios

  if (anuncios.length === 0) {
    contenedor.innerHTML = '<p>No se encontraron anuncios.</p>'; // Muestra mensaje si no hay resultados
    return;
  }

  // Recorre cada anuncio recibido y lo agrega al contenedor
  anuncios.forEach(anuncio => {
    const box = document.createElement('div'); // Crea un nuevo div para el anuncio
    box.classList.add('anuncioIndividual'); // Le asigna la clase CSS

    // Inserta el contenido HTML del anuncio dentro del div
    box.innerHTML = `
      <div class="misAnunciosImagen">
        <img src="./${anuncio.Url_imagen}" alt="${anuncio.nombreAnuncio}">
      </div>
      <div class="misAnunciosInfo">
        <h4>${anuncio.nombreAnuncio}</h4>
        <h5>${anuncio.usernameAnuncio}</h5>
        <p>${anuncio.descripcionAnuncio}</p>
        <p class="fechaAnuncio">${new Date(anuncio.Fecha_pub).toLocaleDateString()}</p>
        <div class="misAnunciosPrecio">
          <p>${anuncio.precioAnuncio} €</p>
        </div>
      </div>
    `;

    contenedor.appendChild(box); // Agrega el anuncio al contenedor principal
  });
}
