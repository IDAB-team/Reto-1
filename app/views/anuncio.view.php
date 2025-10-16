<!doctype html>
<html lang="en">
    <?php
    // Incluir header dinámico
    include __DIR__ . '/layout/' . $header;
    ?>

    <main class="anuncioMain">
     <h1>Anuncio</h1>
            <p>Query de todos los anuncios</p>
            <ul>
                <?php if(isset($listaAnuncios)) : ?>
                <?php foreach($listaAnuncios as $anuncio): ?>
                    <li><?= $anuncio->Nombre; ?></li>
                <?php endforeach; ?>
                <?php else: ?>
                    <p>No hay anuncios</p>
                <?php endif; ?>
            </ul>

            <form action="index.php?controller=AnuncioController" method="GET">
            <p>Buscar por categoria</p>
            <input type="text" name="categoria">
            <input type="hidden" name="controller" value="AnuncioController">
            <input type="hidden" name="accion" value="getByNameCategory">
            <button type="submit">Buscar</button>
            </form>
            
            <ul>
            <?php foreach($listaAnuncios as $anuncio): ?>
                <li>
                    <?= $anuncio->nombreAnuncio ?> - <?= $anuncio->Precio ?>€  
                    <br>
                    Categoría: <?= $anuncio->nombreCategoria ?>
                </li>
            <?php endforeach; ?>
            </ul>

    </main>

    
    <?php include __DIR__ . '/layout/footer.php'; ?>
</html>

