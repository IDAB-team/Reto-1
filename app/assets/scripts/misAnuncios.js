const contenedor = document.querySelector('.misAnunciosFiltros'); // Contenedor donde se mostrarán los anuncios
const buscarBtn = document.querySelector('button[name="BuscarAnuncio"]'); // Botón de búsqueda por nombre
const buscarInput = document.querySelector('input[name="buscar"]'); // Campo de texto para escribir el nombre del anuncio
const selectOrden = document.querySelector('.misAnunciosOrden'); // Selector para ordenar los anuncios por precio

buscarBtn.addEventListener('click', async()=>{
    let texto = buscarInput.ariaValueMax.trim();
    try{
        let response;
        if(!texto){
            response = await axios.get(`index.php?controller=MisAnunciosController=getAll`);
        }else{
            response = await axios.get(`index.php?controller=FiltradoController&accion=apiBuscarPorNombre&texto=${encodeURIComponent(texto)}`);
        } renderAnuncios(response.data);
    } catch(error){
        console.error("Error al buscar por nombre: ", error);
    }
});

selectOrden.addEventListener('change', async () => {
  const valor = selectOrden.value; // Obtiene el valor seleccionado

  try {
    let response;

    if (valor === 'Por fecha') {
      // Si se selecciona "Por fecha", hace la petición correspondiente
      response = await axios.get('index.php?controller=FiltradoController&accion=apiOrdenarPorFecha');
    } else {
      // Si se selecciona orden por precio
      let orden = 'ASC'; // Por defecto, ascendente
      if (valor === 'Precio más alto') orden = 'DESC'; // Cambia a descendente si se selecciona esa opción

      response = await axios.get(`index.php?controller=FiltradoController&accion=apiOrdenarPorPrecio&orden=${orden}`);
    }

    renderAnuncios(response.data); // Renderiza los anuncios según la respuesta
  } catch (error) {
    console.error("Error al ordenar los anuncios:", error); // Muestra error en consola si la petición falla
  }
});