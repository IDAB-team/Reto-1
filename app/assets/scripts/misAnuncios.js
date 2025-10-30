const contenedor = document.querySelector('.misAnunciosLista'); 
const buscarBtn = document.querySelector('button[name="buscarAnuncio"]'); 
const buscarInput = document.querySelector('input[name="buscar"]'); 
const selectOrden = document.querySelector('select[name="misAnunciosOrden"]'); 
const botonesPaginacionContainer = document.querySelector('.misAnunciosPaginas'); 

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

  const url = texto
    ? `index.php?controller=MisAnunciosController&accion=apiBuscarPorNombre&texto=${encodeURIComponent(texto)}`
    : 'index.php?controller=MisAnunciosController&accion=apiOrdenarPorFecha';

  cargarAnuncios(url);
});

// Orden
selectOrden.addEventListener('change', () => {
  const valor = selectOrden.value;
  let url;

  if (valor === 'fecha') {
    url = 'index.php?controller=MisAnunciosController&accion=apiOrdenarPorFecha';
  } else if (valor === 'precio') {
    url = 'index.php?controller=MisAnunciosController&accion=apiOrdenarPorPrecio&orden=DESC';
  }

  if (url) cargarAnuncios(url);
});
