// favorito.js

const contenedor = document.querySelector('.anuncioListado');
const selectOrden = document.querySelector('#anuncioOrdenar');

// Ordenar favoritos por fecha o precio
selectOrden.addEventListener('change', async () => {
  const valor = selectOrden.value;

  try {
    let response;

    if (valor === 'Por fecha') {
      response = await axios.get('index.php?controller=FavoritoController&accion=ordenarPorFecha');
    } else {
      let orden = valor === 'Precio más alto' ? 'DESC' : 'ASC';
      response = await axios.get(`index.php?controller=FavoritoController&accion=ordenarPorPrecio&orden=${orden}`);
    }

    renderFavoritos(response.data);
  } catch (error) {
    console.error("Error al ordenar favoritos:", error);
  }
});

// Función para renderizar favoritos
function renderFavoritos(anuncios) {
  contenedor.innerHTML = '';

  if (anuncios.length === 0) {
    contenedor.innerHTML = '<p>No tienes anuncios favoritos aún.</p>';
    return;
  }

  anuncios.forEach(anuncio => {
    const box = document.createElement('div');
    box.classList.add('misAnunciosAnuncioCard');

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
        <button class="btnFavorito" data-id="${anuncio.ID_Anuncio}">❤️</button>
      </div>
    `;

    contenedor.appendChild(box);
  });
}