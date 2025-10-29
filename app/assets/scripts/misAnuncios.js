// Elementos del DOM
const contenedor = document.querySelector('.misAnunciosLista'); // Contenedor donde se mostrarán los anuncios
const buscarBtn = document.querySelector('button[name="BuscarAnuncio"]'); // Botón de búsqueda por nombre
const buscarInput = document.querySelector('input[name="buscar"]'); // Campo de texto para escribir el nombre del anuncio
const selectOrden = document.querySelector('select[name="misAnunciosOrden"]'); // Selector para ordenar los anuncios por precio
const botonesPaginacion = document.querySelectorAll('.paginaBtn'); // Botones de paginación

// Función para renderizar los anuncios desde JSON a HTML
function renderAnuncios(anuncios) {
  contenedor.innerHTML = ''; // Limpiar contenido anterior

  if (!anuncios || anuncios.length === 0) {
    contenedor.innerHTML = '<p>No se encontraron anuncios.</p>';
    return;
  }

  anuncios.forEach(anuncio => {
    const anuncioHTML = `
      <div class="anuncio">
        <img src="${anuncio.urlImagen}" alt="${anuncio.nombreAnuncio}" />
        <h3>${anuncio.nombreAnuncio}</h3>
        <p>${anuncio.descAnuncio}</p>
        <p><strong>Precio:</strong> $${anuncio.precioAnuncio}</p>
        <p><em>Publicado por:</em> ${anuncio.userName}</p>
        <p><em>Fecha:</em> ${anuncio.fechaAnuncio}</p>
      </div>
    `;
    contenedor.innerHTML += anuncioHTML;
  });
}

// Búsqueda por nombre
buscarBtn.addEventListener('click', async () => {
  const texto = buscarInput.value.trim(); 

  try {
    let response;
    if (!texto) {
      response = await axios.get(`index.php?controller=FiltradoController&accion=getAll`);
    } else {
      response = await axios.get(`index.php?controller=FiltradoController&accion=apiBuscarPorNombre&texto=${encodeURIComponent(texto)}`);
    }
    renderAnuncios(response.data);
  } catch (error) {
    console.error("Error al buscar por nombre:", error);
    contenedor.innerHTML = '<p>Error al buscar anuncios.</p>';
  }
});

// Ordenar por precio o fecha
selectOrden.addEventListener('change', async () => {
  const valor = selectOrden.value;

  try {
    let response;

    if (valor === 'fecha') {
      response = await axios.get('index.php?controller=FiltradoController&accion=apiOrdenarPorFecha');
    } else if(valor ==='precio') {
      const orden = valor === 'precio' ? 'DESC' : 'ASC';
      response = await axios.get(`index.php?controller=FiltradoController&accion=apiOrdenarPorPrecio&orden=${orden}`);
    }

    renderAnuncios(response.data);
  } catch (error) {
    console.error("Error al ordenar los anuncios:", error);
    contenedor.innerHTML = '<p>Error al ordenar anuncios.</p>';
  }
});

// Paginación
botonesPaginacion.forEach(btn => {
  btn.addEventListener('click', async () => {
    const pagina = btn.getAttribute('data-pagina');

    try {
      const response = await axios.get(`index.php?controller=MisAnunciosController&accion=getPaginas&pagina=${pagina}`);
      renderAnuncios(response.data);

      // Actualizar clase activa visualmente
      botonesPaginacion.forEach(b => b.classList.remove('paginaActiva'));
      btn.classList.add('paginaActiva');
    } catch (error) {
      console.error("Error al cargar la página:", error);
      contenedor.innerHTML = '<p>Error al cargar la página.</p>';
    }
  });
});
