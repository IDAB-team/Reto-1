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
            <div class="vendedorTexto">
                <h4><?=$datosUsuario->username ?></h4>
            <div class="vendedorDetalles">
                <div class="vendedorTipo">
                <h5>Tipo: <span class="tipoValor"><?=$datosUsuario->tipo ?></span></h5>
                </div>
                <h5><?=$datosUsuario->email ?></h5>
            </div>
            </div>
        </div>
    <section class="vendedorContenido">
<!--Ordenar-->
    <div class="vendedorFiltro">    
        <select id="vendedorOrden" name="vendedorOrden">
            <option value="ordenar" selected disabled hidden>Anuncios ▽</option>
            <option value="Por fecha">Fecha de publicación</option>
            <option value="Precio más bajo">Precio más bajo</option>
            <option value="Precio más alto">Precio más alto</option>
        </select>    
    </div>

    <div class="vendedorLista">

        <?php if(!empty($listaAnuncios)): ?>

        <?php foreach($listaAnuncios as $anuncio): ?>
            <div class="vendedorAnuncioCard">
                <div class="vendedorAnuncioImagen">
                    <a href="index.php?controller=AnuncioController&accion=getAnuncioById&idAnuncio=<?= $anuncio->idAnuncio?>">  
                    <img src="./<?= $anuncio->urlImagen ?>" alt="<?= $anuncio->nombreAnuncio ?>">
                    </a>
                </div>
                
                <div class="vendedorAnuncioDetalles">
                    <div class="vendedorAnuncioTexto">
                    <h5><?= $anuncio->nombreAnuncio ?></h5>
                    <a href="index.php?controller=AnuncioController&accion=getAnuncioById&idAnuncio=<?= $anuncio->idAnuncio ?>"> 
                        <p class="desc">Ver m&aacutes</p> 
                    </a>
                    <p class="fecha"><?=date('d/m/Y', strtotime($anuncio->fechaAnuncio)) ?></p>
                    </div>
                    
                    <div class="vendedorPrecio">
                    <h4><?= $anuncio ->precioAnuncio ?>€</h4>
                    </div>
                </div>

                
            </div>
           <!-- </a> -->
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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="/app/assets/scripts/vendedor.js"></script>
</html>
