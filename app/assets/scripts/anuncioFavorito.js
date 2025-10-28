const botonFavorito = document.querySelector('.favoritoToggle');

if (botonFavorito) {
  botonFavorito.addEventListener('click', async (e) => {
    e.preventDefault();
    const url = botonFavorito.href;
    try {
      await axios.get(url);
      botonFavorito.classList.toggle('favoritoActivo');
    } catch (error) {
      console.error('Error actualizar favorito:', error);
    }
  });
}
