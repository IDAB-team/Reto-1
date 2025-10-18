<!doctype html>
<html lang="en">
    <?php
    // Incluir header dinámico
    include __DIR__ . '/layout/' . $header;
    ?>



    <main class="inicioMain">
        <div class="inicioBusqueda">
            <h1>¿Que quieres encontrar?</h1>
            <div class="inicioBuscador">
                <div class="inicioBuscar">
                    <div class="inicioBotonBuscar">
                        <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 21L16.65 16.65M11 6C13.7614 6 16 8.23858 16 11M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <p>Buscar</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="inicioCategorias">
            <?php foreach ($categorias as $categoria): ?>
                <div class="inicioCategoria">
                    <img src="./<?= $categoria['Url_icono'] ?>" alt="icono . <?= $categoria['Nombre'] ?>">
                    <p><?= $categoria['Nombre'] ?></p>
                </div>

            <?php endforeach; ?>
        </div> 
        <div class="inicioAnuncios">
            <p>Lo más reciente ▼</p>
            <div class="anunciosGrid">
                <?php foreach ($anuncios as $anuncio): ?>
                    <div class="anuncioCard">
                        <div class="imagenCard">
                            <img src="./<?= $anuncio['Url_imagen'] ?>" alt="imagen <?= htmlspecialchars($anuncio['Nombre']) ?>">
                        </div>
                        <div class="infoCard">
                            <div class="info">
                                <h3><?= htmlspecialchars($anuncio['Nombre']) ?></h3>
                                <p><?= htmlspecialchars($anuncio['Descripcion']) ?></p>
                                <p><?= ucfirst(htmlspecialchars($anuncio['comerciante'])) ?></p>
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
