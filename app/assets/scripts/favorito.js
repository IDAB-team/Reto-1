//SELECCIÓN DE ELEMENTOS DEL DOM

// Contenedor donde se mostrarán los anuncios filtrados
const contenedorFavoritos = document.querySelector('.favoritoAnuncioListado'); // Contenedor donde se mostrarán los favoritos

// Botón para buscar anuncios por nombre
const buscarBtn = document.querySelector('button[name="bBuscarAnuncio"]'); // Botón para buscar favoritos

// Campo de texto donde el usuario escribe el nombre del anuncio a buscar
const buscarInput = document.querySelector('input[name="buscarAnuncio"]'); // Input de búsqueda

// Selector para ordenar los anuncios por fecha o precio
const selectOrden = document.querySelector('#anuncioOrdenar'); // Selector para ordenar favoritos

//FUNCIONALIDAD DE ELIMINAR FAVORITOS
function activarEliminarFavoritos() {
  if (!contenedorFavoritos) return; // Si no existe el contenedor, salir

  // Selecciona todos los enlaces de eliminar favorito
  document.querySelectorAll('.favoritoToggle').forEach(link => {
    link.addEventListener('click', async (e) => {
      e.preventDefault();

      // Siempre toma el href del <a>, aunque se haga click en el SVG o en el texto
      const url = e.currentTarget.href;

      try {
        await axios.get(url); // Llamada al backend para eliminar el favorito
        
        // Elimina la tarjeta del DOM
        const tarjeta = link.closest('.favoritoAnuncioCard');
        if (tarjeta) tarjeta.remove();

        // Si ya no hay favoritos, muestra mensaje
        if (contenedorFavoritos.children.length === 0) {
          contenedorFavoritos.innerHTML = '<p>No tienes anuncios favoritos aún.</p>';
        }
      } catch (error) {
        console.error('Error al eliminar favorito:', error);
      }
    });
  });
}

//RENDERIZAR FAVORITOS
function renderFavoritos(anuncios) {
  if (!contenedorFavoritos) return; // Salir si no hay contenedor

  contenedorFavoritos.innerHTML = ''; // Limpiar contenedor

  if (!anuncios || anuncios.length === 0) {
    contenedorFavoritos.innerHTML = '<p>No tienes anuncios favoritos aún.</p>';
    return;
  }

  // Crear elementos HTML por cada favorito
  anuncios.forEach(anuncio => {
    const box = document.createElement('div');
    box.classList.add('favoritoAnuncioCard');

    box.innerHTML = `
      <div class="favoritoAnunciosImagen">
        <img src="./${anuncio.Url_imagen}" alt="${anuncio.nombreAnuncio}">
      </div>
      <div class="favoritoAnunciosInfo">
        <h4>${anuncio.nombreAnuncio}</h4>
        <h5>${anuncio.usernameAnuncio}</h5>
        <p>${anuncio.descripcionAnuncio}</p>
        <p class="favoritoFechaAnuncio">${new Date(anuncio.Fecha_pub).toLocaleDateString()}</p>
        <div class="favoritoAnunciosPrecio">
          <p>${anuncio.precioAnuncio} €</p>
        </div>
        <a href="index.php?controller=FavoritosController&accion=existeFavorito&ID_Anuncio=${anuncio.ID_Anuncio}" 
           class="favoritoToggle favoritoActivo">
           <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d='M9 10.5L11 12.5L15.5 8M19 21V7.8C19 6.11984 19 5.27976 18.673 4.63803C18.3854 4.07354 17.9265 3.6146 17.362 3.32698C16.7202 3 15.8802 3 14.2 3H9.8C8.11984 3 7.27976 3 6.63803 3.32698C6.07354 3.6146 5.6146 4.07354 5.32698 4.63803C5 5.27976 5 6.11984 5 7.8V21L12 17L19 21Z' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>
          </svg>
        </a>
      </div>
    `;

    contenedorFavoritos.appendChild(box);
  });

  activarEliminarFavoritos(); // Activar los botones en los nuevos elementos
}

//BUSCAR FAVORITOS POR NOMBRE (solo al presionar botón)

if (buscarBtn && buscarInput) {
  buscarBtn.addEventListener('click', async () => {
    if (!contenedorFavoritos) return;

    const texto = buscarInput.value.trim(); // Obtener texto del input

    try {
      let response;

      if (!texto) {
        response = await axios.get('index.php?controller=FavoritosController&accion=getAll'); // Todos los favoritos
      } else {
        response = await axios.get(`index.php?controller=FavoritosController&accion=apiBuscarFavoritosPorNombre&texto=${encodeURIComponent(texto)}`); // Buscar por nombre
      }

      renderFavoritos(response.data); // Mostrar resultados
    } catch (error) {
      console.error("Error al buscar favoritos:", error);
    }
  });
}

// ORDENAR FAVORITOS POR FECHA O PRECIO

if (selectOrden) {
  selectOrden.addEventListener('change', async () => {
    if (!contenedorFavoritos) return;

    const valor = selectOrden.value;

    try {
      let response;

      if (valor === 'Por fecha') {
        response = await axios.get('index.php?controller=FavoritosController&accion=ordenarPorFecha');
      } else {
        const orden = valor === 'Precio más alto' ? 'DESC' : 'ASC';
        response = await axios.get(`index.php?controller=FavoritosController&accion=ordenarPorPrecio&orden=${orden}`);
      }

      renderFavoritos(response.data); // Renderizar favoritos ordenados
    } catch (error) {
      console.error("Error al ordenar favoritos:", error);
    }
  });
}

//ACTIVAR ELIMINAR FAVORITOS AL CARGAR LA PÁGINA
document.addEventListener('DOMContentLoaded', () => {
  activarEliminarFavoritos(); // Activar botones de eliminar para los favoritos ya cargados
});
