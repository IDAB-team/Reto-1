<!doctype html>
<html lang="en">
    <?php
    // Incluir header dinámico
    include __DIR__ . '/layout/' . $header;
    ?>

<main class="misAnunciosMain">

 <aside class="misAnunciosFiltros">
        <h4>Filtros</h4>
        <ul><!--Faltas los Iconos clicables-->
            <?php foreach ($categorias as $categoria): ?>
                <li>
                    <div class="misAnunciosCategoria">
                        <img src="./<?= $categoria['Url_icono'] ?>" alt="icono . <?= $categoria['Nombre'] ?>">
                        <p><?= $categoria['Nombre'] ?></p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>

    <section class="misAnunciosContenido">
    <h3>Mis anuncios</h3>

    <div class="misAnunciosBusqueda">
        <form method="GET" action="" class="formularioBusqueda">    
        
        <select name="misAnunciosOrden">
            <option value="ordenar" selected disabled hidden>Ordenar por ▽</option>
            <option value="fecha">Fecha de publicación</option>
            <option value="precio">Precio</option>
        </select>

        <input type="search" name="buscar" placeholder="Buscar...">
        <button type="submit"><svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 21L16.65 16.65M11 6C13.7614 6 16 8.23858 16 11M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>Buscar</button>
        </form>
    </div>

    <div class="misAnunciosLista">
        <div class="misAnunciosAnuncioCard">
            <div class="misAnunciosImagen">    
                <img src="./assets/images/anuncios/Iphone 18.jpg" alt="Producto1">
            </div>
            <div class="misAnunciosInfo">
                <h4>iPhone 18</h4>
                <h5>UsernameComerciante</h5>
                <p>Descripción de producto<p>            
                <div class="misAnunciosPrecio">
                    <p>1850</p>
                </div>
            </div>
        </div>

        <div class="misAnunciosAnuncioCard">
            <div class="misAnunciosImagen">    
                <img src="./assets/images/anuncios/Apple Watch.jpg" alt="Producto1">
            </div>
            <div class="misAnunciosInfo">
                <h4>Apple Watch</h4>
                <h5>UsernameComerciante</h5>
                <p>Descripción de producto<p>            
                <div class="misAnunciosPrecio">
                    <p>900</p>
                </div>
            </div>
        </div>

        <div class="misAnunciosAnuncioCard">
            <div class="misAnunciosImagen">    
                <img src="./assets/images/anuncios/Termo Mix.jpg" alt="Producto3">
            </div>
            <div class="misAnunciosInfo">
                <h4>Termo Mix</h4>
                <h5>UsernameComerciante</h5>
                <p>Descripción de producto<p>            
                <div class="misAnunciosPrecio">
                    <p>150</p>
                </div>
            </div>
        </div>
        
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
