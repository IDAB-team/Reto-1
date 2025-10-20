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
            <?php if (!empty($categoria->Nombre)) : ?>
                <li>
                    <a href="index.php?controller=AnuncioController&accion=getByNameCategory&categoria=<?= urlencode($categoria->Nombre) ?>">
                        <?= htmlspecialchars($categoria->Nombre) ?>
                    </a>
                </li>
            <?php endif; ?>
            <?php endforeach; ?>               
        </ul>
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
            <?php foreach($listaCategorias as $categoria) : ?>
                <?php if (!empty($categoria['Nombre'])) : ?>
                    <li>
                    <a href="index.php?controller=AnuncioController&accion=getByNameCategory&categoria=<?= urlencode($categoria['Nombre']) ?>">
                        <?= htmlspecialchars($categoria['Nombre']) ?>
                    </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </main>

    
    <?php include __DIR__ . '/layout/footer.php'; ?>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="/app/assets/scripts/anuncio.js"></script>

</html>
