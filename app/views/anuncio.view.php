<!doctype html>
<html lang="en">
    <?php
    // Incluir header dinámico
    include __DIR__ . '/layout/' . $header;
    ?>

    <main class="anuncioMain">
        <div class="anuncioFiltro">
            <h1>Filtros</h1>

            <div class="anuncioFiltroIconos">
                <img src="./assets/images/iconos/Moda.png" alt="Moda">
                <img src="./assets/images/iconos/Belleza.png" alt="Belleza">
                <img src="./assets/images/iconos/Hogar.png" alt="Hogar">
                <img src="./assets/images/iconos/Tecnologia.png" alt="Tecnologia">
                <img src="./assets/images/iconos/Deportes.png" alt="Deportes">
                <img src="./assets/images/iconos/Automoción.png" alt="Automocion">  
            </div>

            <div class="anuncioFiltroCategorias">
                <ul>
                    <?php foreach($listaCategorias as $categoria) : ?>
                    <li>
                        <a href="index.php?controller=AnuncioController&accion=getByNameCategory&categoria=<?= urlencode($categoria->Nombre) ?>">
                            <?= $categoria->Nombre ?>
                        </a>
                    </li>
                    <?php endforeach; ?>               
                </ul>
            </div>
        </div>
                    
        <div class="anuncioFiltroNav">
            <select id="anuncioOrdenar">
                <option>Lo más reciente</option>
                <option>Precio más bajo</option>
                <option>Precio más alto</option>
            </select>
            <input type="text" name="buscarAnuncio">
            <button name="bBuscarAnuncio">Buscar</button>
        </div>

        <div class="anuncioListado">
            <?php foreach($listaAnuncios as $anuncio) :?>
                <div class="anuncioIndividual">
                    <p class="nombreAnuncio"><?= $anuncio->nombreAnuncio ?></p>
                    <p class="precioAnuncio"><?= $anuncio->precioAnuncio ?> €</p>
                    <p class="descripcionAnuncio"><?= $anuncio->descripcionAnuncio ?></p>
                    <p class="usuarioAnuncio">Publicado por: <?= $anuncio->usernameAnuncio ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    
    <?php include __DIR__ . '/layout/footer.php'; ?>
</html>
