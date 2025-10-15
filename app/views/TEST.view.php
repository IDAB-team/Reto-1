<!doctype html>
<html lang="en">
    <?php
    // Incluir header dinámico
    include __DIR__ . '/layout/' . $header;
    ?>

    <main class="TESTMain">
        <a href="index.php?controller=FiltradoController">
            <h1>Filtrado</h1>
        </a>
        <a href="index.php?controller=AnuncioController">
            <h1>Anuncio</h1>
        </a>
        <a href="index.php?controller=VendedorController">
            <h1>Vendedor</h1>
        </a> 
        <a href="index.php?controller=MisAnunciosController">
            <h1>Mis Anuncios</h1>
        </a>     
        <a href="index.php?controller=FavoritosController">
            <h1>Favoritos</h1>
        </a> 
        <a href="index.php?controller=SubirAnuncioController">
            <h1>Subir Anuncio</h1>
        </a> 
        <a href="index.php?controller=EditarAnuncioController">
            <h1>Editar Anuncio</h1>
        </a> 
        <a href="index.php?controller=AjustesController">
            <h1>Ajustes</h1>
        </a> 
    </main>

    
    <?php include __DIR__ . '/layout/footer.php'; ?>
</html>
