<!doctype html>
<html lang="en">
<?php
// Incluir header dinámico
include __DIR__ . '/layout/' . $header;
?>

<main class="misAnunciosMain">
    <aside class="misAnunciosCategorias">
        <h4>Categor&iacuteas</h4>
        <ul>
            <?php foreach ($categorias as $categoria): ?>
                <li>
                    <a href="index.php?controller=MisAnunciosController&accion=index&categoria=<?= urlencode($categoria['Nombre']) ?>">
                    <div class="misAnunciosCategoria" style="cursor:pointer;" >
                        <img src="./<?= $categoria['Url_icono'] ?>" alt="icono <?= $categoria['Nombre'] ?>" >
                        <p><?= $categoria['Nombre'] ?></p>
                    </div>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>

    <section class="misAnunciosContenido">
        <h3>Mis anuncios</h3>
            <!--Ordenar-->
        <div class="misAnunciosformularioBusqueda">
            <select name="misAnunciosOrden">
                <option value="ordenar" selected disabled hidden>Ordenar por ▽</option>
                <option value="fecha">Fecha de publicación (más reciente)</option>
                <option value="precio_asc">Precio más bajo</option>
                <option value="precio_desc">Precio más alto</option>
            </select>

            <input type="search" name="buscar" placeholder="Buscar...">
            <button type="button" name="buscarAnuncio">
                <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 21L16.65 16.65M11 6C13.7614 6 16 8.23858 16 11M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Buscar
            </button>
            </div>

        <div class="misAnunciosLista">
        
        <?php if(!empty($listaAnuncios)): ?>

        <?php foreach($listaAnuncios as $anuncio): ?>
            <div class="misAnunciosAnuncioCard">
                <div class="misAnunciosImagen">
                    <a href="index.php?controller=AnuncioController&accion=getAnuncioById&idAnuncio=<?= $anuncio->idAnuncio?>">
                        <img src="./<?= $anuncio->urlImagen ?>" alt="<?= $anuncio->nombreAnuncio ?>">
                    </a>
                </div>
                <div class="misAnunciosFecha">
                    <p><?= date('d/m/Y', strtotime($anuncio->fechaAnuncio)) ?></p>
                </div>
                <div class="misAnunciosInfo">
                    <div class="misAnunciosInfoHeader">
                        <div class="misAnunciosInfoTextos">
                            <a href="index.php?controller=AnuncioController&accion=getAnuncioById&idAnuncio=<?= $anuncio->idAnuncio?>">
                                <h4 class="aNombre"><?=$anuncio->nombreAnuncio ?></h4>
                            </a>
                            <a class="linkComerciante" href="index.php?controller=VendedorController&accion=index&id=<?= $anuncio->idComerciante?>">
                                <h5 class="aVendedor"><?=$anuncio->userName ?></h5> 
                            </a>
                        </div>
                        <div class="misAnunciosPrecio">
                            <p><?=$anuncio->precioAnuncio ?> €</p>
                        </div>
                    </div>
                    <div class="misAnunciosDescripcion">
                        <p><?=$anuncio->descAnuncio ?></p>
                    </div>
                    <div class="misAnunciosEdicion">
                        <div>
                            <a href="index.php?controller=EditarAnuncioController&anuncio=<?= $anuncio->idAnuncio ?>">
                                <!-- icono editar -->
                                <svg width="1.5em" height="1.5em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 3.99998H6.8C5.11984 3.99998 4.27976 3.99998 3.63803 4.32696C3.07354 4.61458 2.6146 5.07353 2.32698 5.63801C2 6.27975 2 7.11983 2 8.79998V17.2C2 18.8801 2 19.7202 2.32698 20.362C2.6146 20.9264 3.07354 21.3854 3.63803 21.673C4.27976 22 5.11984 22 6.8 22H15.2C16.8802 22 17.7202 22 18.362 21.673C18.9265 21.3854 19.3854 20.9264 19.673 20.362C20 19.7202 20 18.8801 20 17.2V13M7.99997 16H9.67452C10.1637 16 10.4083 16 10.6385 15.9447C10.8425 15.8957 11.0376 15.8149 11.2166 15.7053C11.4184 15.5816 11.5914 15.4086 11.9373 15.0627L21.5 5.49998C22.3284 4.67156 22.3284 3.32841 21.5 2.49998C20.6716 1.67156 19.3284 1.67155 18.5 2.49998L8.93723 12.0627C8.59133 12.4086 8.41838 12.5816 8.29469 12.7834C8.18504 12.9624 8.10423 13.1574 8.05523 13.3615C7.99997 13.5917 7.99997 13.8363 7.99997 14.3255V16Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                        <div>
                            <a href="index.php?controller=MisAnunciosController&accion=eliminar&anuncio=<?= $anuncio->idAnuncio ?>">
                                <!-- icono eliminar -->
                                <svg width="1.5em" height="1.5em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 6V5.2C16 4.0799 16 3.51984 15.782 3.09202C15.5903 2.71569 15.2843 2.40973 14.908 2.21799C14.4802 2 13.9201 2 12.8 2H11.2C10.0799 2 9.51984 2 9.09202 2.21799C8.71569 2.40973 8.40973 2.71569 8.21799 3.09202C8 3.51984 8 4.0799 8 5.2V6M10 11.5V16.5M14 11.5V16.5M3 6H21M19 6V17.2C19 18.8802 19 19.7202 18.673 20.362C18.3854 20.9265 17.9265 21.3854 17.362 21.673C16.7202 22 15.8802 22 14.2 22H9.8C8.11984 22 7.27976 22 6.63803 21.673C6.07354 21.3854 5.6146 20.9265 5.32698 20.362C5 19.7202 5 18.8802 5 17.2V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <?php else: ?>
            <p>No tienes anuncios publicados</p>
        <?php endif; ?>
        </div>

        <div class="misAnunciosPaginas">
            
        </div>
    </section>
</main>

<?php include __DIR__ . '/layout/footer.php'; ?>
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="assets/scripts/misAnuncios.js" ></script>

  <!-- Variables globales para el JS -->
  <script>
    const usuarioLogueado = <?= !empty($user) ? 'true' : 'false' ?>;
    const favoritosUsuario = <?= json_encode($favoritos ?? []) ?>;
  </script>
</html>
