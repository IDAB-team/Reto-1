document.querySelectorAll('.misAnunciosEdicion a[href*="eliminar"]').forEach(link => {
    console.log("Encontré un enlace:", link.href);
    link.addEventListener('click', function(e) {
        if(!confirm('¿Estás seguro de que quieres eliminar este anuncio?')) {
            e.preventDefault();
        } 
    });
});

document.addEventListener("DOMContentLoaded", () => {
  const contenedor = document.querySelector('.misAnunciosLista');
  const selectOrden = document.querySelector('select[name="misAnunciosOrden"]');
  const buscarBtn = document.querySelector('button[name="buscarAnuncio"]');
  const buscarInput = document.querySelector('input[name="buscar"]');
  const categorias = document.querySelectorAll('.misAnunciosCategoria');

  function renderAnuncios(anuncios) {
    contenedor.innerHTML = '';
    if (!anuncios.length) {
      contenedor.innerHTML = '<p>No se encontraron anuncios.</p>';
      return;
    }

    anuncios.forEach(anuncio => {
      const card = document.createElement('div');
      card.classList.add('misAnunciosAnuncioCard');
      card.innerHTML = `
        <div class="misAnunciosImagen">
            <a href="index.php?controller=AnuncioController&accion=getAnuncioById&idAnuncio=${anuncio.idAnuncio}">
              <img src="./${anuncio.Url_imagen}" alt="${anuncio.nombreAnuncio}">
            </a>
        </div>
        <div class="misAnunciosFecha">
            <p>${new Date(anuncio.fechaAnuncio).toLocaleDateString()}</p>
        </div>
        <div class="misAnunciosInfo">
            <div class="misAnunciosDetalles">
                <div class="misAnunciosTexto">
                    <h4>${anuncio.nombreAnuncio}</h4>
                    <a href="index.php?controller=VendedorController&idAnuncio=${anuncio.idAnuncio}">
                        <h5>${anuncio.userName || anuncio.usernameAnuncio}</h5>
                    </a>
                    <div class="desc">
                        <p>${anuncio.descAnuncio || anuncio.descripcionAnuncio || ''}</p>
                    </div>
                </div>
                <div class="misAnunciosPrecio">
                    <p>${anuncio.precioAnuncio} €</p>
                </div>
            </div>
            <div class="misAnunciosEdicion">
              <div>
                  <a href="index.php?controller=EditarAnuncioController&anuncio=${anuncio.idAnuncio}" class="btnEditar">
                      <!-- icono editar -->
                      <svg width="1.5em" height="1.5em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M11 3.99998H6.8C5.11984 3.99998 4.27976 3.99998 3.63803 4.32696C3.07354 4.61458 2.6146 5.07353 2.32698 5.63801C2 6.27975 2 7.11983 2 8.79998V17.2C2 18.8801 2 19.7202 2.32698 20.362C2.6146 20.9264 3.07354 21.3854 3.63803 21.673C4.27976 22 5.11984 22 6.8 22H15.2C16.8802 22 17.7202 22 18.362 21.673C18.9265 21.3854 19.3854 20.9264 19.673 20.362C20 19.7202 20 18.8801 20 17.2V13M7.99997 16H9.67452C10.1637 16 10.4083 16 10.6385 15.9447C10.8425 15.8957 11.0376 15.8149 11.2166 15.7053C11.4184 15.5816 11.5914 15.4086 11.9373 15.0627L21.5 5.49998C22.3284 4.67156 22.3284 3.32841 21.5 2.49998C20.6716 1.67156 19.3284 1.67155 18.5 2.49998L8.93723 12.0627C8.59133 12.4086 8.41838 12.5816 8.29469 12.7834C8.18504 12.9624 8.10423 13.1574 8.05523 13.3615C7.99997 13.5917 7.99997 13.8363 7.99997 14.3255V16Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                  </a>
              </div>
              <div>
                  <a href="index.php?controller=AnunciosController&accion=eliminar&anuncio=${anuncio.idAnuncio}">
                      <!-- icono eliminar -->
                      <svg width="1.5em" height="1.5em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M16 6V5.2C16 4.0799 16 3.51984 15.782 3.09202C15.5903 2.71569 15.2843 2.40973 14.908 2.21799C14.4802 2 13.9201 2 12.8 2H11.2C10.0799 2 9.51984 2 9.09202 2.21799C8.71569 2.40973 8.40973 2.71569 8.21799 3.09202C8 3.51984 8 4.0799 8 5.2V6M10 11.5V16.5M14 11.5V16.5M3 6H21M19 6V17.2C19 18.8802 19 19.7202 18.673 20.362C18.3854 20.9265 17.9265 21.3854 17.362 21.673C16.7202 22 15.8802 22 14.2 22H9.8C8.11984 22 7.27976 22 6.63803 21.673C6.07354 21.3854 5.6146 20.9265 5.32698 20.362C5 19.7202 5 18.8802 5 17.2V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                  </a>
              </div>
            </div>
        </div>
      `;
      contenedor.appendChild(card);
    });
  }

  // 🔍 Buscar
  buscarBtn?.addEventListener('click', async () => {
    const texto = buscarInput.value.trim();
    const url = texto
      ? `index.php?controller=AnunciosController&accion=apiBuscarPorNombre&buscarAnuncio=${encodeURIComponent(texto)}`
      : `index.php?controller=AnunciosController&accion=apiOrdenarPorFecha`;

    try {
      const response = await axios.get(url);
      renderAnuncios(response.data);
    } catch (err) {
      console.error('Error al buscar:', err);
    }
  });

  categorias.forEach(cat => {
    cat.addEventListener('click', async (e) => {
      const categoria = cat.dataset.categoria; // ahora usamos data-categoria
      const url = `index.php?controller=AnunciosController&accion=apiPorCategoria&categoria=${encodeURIComponent(categoria)}`;
      try {
        const response = await axios.get(url);
        renderAnuncios(response.data);
      } catch (err) {
        console.error('Error al filtrar por categoría:', err);
      }
    });
  });

  selectOrden?.addEventListener('change', async () => {
    const valor = selectOrden.value;
    let url = '';

    if (valor === 'fecha') {
      url = 'index.php?controller=AnunciosController&accion=apiOrdenarPorFecha';
    } else if (valor === 'precio_asc') {
      url = 'index.php?controller=AnunciosController&accion=apiOrdenarPorPrecio&orden=ASC';
    } else if (valor === 'precio_desc') {
      url = 'index.php?controller=AnunciosController&accion=apiOrdenarPorPrecio&orden=DESC';
    } else {
      return;
    }

    try {
      const response = await axios.get(url);
      renderAnuncios(response.data);
    } catch (err) {
      console.error('Error al ordenar:', err);
    }
  });

  buscarInput?.addEventListener('input', async () => {
    if (buscarInput.value.trim() === '') {
      const response = await axios.get('index.php?controller=AnunciosController&accion=apiOrdenarPorFecha');
      renderAnuncios(response.data);
    }
  });
});
