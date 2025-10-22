//Selección de elementos del DOM
const contenedor = document.querySelector('.filtradoAnuncioListado'); // Contenedor donde se mostrarán los anuncios
const buscarBtn = document.querySelector('button[name="bBuscarAnuncio"]'); // Botón de búsqueda por nombre
const buscarInput = document.querySelector('input[name="buscarAnuncio"]'); // Campo de texto para escribir el nombre del anuncio
const categoriaLinks = document.querySelectorAll('.anuncioFiltroCategorias a'); // Enlaces de las categorías para filtrar
const selectOrden = document.querySelector('#anuncioOrdenar'); // Selector para ordenar los anuncios por precio



// Buscar por nombre al hacer clic en el botón
buscarBtn.addEventListener('click', async () => {
  const texto = buscarInput.value.trim(); // Obtiene el texto ingresado y elimina espacios

  try {
    let response;

    if (!texto) {
      // Si el campo está vacío, se hace una petición para obtener todos los anuncios
      response = await axios.get('index.php?controller=FiltradoController&accion=getAll');
    } else {
      // Si hay texto, se hace una búsqueda por nombre
      response = await axios.get(`index.php?controller=FiltradoController&accion=apiBuscarPorNombre&texto=${encodeURIComponent(texto)}`);
    }

    renderAnuncios(response.data); // Muestra los resultados en pantalla
  } catch (error) {
    console.error("Error al buscar por nombre:", error); // Muestra error por consola si la petición falla
  }
});


// Filtrar por categoría al hacer clic en un enlace
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

// Ordenar por precio o fecha al cambiar el valor del selector
selectOrden.addEventListener('change', async () => {
  const valor = selectOrden.value; // Obtiene el valor seleccionado

  try {
    let response;

    if (valor === 'Por fecha') {
      // Si se selecciona "Por fecha", hace la petición correspondiente
      response = await axios.get('index.php?controller=FiltradoController&accion=apiOrdenarPorFecha');
    } else {
      // Si se selecciona orden por precio
      let orden = 'ASC'; // Por defecto, ascendente
      if (valor === 'Precio más alto') orden = 'DESC'; // Cambia a descendente si se selecciona esa opción

      response = await axios.get(`index.php?controller=FiltradoController&accion=apiOrdenarPorPrecio&orden=${orden}`);
    }

    renderAnuncios(response.data); // Renderiza los anuncios según la respuesta
  } catch (error) {
    console.error("Error al ordenar los anuncios:", error); // Muestra error en consola si la petición falla
  }
});

//Función para activarBotonesFavorito
function activarFavoritos() {
  document.querySelectorAll('.favoritoToggle').forEach(link => {
    link.addEventListener('click', async (e) => {
      e.preventDefault();
      const idAnuncio = link.dataset.id;

      try {
        const response = await axios.get(`index.php?controller=FavoritosController&accion=existeFavorito&ID_Anuncio=${idAnuncio}`);
        const estado = response.data.estado;

        if (estado === 'agregado') {
          link.classList.add('favoritoActivo');
          link.textContent = 'Favorito añadido';
        } else if (estado === 'eliminado') {
          link.classList.remove('favoritoActivo');
          link.textContent = 'Añadir a favoritos';
        }
      } catch (error) {
        console.error('Error al cambiar favorito:', error);
      }
    });
  });
}


//Función para renderizar los anuncios en el DOM
function renderAnuncios(anuncios) {
  contenedor.innerHTML = '';

  if (anuncios.length === 0) {
    contenedor.innerHTML = '<p>No se encontraron anuncios.</p>';
    return;
  }

  anuncios.forEach(anuncio => {
    const box = document.createElement('div');
    box.classList.add('anuncioIndividual');

    box.innerHTML = `
      <div class="filtradoAnunciosImagen">
        <img src="./${anuncio.Url_imagen}" alt="${anuncio.nombreAnuncio}">
      </div>
      <div class="filtradoAnunciosInfo">
        <h4>${anuncio.nombreAnuncio}</h4>
        <h5>${anuncio.usernameAnuncio}</h5>
        <p>${anuncio.descripcionAnuncio}</p>
        <p class="filtradoFechaAnuncio">${new Date(anuncio.Fecha_pub).toLocaleDateString()}</p>
        <div class="filtradoAnunciosPrecio">
          <p>${anuncio.precioAnuncio} €</p>
        </div>
       ${usuarioLogueado ?
          `
            <a href="#" class="favoritoToggle ${favoritosUsuario.includes(anuncio.ID_Anuncio) ? 'favoritoActivo' : ''}" data-id="${anuncio.ID_Anuncio}">
              ${favoritosUsuario.includes(anuncio.ID_Anuncio) ? 'Favorito añadido' : 'Añadir a favoritos'}
            </a>
          ` 
        : ''}

        </div>
    `;

    contenedor.appendChild(box);
  });

  // Activar favoritos si hay sesión
  if (usuarioLogueado) activarFavoritos();
}

