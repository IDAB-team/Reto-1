<!doctype html>
<html lang="en">
    <?php
    // Incluir header dinámico
    include __DIR__ . '/layout/' . $header;
    ?>

    <main class="vendedorMain">
        <div class="vendedorInfo">
            <div class="vendedorIcono">
                <svg width="5em" height="5em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
 <path d="M5.3163 19.4384C5.92462 18.0052 7.34492 17 9 17H15C16.6551 17 18.0754 18.0052 18.6837 19.4384M16 9.5C16 11.7091 14.2091 13.5 12 13.5C9.79086 13.5 8 11.7091 8 9.5C8 7.29086 9.79086 5.5 12 5.5C14.2091 5.5 16 7.29086 16 9.5ZM22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
 </svg>
            </div>
            <h4>Vendedor</h4>
            <p>Tipo: </p>
            <p class="vendedorTipo">vendedor</p>
            <p>Email</p>
        </div>
    <section class="vendedorContenido">
<!--Ordenar-->
    <div class="vendedorFiltro">    
        <select name="vendedorOrden">
            <option value="ordenar" selected disabled hidden>Ordenar por</option>
            <option value="fecha">Fecha de publicación</option>
            <option value="precio">Precio</option>
        </select>    
    </div>

    <div class="vendedorLista">

        <?php if(!empty($listaAnuncios)): ?>

        <?php foreach($listaAnuncios as $anuncio): ?>
            <div class="vendedorAnuncioCard">
                <div class="vendedorAnuncioImagen">
                <img src="./<?= $anuncio->urlImagen ?>" alt="<?= $anuncio->nombreAnuncio ?>">
            
                <p><?= $anuncio->nombreAnuncio ?></p>
                <p><?= $anuncio->descAnuncio ?></p>
                
                <div class="vendedorPrecio">
                <p><?= $anuncio ->precioAnuncio ?></p>
                </div>

                </div>
            </div>
    <?php endforeach; ?>

    <?php else: ?>
            <p>Este vendedor no tiene anuncios publicados</p>
    <?php endif; ?>
        </div>
    
        



            <div class="misAnunciosPaginas">
                <button class="paginaBtn paginaActiva">1</button>
                <button class="paginaBtn">2</button>
                <button class="paginaBtn">3</button>
                <button class="paginaBtn">4</button>
                <button class="paginaBtn">5</button>
                <button class="paginaBtn">6</button>
            </div>

        </section>

    </main>

    
    <?php include __DIR__ . '/layout/footer.php'; ?>
</html>
