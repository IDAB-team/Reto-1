<!doctype html>
<html lang="en">
<?php include __DIR__ . '/layout/' . $header; ?>

<main class="FiltradoMain">

  <!-- Filtros por categoría -->
    <aside class="filtradoCategorias">
    <h4>Filtros</h4>
    <ul class="anuncioFiltroCategorias">
        <?php foreach ($listaCategorias as $categoria): ?>
        <?php if (!empty($categoria['Nombre'])): ?>
            <li>
            <a href="#" data-categoria="<?= urlencode($categoria['Nombre']) ?>">
                <div class="misAnunciosCategoria">
                <img src="./<?= $categoria['Url_icono'] ?>" alt="icono <?= htmlspecialchars($categoria['Nombre']) ?>">
                <p><?= htmlspecialchars($categoria['Nombre']) ?></p>
                </div>
            </a>
            </li>
        <?php endif; ?>
        <?php endforeach; ?>
    </ul>
    </aside>


  <!-- Contenido principal -->
  <section class="filtradoAnuncioContenido">
    <h3>Mis anuncios</h3>

    <!-- Buscador y orden -->
    <div class="misAnunciosBusqueda">
      <div class="formularioBusqueda">
        <select id="anuncioOrdenar">
          <option value="ordenar" selected disabled hidden>Ordenar por ▽</option>
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

    <!-- Listado de anuncios dinámico -->
    <div class="anuncioListado">
      <?php foreach ($listaAnuncios as $anuncio): ?>
        <div class="misAnunciosAnuncioCard">
          <div class="misAnunciosImagen">
            <img src="./<?= $anuncio->Url_imagen ?>" alt="<?= $anuncio->nombreAnuncio ?>">
          </div>
          <div class="misAnunciosInfo">
            <h4><?= $anuncio->nombreAnuncio ?></h4>
            <h5><?= $anuncio->usernameAnuncio ?></h5>
            <p><?= $anuncio->descripcionAnuncio ?></p>
            <p class="fechaAnuncio"><?= date('d/m/Y', strtotime($anuncio->Fecha_pub)) ?></p>
            <div class="misAnunciosPrecio">
              <p><?= $anuncio->precioAnuncio ?> €</p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Paginación (estática por ahora) -->
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

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="/app/assets/scripts/filtrado.js"></script>
</html>
