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

    <link rel="stylesheet" href="./assets/css/usuarios.css">
    <link rel="stylesheet" href="./assets/css/anuncios.css">
    <link rel="stylesheet" href="./assets/css/crearGestor.css">
    <link rel="stylesheet" href="./assets/css/editarUsuario.css">
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
            <div class="headerMenu">
                <div class="headerIcono">
                    <div class="nombres">
                        <!-- Nombre del usuario -->
                        <?php if(isset($user)): ?>
                            <span><?= htmlspecialchars($user['nombre'] ?? '') ?></span>
                            <p class="tipo"><?= htmlspecialchars($user['tipo'] ?? '') ?></p>

                        <?php endif; ?>
                    </div>
                    <svg width="2.5em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#1156CC">
                        <path d="M20 21C20 19.6044 20 18.9067 19.8278 18.3389C19.44 17.0605 18.4395 16.06 17.1611 15.6722C16.5933 15.5 15.8956 15.5 14.5 15.5H9.5C8.10444 15.5 7.40665 15.5 6.83886 15.6722C5.56045 16.06 4.56004 17.0605 4.17224 18.3389C4 18.9067 4 19.6044 4 21M16.5 7.5C16.5 9.98528 14.4853 12 12 12C9.51472 12 7.5 9.98528 7.5 7.5C7.5 5.01472 9.51472 3 12 3C14.4853 3 16.5 5.01472 16.5 7.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="headerDesplegable">
                    <a href="index.php?controller=UsuariosController">Usuarios</a>
                    <a href="index.php?controller=AnunciosController">Anuncios</a>
                    <a href="?controller=LoginController&accion=logout">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </header>