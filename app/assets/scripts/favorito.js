const contenedorFavoritos = document.querySelector('.favoritoAnuncioListado');
const buscarBtn = document.querySelector('button[name="bBuscarAnuncio"]');
const buscarInput = document.querySelector('input[name="buscarAnuncio"]');
const selectOrden = document.querySelector('#anuncioOrdenar');

function toggleFavorito() {
  document.querySelectorAll('.favoritoToggle').forEach(link => {
    link.addEventListener('click', async (e) => {
      e.preventDefault();
      const url = link.getAttribute('href');
      try {
        await axios.get(url);
        link.classList.toggle('favoritoActivo');
      } catch (error) {
        console.error('Error al cambiar favorito:', error);
      }
    });
  });
}

function renderFavoritos(anuncios) {
  contenedorFavoritos.innerHTML = '';
  if (!anuncios || anuncios.length === 0) {
    contenedorFavoritos.innerHTML = '<p>No tienes anuncios favoritos aún.</p>';
    return;
  }

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
        <p class="favoritoFechaAnuncio">${new Date(anuncio.fechaAnuncio).toLocaleDateString()}</p>
        <div class="favoritoAnunciosPrecio">
          <p>${anuncio.precioAnuncio} €</p>
        </div>
        <a href="index.php?controller=FavoritosController&accion=existeFavorito&ID_Anuncio=${anuncio.ID_Anuncio}" 
           class="favoritoToggle favoritoActivo">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d='M9 10.5L11 12.5L15.5 8M19 21V7.8C19 6.11984 19 5.27976 18.673 4.63803C18.3854 4.07354 17.9265 3.6146 17.362 3.32698C16.7202 3 15.8802 3 14.2 3H9.8C8.11984 3 7.27976 3 6.63803 3.32698C6.07354 3.6146 5.6146 4.07354 5.32698 4.63803C5 5.27976 5 6.11984 5 7.8V21L12 17L19 21Z' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>
          </svg>
        </a>
      </div>
    `;
    contenedorFavoritos.appendChild(box);
  });

  toggleFavorito();
}

// Busqueda
buscarBtn.addEventListener('click', async () => {
  const texto = buscarInput.value.trim();
  try {
    let response;
    if (!texto) {
      response = await axios.get('index.php?controller=FavoritosController&accion=getAll');
    } else {
      response = await axios.get(`index.php?controller=FavoritosController&accion=apiBuscarFavoritosPorNombre&texto=${encodeURIComponent(texto)}`);
    }
    renderFavoritos(response.data);
  } catch (error) {
    console.error('Error al buscar favoritos:', error);
  }
});

// Orden
selectOrden.addEventListener('change', async () => {
  const valor = selectOrden.value;
  try {
    let response;
    if (valor === 'Por fecha') {
      response = await axios.get('index.php?controller=FavoritosController&accion=ordenarPorFecha');
    } else {
      const orden = valor === 'Precio más alto' ? 'DESC' : 'ASC';
      response = await axios.get(`index.php?controller=FavoritosController&accion=ordenarPorPrecio&orden=${orden}`);
    }
    renderFavoritos(response.data);
  } catch (error) {
    console.error('Error al ordenar favoritos:', error);
  }
});

document.addEventListener('DOMContentLoaded', () => {
  toggleFavorito();
});
