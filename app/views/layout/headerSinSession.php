<head>
    <!-- Meta tags esenciales -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Comercia Gasteiz - Asociación de comerciantes de Vitoria-Gasteiz. Promovemos el comercio local y la economía de nuestra ciudad.">
    <meta name="author" content="IDAB team">

    <!-- Título de la página -->
    <title>Comercia Gasteiz | Compra y Vende</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/assets/images/favicon.png">

    <!-- CSS vistas y layout -->
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/footer.css">

    <link rel="stylesheet" href="./assets/css/inicio.css">
    <link rel="stylesheet" href="./assets/css/filtrado.css">
    <link rel="stylesheet" href="./assets/css/anuncio.css">
    <link rel="stylesheet" href="./assets/css/misAnuncios.css">
    <link rel="stylesheet" href="./assets/css/favoritos.css">
    <link rel="stylesheet" href="./assets/css/subirAnuncio.css">
    <link rel="stylesheet" href="./assets/css/editarAnuncio.css">
    <link rel="stylesheet" href="./assets/css/ajustes.css">
    <link rel="stylesheet" href="./assets/css/vendedor.css">
</head>
<body>
    <header>
        <div class="headerTitulo">
            <a href="index.php?controller=InicioController">
                <img src="./assets/images/Logo_azul.png" alt="Logotipo" class="logotipo">
                <h1>ComerciaGasteiz</h1>
            </a>
        </div>
        <div class="headerBotones">
            <div class="headerBoton">
                <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 15.5H7.5C6.10444 15.5 5.40665 15.5 4.83886 15.6722C3.56045 16.06 2.56004 17.0605 2.17224 18.3389C2 18.9067 2 19.6044 2 21M16 18L18 20L22 16M14.5 7.5C14.5 9.98528 12.4853 12 10 12C7.51472 12 5.5 9.98528 5.5 7.5C5.5 5.01472 7.51472 3 10 3C12.4853 3 14.5 5.01472 14.5 7.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Iniciar sesión
            </div>
            <div class="headerBoton">
                <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 15.5H7.5C6.10444 15.5 5.40665 15.5 4.83886 15.6722C3.56045 16.06 2.56004 17.0605 2.17224 18.3389C2 18.9067 2 19.6044 2 21M19 21V15M16 18H22M14.5 7.5C14.5 9.98528 12.4853 12 10 12C7.51472 12 5.5 9.98528 5.5 7.5C5.5 5.01472 7.51472 3 10 3C12.4853 3 14.5 5.01472 14.5 7.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Crear cuenta
            </div>
        </div>
    </header>
    <!-- Overlay / Fondo opaco -->
    <div id="modalOverlay" class="modal-overlay">
        <div class="modal">
            <span id="closeModal" class="modal-close">&times;</span>

            <!-- Cabecera con logo y cerrar -->
            <div class="modal-header">
                <div class="modalTitulo">
                    <img src="./assets/images/Logo_azul.png" alt="Logotipo" class="logotipo">
                    <h1>ComerciaGasteiz</h1>
                </div>
            </div>

            <!-- Barra de selección de pestañas -->
            <div class="modal-tabs">
                <span id="tabLogin" class="active">Iniciar sesión</span>
                <span id="tabRegister">Crear cuenta</span>
            </div>

            <!-- Contenido de formularios -->
            <div class="modal-body">
                
                <!-- Login -->
                <form id="loginForm" class="modal-form visible" method="POST" action="?controller=LoginController&accion=login">
                    <div class="inputs">
                        <div>
                            <label for="loginEmail">Correo electrónico:</label>
                            <input type="email" name="email" id="loginEmail" placeholder="Correo electrónico" required>
                        </div>    
                        <div>
                            <label for="loginPassword">Contraseña:</label>
                            <input type="password" name="password" placeholder="Contraseña" required>
                        </div>
                    </div>                    
                    <div id="loginError" class="hidden loginError">
                        <?php
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }
                        if (isset($_SESSION['error'])) {
                            echo htmlspecialchars($_SESSION['error']);
                            unset($_SESSION['error']); // Limpiar para no mostrarlo de nuevo
                        }
                        ?>
                    </div>
                    <button type="submit">
                        <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 15.5H7.5C6.10444 15.5 5.40665 15.5 4.83886 15.6722C3.56045 16.06 2.56004 17.0605 2.17224 18.3389C2 18.9067 2 19.6044 2 21M16 18L18 20L22 16M14.5 7.5C14.5 9.98528 12.4853 12 10 12C7.51472 12 5.5 9.98528 5.5 7.5C5.5 5.01472 7.51472 3 10 3C12.4853 3 14.5 5.01472 14.5 7.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Iniciar sesión
                    </button>
                </form>

                <!-- Registro -->
                <form id="registerForm" class="modal-form hidden" method="POST" action="?controller=LoginController&accion=register">
                    <div id="registerChoice" class="register-choice">
                        <p>¿Qué quieres hacer?</p>
                        <div class="choice-buttons">
                            <button type="button" id="btnComprar">Comprar</button>
                            <button type="button" id="btnVender">Vender</button>
                        </div>
                        <input type="hidden" name="tipoCuenta" id="tipoCuenta">
                    </div>

                    <div id="registerFields" class="formRegister hidden">
                        <div class="inputs">
                            <div id="divCIF" class="hidden">
                                <label for="inputCIF">CIF:</label>
                                <input type="text" id="inputCIF" name="cif" placeholder="CIF">
                            </div>
                            <div>
                                <label for="registerNombre">Nombre completo:</label>
                                <input type="text" id="registerNombre" name="nombre" placeholder="Nombre completo" required>
                            </div>
                            <div>
                                <label for="registerEmail">Correo electrónico:</label>
                                <input type="email" id="registerEmail" name="email" placeholder="Correo electrónico" required>
                            </div>
                            <div>
                                <label for="registerPassword">Contraseña:</label>
                                <input type="password" id="registerPassword" name="password" placeholder="Contraseña" required>
                            </div>
                            <div>
                                <label for="registerPasswordConfirm">Repetir contraseña:</label>
                                <input type="password" id="registerPasswordConfirm" name="passwordConfirm" placeholder="Repetir contraseña" required>
                            </div>
                        </div>
                        <button type="submit">
                            <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 15.5H7.5C6.10444 15.5 5.40665 15.5 4.83886 15.6722C3.56045 16.06 2.56004 17.0605 2.17224 18.3389C2 18.9067 2 19.6044 2 21M19 21V15M16 18H22M14.5 7.5C14.5 9.98528 12.4853 12 10 12C7.51472 12 5.5 9.98528 5.5 7.5C5.5 5.01472 7.51472 3 10 3C12.4853 3 14.5 5.01472 14.5 7.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Crear cuenta
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
