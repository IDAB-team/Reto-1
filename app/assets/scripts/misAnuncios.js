const contenedor = document.querySelector('.misAnunciosLista'); 
const buscarBtn = document.querySelector('button[name="buscarAnuncio"]'); 
const buscarInput = document.querySelector('input[name="buscar"]'); 
const selectOrden = document.querySelector('select[name="misAnunciosOrden"]'); 
const botonesPaginacionContainer = document.querySelector('.misAnunciosPaginas'); 
const categoriasLinks = document.querySelectorAll('.misAnunciosCategorias a');

// Renderizar anuncios dinámicamente
function renderAnuncios(anuncios) {
  contenedor.innerHTML = '';

  if (!anuncios || anuncios.length === 0) {
    contenedor.innerHTML = '<p>No tienes anuncios publicados</p>';
    return;
  }

  anuncios.forEach(anuncio => {
    const box = document.createElement('div');
    box.classList.add('misAnunciosAnuncioCard');

    box.innerHTML = `
      <div class="misAnunciosImagen">
        <a href="index.php?controller=AnuncioController&accion=getAnuncioById&idAnuncio=${anuncio.idAnuncio}">
          <img src="./${anuncio.urlImagen}" alt="${anuncio.nombreAnuncio}">
        </a>
      </div>
      <div class="misAnunciosFecha">
        <p>${new Date(anuncio.fechaAnuncio).toLocaleDateString()}</p>
      </div>
      <div class="misAnunciosInfo">
        <div class="misAnunciosInfoHeader">
          <div class="misAnunciosInfoTextos">
            <a href="index.php?controller=AnuncioController&accion=getAnuncioById&idAnuncio=${anuncio.idAnuncio}">
              <h4 class="aNombre">${anuncio.nombreAnuncio}</h4>
            </a>
            <a class="linkComerciante" href="#">
              <h5 class="aVendedor">${anuncio.userName}</h5>
            </a>
          </div>
          <div class="misAnunciosPrecio">
            <p>${anuncio.precioAnuncio} €</p>
          </div>
        </div>
        <div class="misAnunciosDescripcion">
          <p>${anuncio.descAnuncio}</p>
        </div>
      </div>
    `;

    contenedor.appendChild(box);
  });
}

// Cargar anuncios vía API
async function cargarAnuncios(url) {
  try {
    const response = await axios.get(url);
    renderAnuncios(response.data);
  } catch (error) {
    console.error("Error al cargar anuncios:", error);
    contenedor.innerHTML = '<p>Error al cargar anuncios.</p>';
  }
}

// Búsqueda
buscarBtn.addEventListener('click', () => {
  const texto = buscarInput.value.trim();
  const url = `index.php?controller=MisAnunciosController&accion=apiBuscarPorNombre&texto=${encodeURIComponent(texto)}`;
  cargarAnuncios(url);
});

// Orden
selectOrden.addEventListener('change', () => {
  const valor = selectOrden.value;
  let url;

  switch(valor) {
    case 'fecha':
      url = 'index.php?controller=MisAnunciosController&accion=apiOrdenarPorFecha';
      break;
    case 'precio_asc':
      url = 'index.php?controller=MisAnunciosController&accion=apiOrdenarPorPrecio&orden=ASC';
      break;
    case 'precio_desc':
      url = 'index.php?controller=MisAnunciosController&accion=apiOrdenarPorPrecio&orden=DESC';
      break;
  }

  if (url) cargarAnuncios(url);
});


// Filtrar por categoría desde el aside
categoriasLinks.forEach(link => {
  link.addEventListener('click', e => {
    e.preventDefault();
    const urlParams = new URL(link.href).searchParams;
    const categoria = urlParams.get('categoria');

    if (categoria) {
      cargarAnuncios(`index.php?controller=MisAnunciosController&accion=apiPorCategoria&categoria=${encodeURIComponent(categoria)}`);
    }
  });
});
