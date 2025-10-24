// Selección de elementos del DOM
// Contenedor donde se mostrarán los anuncios filtrados
const contenedor = document.querySelector('.filtradoAnuncioListado'); 

// Botón para buscar anuncios por nombre
const buscarBtn = document.querySelector('button[name="bBuscarAnuncio"]'); 

// Campo de texto donde el usuario escribe el nombre del anuncio a buscar
const buscarInput = document.querySelector('input[name="buscarAnuncio"]'); 

// Selector para ordenar los anuncios por fecha o precio
const selectOrden = document.querySelector('#anuncioOrdenar'); 

//BÚSQUEDA POR NOMBRE

buscarBtn.addEventListener('click', async () => {
  // Obtener el texto ingresado y eliminar espacios al inicio y final
  const texto = buscarInput.value.trim();

  try {
    let response;

    if (!texto) {
      // Si el campo de búsqueda está vacío, obtener todos los anuncios
      response = await axios.get('index.php?controller=FiltradoController&accion=getAll');
    } else {
      // Si hay texto, buscar anuncios que coincidan con el nombre
      response = await axios.get(`index.php?controller=FiltradoController&accion=apiBuscarPorNombre&buscarAnuncio=${encodeURIComponent(texto)}`);
    }

    // Renderizar los anuncios obtenidos
    renderAnuncios(response.data);
  } catch (error) {
    console.error("Error al buscar por nombre:", error);
  }
});

//ORDENAR ANUNCIOS

if (selectOrden) {
  selectOrden.addEventListener('change', async () => {
    const valor = selectOrden.value; // Obtener la opción seleccionada

    try {
      let response;

      if (valor === 'Por fecha') {
        // Ordenar por fecha más reciente
        response = await axios.get('index.php?controller=FiltradoController&accion=apiOrdenarPorFecha');
      } else {
        // Ordenar por precio, ASC o DESC según la opción
        let orden = valor === 'Precio más alto' ? 'DESC' : 'ASC';
        response = await axios.get(`index.php?controller=FiltradoController&accion=apiOrdenarPorPrecio&orden=${orden}`);
      }

      // Renderizar los anuncios ordenados
      renderAnuncios(response.data);
    } catch (error) {
      console.error("Error al ordenar los anuncios:", error);
    }
  });
}

//FUNCIONALIDAD DE FAVORITOS

function activarFavoritos() {
  // Selecciona todos los botones de "favorito" y les añade un evento click
  document.querySelectorAll('.favoritoToggle').forEach(link => {
    link.addEventListener('click', async (e) => {
      e.preventDefault(); // Evitar que el enlace recargue la página
      const url = link.getAttribute('href'); // Obtener la URL que activa el favorito en el backend

      try {
        await axios.get(url); // Llamada al backend para añadir o quitar favorito
        location.reload(); // Recarga la página para reflejar los cambios
      } catch (error) {
        console.error('Error al cambiar favorito:', error);
      }
    });
  });
}

//RENDERIZAR ANUNCIOS DINÁMICAMENTE

function renderAnuncios(anuncios) {
  contenedor.innerHTML = ''; // Limpiar contenedor antes de mostrar nuevos resultados

  if (anuncios.length === 0) {
    // Si no hay anuncios, mostrar mensaje
    contenedor.innerHTML = '<p>No se encontraron anuncios.</p>';
    return;
  }

  // Recorrer los anuncios y crear elementos HTML dinámicamente
  anuncios.forEach(anuncio => {
    const box = document.createElement('div');
    box.classList.add('filtradoAnunciosAnuncioCard');

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

        ${usuarioLogueado ? `
        <a href="index.php?controller=FavoritosController&accion=existeFavorito&ID_Anuncio=${anuncio.ID_Anuncio}" 
          class="favoritoToggle ${favoritosUsuario.includes(anuncio.ID_Anuncio) ? 'favoritoActivo' : ''}" 
          data-id="${anuncio.ID_Anuncio}">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d='M9 10.5L11 12.5L15.5 8M19 21V7.8C19 6.11984 19 5.27976 18.673 4.63803C18.3854 4.07354 17.9265 3.6146 17.362 3.32698C16.7202 3 15.8802 3 14.2 3H9.8C8.11984 3 7.27976 3 6.63803 3.32698C6.07354 3.6146 5.6146 4.07354 5.32698 4.63803C5 5.27976 5 6.11984 5 7.8V21L12 17L19 21Z' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>
          </svg>
        </a>
      ` : ''}
      </div>
    `;

    contenedor.appendChild(box); // Añadir anuncio al contenedor
  });

  // Activar botones de favoritos en los anuncios recién renderizados
  if (usuarioLogueado) activarFavoritos();
}


//ACTIVAR FAVORITOS AL CARGAR LA PÁGINA
if (usuarioLogueado) activarFavoritos(); 
