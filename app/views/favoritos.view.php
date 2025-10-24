    <!doctype html>
    <html lang="en">
    <?php include __DIR__ . '/layout/' . $header; ?>

    <main class="FavoritoMain">

    <!-- Filtros por categoría -->
        <aside class="FavoritoCategorias">
        <h4>Filtros</h4>
        <ul>
            <?php if (!empty($listaCategorias)): ?>
                
            <?php foreach ($listaCategorias as $categoria): ?>
            <li>
                <a href="index.php?controller=FavoritosController&accion=index&categoria=<?= urlencode($categoria['Nombre']) ?>">
                    
                <div class="favoritoAnunciosCategoria">
                    <img src="./<?= $categoria['Url_icono'] ?>" alt="icono <?= htmlspecialchars($categoria['Nombre']) ?>">
                    <p><?= htmlspecialchars($categoria['Nombre']) ?></p>
                </div>
                </a>
            </li>
            <?php endforeach; ?>

            <?php else: ?>
            <p>No hay categorías disponibles.</p>
            <?php endif; ?>
        </ul>
        </aside>


    <!-- Contenido principal -->
    <section class="favoritoAnuncioContenido">
        <h3>Favoritos</h3>


        <!-- Buscador y orden -->
        <div class="favoritoAnunciosBusqueda">
        <div class="favoritoFormularioBusqueda">
            <select id="anuncioOrdenar">
            <option value="ordenar" selected disabled hidden>Ordenar por ▽</option>
            <option value="Por fecha">Fecha de publicación(más reciente)</option>
            <option value="Precio más bajo">Precio más bajo</option>
            <option value="Precio más alto">Precio más alto</option>
            </select>

            <input type="search" name="buscarAnuncio" placeholder="Buscar...">
            <button type="button" name="bBuscarAnuncio">
            <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 21L16.65 16.65M11 6C13.7614 6 16 8.23858 16 11M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Buscar
            </button>
        </div>
        </div>

        <div class="favoritoAnuncioListado">

        <?php if (!empty($listaAnuncios)): ?>  
              
            <?php foreach ($listaAnuncios as $anuncio): ?>

                <div class="favoritoAnuncioCard">

                    <div class="favoritoAnunciosImagen">
                        <img src="./<?= $anuncio->Url_imagen ?>" alt="<?= $anuncio->nombreAnuncio ?>">
                    </div>
                    <div class="favoritoAnunciosInfo">
                        <h4><?= $anuncio->nombreAnuncio ?></h4>
                        <h5><?= $anuncio->usernameAnuncio ?></h5>
                        <p><?= $anuncio->descripcionAnuncio ?></p>
                        <p class="favoritoFechaAnuncio"><?= date('d/m/Y', strtotime($anuncio->Fecha_pub)) ?></p>
                        
                        <div class="favoritoAnunciosPrecio">
                            <p><?= $anuncio->precioAnuncio ?> €</p>
                        </div>

                        <a href="index.php?controller=FavoritosController&accion=existeFavorito&ID_Anuncio=<?= $anuncio->ID_Anuncio ?>" 
                        class="favoritoToggle favoritoActivo">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 10.5L11 12.5L15.5 8M19 21V7.8C19 6.11984 19 5.27976 18.673 4.63803C18.3854 4.07354 17.9265 3.6146 17.362 3.32698C16.7202 3 15.8802 3 14.2 3H9.8C8.11984 3 7.27976 3 6.63803 3.32698C6.07354 3.6146 5.6146 4.07354 5.32698 4.63803C5 5.27976 5 6.11984 5 7.8V21L12 17L19 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        </a>
                        
                    </div>
                </div>    
            <?php endforeach; ?>
        <?php else: ?>
            <p>No tienes anuncios favoritos aún.</p>
        <?php endif; ?>
        </div>

        <!-- Paginación (estática por ahora) -->
        <div class="favoritoAnunciosPaginas">
        <button class="favoritoPaginaBtn paginaActiva">1</button>
        <button class="favoritoPaginaBtn">2</button>
        <button class="favoritoPaginaBtn">3</button>
        <button class="favoritoPaginaBtn">4</button>
        <button class="favoritoPaginaBtn">5</button>
        <button class="favoritoPaginaBtn">6</button>
        </div>
    </section>
    </main>

    <?php include __DIR__ . '/layout/footer.php'; ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
 

    <script src="/app/assets/scripts/favorito.js"></script>

    </html>
