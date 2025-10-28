//funcion para reutilizar en las vistas que contienen el boton favoritos
function toggleFavorito() {
  document.querySelectorAll('.favoritoToggle').forEach(link => {
    link.addEventListener('click', async (e) => {
      e.preventDefault(); // evitar recarga
      const url = link.getAttribute('href');

      try {
        await axios.get(url); // backend añade/elimina favorito
        link.classList.toggle('favoritoActivo'); // cambiar color
      } catch (error) {
        console.error('Error al cambiar favorito:', error);
      }
    });
  });
}

// Activar al cargar la página
document.addEventListener('DOMContentLoaded', () => {
  toggleFavorito();
});
