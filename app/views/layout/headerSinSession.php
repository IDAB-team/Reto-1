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
            <img src="./assets/images/Logo_azul.png" alt="Logotipo" class="logotipo">
            <h1>ComerciaGasteiz</h1>
        </div>
        <div class="headerBotones">
            <div class="headerBoton">Iniciar sesión</div>
            <div class="headerBoton">Crear cuenta</div>
        </div>
    </header>
    <!-- Overlay / Fondo opaco -->
    <div id="modalOverlay" class="modal-overlay">
        <div class="modal">
            <!-- Cabecera con logo y cerrar -->
            <div class="modal-header">
                <div class="modalTitulo">
                    <img src="./assets/images/Logo_azul.png" alt="Logotipo" class="logotipo">
                    <h1>ComerciaGasteiz</h1>
                </div>
                <span id="closeModal" class="modal-close">&times;</span>
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
                    <input type="email" name="email" placeholder="Correo electrónico" required>
                    <input type="password" name="password" placeholder="Contraseña" required>
                    <button type="submit">Iniciar sesión</button>
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
                        <input type="text" id="inputCIF" name="cif" placeholder="CIF" class="hidden">
                        <input type="text" name="nombre" placeholder="Nombre completo" required>
                        <input type="email" name="email" placeholder="Correo electrónico" required>
                        <input type="password" name="password" placeholder="Contraseña" required>
                        <input type="password" name="passwordConfirm" placeholder="Repetir contraseña" required>
                        <button type="submit">Crear cuenta</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
