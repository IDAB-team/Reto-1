<!doctype html>
<html lang="en">
    <?php
    // Incluir header dinámico
    include __DIR__ . '/layout/' . $header;
    ?>



    <main class="inicioMain">
        <div class="inicioBusqueda">
            <h1>¿Qué quieres encontrar?</h1>
            <form class="inicioBuscar" action="index.php" method="get">
                <input type="hidden" name="controller" value="FiltradoController">
                <input type="hidden" name="accion" value="index"> 
                <input type="text" name="buscarAnuncio" id="busquedaInput" placeholder="Escribe aquí...">

                <button type="submit" class="inicioBotonBuscar">
                    <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M21 21L16.65 16.65M11 6C13.7614 6 16 8.23858 16 11M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <p>Buscar</p>
                </button>
            </form>
        </div>
        <div class="inicioCategorias">
            <?php foreach ($categorias as $categoria): ?>
                <div class="inicioCategoria">
                    <a href="index.php?controller=FiltradoController&categoria=<?= urlencode($categoria['Nombre']) ?>">
                        <img src="./<?= $categoria['Url_icono'] ?>" alt="icono <?= htmlspecialchars($categoria['Nombre']) ?>">
                        <p><?= htmlspecialchars($categoria['Nombre']) ?></p>
                    </a>
                </div>

            <?php endforeach; ?>
        </div> 
        <div class="inicioAnuncios">
            <p>Lo más reciente ▼</p>
            <div class="anunciosGrid">
                <?php foreach ($anuncios as $anuncio): ?>
                    <div class="anuncioCard">
                        <div class="imagenCard">
                            <a href="index.php?controller=AnuncioController&accion=getAnuncioById&idAnuncio=<?= $anuncio['ID_Anuncio'] ?>">
                                <img src="./<?= $anuncio['Url_imagen'] ?>" alt="imagen <?= htmlspecialchars($anuncio['Nombre']) ?>">
                            </a>
                        </div>
                        <div class="infoCard">
                            <div class="info">
                                <div class="nombreAnuncio">
                                   <h3> <a href="index.php?controller=AnuncioController&accion=getAnuncioById&idAnuncio=<?= $anuncio['ID_Anuncio'] ?>">
                                        <?= htmlspecialchars($anuncio['Nombre']) ?>
                                    </a> </h3>
                                </div>
                                <p class="nombreComerciante">
                                    <a href="index.php?controller=VendedorController&accion=index&id=<?= $anuncio['idUsuario'] ?>">
                                        <?= htmlspecialchars($anuncio['comerciante']) ?>
                                    </a>
                                </p>

                                <a class="verMas" href="index.php?controller=AnuncioController&accion=getAnuncioById&idAnuncio=<?= $anuncio['ID_Anuncio'] ?>">Ver más</a>
                            </div>
                            <div class="infoPrecio">
                                <p><strong><?= number_format($anuncio['Precio'], 2) ?> €</strong></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>  
    </main>

    
    <?php include __DIR__ . '/layout/footer.php'; ?>
</html>
