// Elementos del DOM
const contenedor = document.querySelector('.anuncioListado');
const buscarBtn = document.querySelector('button[name="bBuscarAnuncio"]');
const buscarInput = document.querySelector('input[name="buscarAnuncio"]');
const categoriaLinks = document.querySelectorAll('.anuncioFiltroCategorias a');
const selectOrden = document.querySelector('#anuncioOrdenar');

// 🔍 Buscar por nombre al hacer clic en el botón
buscarBtn.addEventListener('click', async () => {
  const texto = buscarInput.value.trim();
  if (!texto) return;

  try {
    const response = await axios.get(`index.php?controller=AnuncioController&accion=apiBuscarPorNombre&texto=${encodeURIComponent(texto)}`);
    renderAnuncios(response.data);
  } catch (error) {
    console.error("Error al buscar por nombre:", error);
  }
});

// 🧭 Filtrar por categoría al hacer clic en un enlace
categoriaLinks.forEach(link => {
  link.addEventListener('click', async (e) => {
    e.preventDefault();
    const categoria = link.textContent.trim();

    try {
      const response = await axios.get(`index.php?controller=AnuncioController&accion=apiPorCategoria&categoria=${encodeURIComponent(categoria)}`);
      renderAnuncios(response.data);
    } catch (error) {
      console.error("Error al filtrar por categoría:", error);
    }
  });
});

// 💰 Ordenar por precio al cambiar el select
selectOrden.addEventListener('change', async () => {
  const valor = selectOrden.value;
  let orden = 'ASC';
  if (valor === 'Precio más alto') orden = 'DESC';

  try {
    const response = await axios.get(`index.php?controller=AnuncioController&accion=apiOrdenarPorPrecio&orden=${orden}`);
    renderAnuncios(response.data);
  } catch (error) {
    console.error("Error al ordenar por precio:", error);
  }
});

// 🧱 Renderizar los anuncios
function renderAnuncios(anuncios) {
  contenedor.innerHTML = '';
  if (anuncios.length === 0) {
    contenedor.innerHTML = '<p>No se encontraron anuncios.</p>';
    return;
  }

  anuncios.forEach(anuncio => {
    const box = document.createElement('div');
    box.classList.add('anuncioIndividual');
    box.innerHTML = `
      <p class="nombreAnuncio">${anuncio.nombreAnuncio}</p>
      <p class="precioAnuncio">${anuncio.precioAnuncio} €</p>
      <p class="descripcionAnuncio">${anuncio.descripcionAnuncio}</p>
      <p class="usuarioAnuncio">Publicado por: ${anuncio.usernameAnuncio}</p>
    `;
    contenedor.appendChild(box);
  });
}
