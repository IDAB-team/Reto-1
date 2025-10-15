const icono = document.querySelector('.headerIcono');
const menu = document.querySelector('.headerDesplegable');

icono.addEventListener('click', (e) => {
  e.stopPropagation(); // evita que el clic se propague al documento
  menu.classList.toggle('show');
});

// Cierra con clic fuera
document.addEventListener('click', (e) => {
  if (!menu.contains(e.target) && !icono.contains(e.target)) {
    menu.classList.remove('show');
  }
});
