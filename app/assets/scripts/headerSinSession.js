// Elementos
const modalOverlay = document.getElementById('modalOverlay');
const tabLogin = document.getElementById('tabLogin');
const tabRegister = document.getElementById('tabRegister');
const loginForm = document.getElementById('loginForm'); //iniciar sesion
const registerForm = document.getElementById('registerForm'); // crear cuenta
const registerChoice = document.getElementById('registerChoice'); // vender comprar
const registerFields = document.getElementById('registerFields'); // inputs
const divCIF = document.getElementById('divCIF');
const tipoCuentaInput = document.getElementById('tipoCuenta');
const btnComprar = document.getElementById('btnComprar');
const btnVender = document.getElementById('btnVender');
const closeModal = document.getElementById('closeModal');
const loginError = document.getElementById('loginError');


// Reset de iniciar sesion
function resetLogin() {
    loginForm.reset();
}

// Reset de crear cuenta
function resetRegister() {
    registerForm.reset();                  
    registerChoice.classList.remove('hidden'); 
    registerFields.classList.add('hidden');    
    divCIF.classList.add('hidden');    
    tipoCuentaInput.value = "";                
    btnComprar.classList.remove('active');     
    btnVender.classList.remove('active');      
}

// Abrir modal desde boton
document.querySelectorAll('.headerBoton').forEach(btn => {
    btn.addEventListener('click', () => {
        modalOverlay.style.display = 'flex';

        resetLogin();
        resetRegister();

        if (btn.textContent.includes('Iniciar')) {
            showLogin();
        } else {
            showRegister();
        }
    });
});

// Cambiar de accion
tabLogin.addEventListener('click', () => {
    showLogin();
    resetLogin();
    resetRegister();
});

tabRegister.addEventListener('click', () => {
    showRegister();
    resetLogin();
    resetRegister();
});

// Mostrar iniciar sesion
function showLogin() {
    tabLogin.classList.add('active');
    tabRegister.classList.remove('active');

    loginForm.classList.add('visible');
    loginForm.classList.remove('hidden');

    registerForm.classList.add('hidden');
}

// Mostrar crear cuenta
function showRegister() {
    tabRegister.classList.add('active');
    tabLogin.classList.remove('active');

    loginForm.classList.add('hidden');
    loginForm.classList.remove('visible');

    registerForm.classList.remove('hidden');

    //Para ocultar si vuelve a login después
    loginError.classList.add('hidden');
}

//Elegir tipo de cuenta
btnComprar.addEventListener('click', () => {
    // sin CIF
    divCIF.classList.add('hidden');    
    tipoCuentaInput.value = "comprar";
    btnComprar.classList.add('active');
    btnVender.classList.remove('active');
    registerFields.classList.remove('hidden'); 
});

btnVender.addEventListener('click', () => {
    // con CIF
    divCIF.classList.remove('hidden');
    tipoCuentaInput.value = "vender";
    btnVender.classList.add('active');
    btnComprar.classList.remove('active');
    registerFields.classList.remove('hidden'); 
});

// Cerrarlo
closeModal.addEventListener('click', () => {
    modalOverlay.style.display = 'none';
    loginError.classList.add('hidden'); // mostrar mensaje
    resetLogin();
    resetRegister();
});

modalOverlay.addEventListener('click', e => {
    if (e.target === modalOverlay) {
        modalOverlay.style.display = 'none';
        resetLogin();
        resetRegister();
    }
});

function showLoginError(message) {
    loginError.textContent = message;
    loginError.classList.remove('hidden');
}


document.addEventListener('DOMContentLoaded', () => {
    if (loginError.textContent.trim() !== "") {
        modalOverlay.style.display = 'flex'; // abrir modal
        showLogin();                          // mostrar pestaña login
        loginError.classList.remove('hidden'); // mostrar mensaje
    }
});

