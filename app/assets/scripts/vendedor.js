// vendedor.js
document.addEventListener('DOMContentLoaded', () => {
  const selectOrden = document.querySelector('#vendedorOrden'); // coincidente con el id del select
  if (!selectOrden) {
    console.error('No se encontró el select #vendedorOrden');
    return;
  }

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
});


function renderAnuncios(anuncios) {
  const contenedor = document.querySelector('.vendedorLista');
  if (!contenedor) return;
  contenedor.innerHTML = ''; // limpiar

  if (!Array.isArray(anuncios) || anuncios.length === 0) {
    contenedor.innerHTML = '<p>Este vendedor no tiene anuncios publicados</p>';
    return;
  }

  anuncios.forEach(anuncio => {
    const card = document.createElement('div');
    card.className = 'vendedorAnuncioCard';
    card.innerHTML = `
      <div class="vendedorAnuncioImagen">
        <a href="index.php?controller=AnuncioController&accion=getAnuncioById&idAnuncio=${anuncio.idAnuncio || anuncio.ID_Anuncio}">
          <img src="./${anuncio.urlImagen}" alt="${anuncio.nombreAnuncio}">
        </a>
      </div>
      <div class="vendedorAnuncioDetalles">
        <div class="vendedorAnuncioTexto">
          <h5>${anuncio.nombreAnuncio}</h5>
          <a href="index.php?controller=AnuncioController&accion=getAnuncioById&idAnuncio=${anuncio.idAnuncio || anuncio.ID_Anuncio}">
            <p class="desc">Ver m&aacute;s...</p>
          </a>
          <p class="fecha">${anuncio.fechaAnuncio ? new Date(anuncio.fechaAnuncio).toLocaleDateString() : ''}</p>
        </div>
        <div class="vendedorPrecio">
          <h4>${parseInt(anuncio.precioAnuncio || 0)}€</h4>
        </div>
      </div>
    `;
    contenedor.appendChild(card);
  });
}
