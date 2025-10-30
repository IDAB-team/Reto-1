// Variables globales desde PHP
// usuarioLogueado = true/false
// favoritosUsuario = [ID_Anuncio, ...]

const contenedor = document.querySelector('.filtradoAnuncioListado');
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

function renderAnuncios(anuncios) {
  contenedor.innerHTML = '';
  if (anuncios.length === 0) {
    contenedor.innerHTML = '<p>No se encontraron anuncios.</p>';
    return;
  }

anuncios.forEach(anuncio => {
  const box = document.createElement('div');
  box.classList.add('filtradoAnunciosAnuncioCard');

  box.innerHTML = `
    <div class="filtradoAnunciosImagen">
      <a href="index.php?controller=AnuncioController&accion=getAnuncioById&idAnuncio=${anuncio.ID_Anuncio}">
        <img src="./${anuncio.Url_imagen}" alt="${anuncio.nombreAnuncio}">
      </a>
    </div>

    <div class="filtradoFechaAnuncio">
      <p>${new Date(anuncio.fechaAnuncio).toLocaleDateString()}</p>
    </div>

    <div class="filtradoAnunciosInfo">
      <div class="filtradoInfoHeader">
        <div class="filtradoInfoTextos">
          <a class="aNombre" href="index.php?controller=AnuncioController&accion=getAnuncioById&idAnuncio=${anuncio.ID_Anuncio}">
            <h4>${anuncio.nombreAnuncio}</h4>
          </a>
          <a class="aVendedor" href="index.php?controller=VendedorController&idAnuncio=${anuncio.ID_Anuncio}">
            ${anuncio.usernameAnuncio}
          </a>
        </div>
        <div class="filtradoAnunciosPrecio">
          <p>${anuncio.precioAnuncio} €</p>
        </div>
      </div>

      <p class="filtradoDescripcion">${anuncio.descripcionAnuncio}</p>

      ${usuarioLogueado ? `
      <div class="filtradoAnuncioFavorito">
        <p>Favorito</p>
        <a href="index.php?controller=FavoritosController&accion=existeFavorito&ID_Anuncio=${anuncio.ID_Anuncio}" 
           class="favoritoToggle ${favoritosUsuario.includes(anuncio.ID_Anuncio) ? 'favoritoActivo' : ''}">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
            <path d='M9 10.5L11 12.5L15.5 8M19 21V7.8C19 6.11984 19 5.27976 18.673 4.63803C18.3854 4.07354 17.9265 3.6146 17.362 3.32698C16.7202 3 15.8802 3 14.2 3H9.8C8.11984 3 7.27976 3 6.63803 3.32698C6.07354 3.6146 5.6146 4.07354 5.32698 4.63803C5 5.27976 5 6.11984 5 7.8V21L12 17L19 21Z' 
                  stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>
          </svg>
        </a>
      </div>` : ''}
    </div>
  `;

  contenedor.appendChild(box);
});

// Inicializa el toggle de favoritos si hay usuario logueado
if (usuarioLogueado) toggleFavorito();

}

// Busqueda
buscarBtn.addEventListener('click', async () => {
  const texto = buscarInput.value.trim();
  try {
    let response;
    if (!texto) {
      response = await axios.get('index.php?controller=FiltradoController&accion=apiOrdenarPorFecha');
    } else {
      response = await axios.get(`index.php?controller=FiltradoController&accion=apiBuscarPorNombre&buscarAnuncio=${encodeURIComponent(texto)}`);
    }
    renderAnuncios(response.data);
  } catch (error) {
    console.error('Error al buscar:', error);
  }
});

// Orden
selectOrden.addEventListener('change', async () => {
  const valor = selectOrden.value;
  try {
    let response;
    if (valor === 'Por fecha') {
      response = await axios.get('index.php?controller=FiltradoController&accion=apiOrdenarPorFecha');
    } else {
      const orden = valor === 'Precio más alto' ? 'DESC' : 'ASC';
      response = await axios.get(`index.php?controller=FiltradoController&accion=apiOrdenarPorPrecio&orden=${orden}`);
    }
    renderAnuncios(response.data);
  } catch (error) {
    console.error('Error al ordenar:', error);
  }
});

document.addEventListener('DOMContentLoaded', () => {
  if (usuarioLogueado) toggleFavorito();
});
