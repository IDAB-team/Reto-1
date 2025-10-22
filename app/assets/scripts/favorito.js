const contenedorFavoritos = document.querySelector('.favoritoAnuncioListado');
const selectOrden = document.querySelector('#anuncioOrdenar');

// Ordenar favoritos por fecha o precio
if (selectOrden) {
selectOrden.addEventListener('change', async () => {
  const valor = selectOrden.value;

  try {
    let response;

    if (valor === 'Por fecha') {
      response = await axios.get('index.php?controller=FavoritosController&accion=ordenarPorFecha');
    } else {
      let orden = valor === 'Precio más alto' ? 'DESC' : 'ASC';
      response = await axios.get(`index.php?controller=FavoritosController&accion=ordenarPorPrecio&orden=${orden}`);
    }

    renderFavoritos(response.data);
  } catch (error) {
    console.error("Error al ordenar favoritos:", error);
  }
});
}

// Renderizar favoritos
function renderFavoritos(anuncios) {
  contenedorFavoritos.innerHTML = '';

  if (anuncios.length === 0) {
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
        <p class="favoritoFechaAnuncio">${new Date(anuncio.Fecha_pub).toLocaleDateString()}</p>
        <div class="favoritoAnunciosPrecio">
          <p>${anuncio.precioAnuncio} €</p>
        </div>
        <a href="#" class="favoritoToggle favoritoActivo" data-id="${anuncio.ID_Anuncio}">Eliminar de favoritos</a>
      </div>
    `;

    contenedorFavoritos.appendChild(box);
  });

  activarFavoritos();
}

// Activar funcionalidad de favoritos
function activarFavoritos() {
  document.querySelectorAll('.favoritoToggle').forEach(link => {
    link.addEventListener('click', async (e) => {
      e.preventDefault();
      const idAnuncio = link.dataset.id;

      try {
        const response = await axios.get(`index.php?controller=FavoritosController&accion=existeFavorito&ID_Anuncio=${idAnuncio}`);
        const estado = response.data.estado;

        if (estado === 'eliminado') {
          link.classList.remove('favoritoActivo');
          link.textContent = 'Añadir a favoritos';
        } else if (estado === 'agregado') {
          link.classList.add('favoritoActivo');
          link.textContent = 'Eliminar de favoritos';
        }
      } catch (error) {
        console.error('Error al cambiar favorito:', error);
      }
    });
  });
}
