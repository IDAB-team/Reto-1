const btnClientes = document.querySelector('.usuariosClientes');
const btnComerciantes = document.querySelector('.usuariosComerciantes');
const btnGestores = document.querySelector('.usuariosGestores');

const datosClientes = document.getElementById('datosClientes');
const datosComerciantes = document.getElementById('datosComerciantes');
const datosGestores = document.getElementById('datosGestores');

// Función para ocultar todos los divs existentes
function ocultarTodos() {
    if (datosClientes) datosClientes.classList.add('hidden');
    if (datosComerciantes) datosComerciantes.classList.add('hidden');
    if (datosGestores) datosGestores.classList.add('hidden');
}

function quitarSelectedTodos(){
    if (btnClientes) btnClientes.classList.remove('selected');
    if (btnComerciantes) btnComerciantes.classList.remove('selected');
    if (btnGestores) btnGestores.classList.remove('selected');
}

// Mostrar cada tipo al hacer clic
if (btnClientes) {
    btnClientes.addEventListener('click', () => {
        ocultarTodos();
        quitarSelectedTodos();
        btnClientes.classList.add('selected');

        if (datosClientes){
            datosClientes.classList.remove('hidden');
        }
    });
}

if (btnComerciantes) {
    btnComerciantes.addEventListener('click', () => {
        ocultarTodos();
        quitarSelectedTodos();
        btnComerciantes.classList.add('selected');

        if (datosComerciantes){
            datosComerciantes.classList.remove('hidden');
        }
    });
}

if (btnGestores) {
    btnGestores.addEventListener('click', () => {
        ocultarTodos();
        quitarSelectedTodos();
        btnGestores.classList.add('selected');
        
        if (datosGestores){
            datosGestores.classList.remove('hidden');
        }
    });
}

document.querySelectorAll('.usuariosEdicion a[href*="eliminar"]').forEach(link => {
    link.addEventListener('click', function(e) {
        if(!confirm('¿Estás seguro de que quieres eliminar este usuario?')) {
            e.preventDefault(); // Cancela si pulsa "Cancelar"
        }
    });
});