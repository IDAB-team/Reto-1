<!doctype html>
<html lang="en">
    <?php
    // Incluir header dinámico
    include __DIR__ . '/layout/' . $header;
    ?>
    <main class="subirMain">
        <h1 class="subirTitulo">Subir anuncio</h1>
        <form action="index.php?controller=SubirAnuncioController&accion=subirAnuncio" enctype="multipart/form-data" method="post" class="subirFormulario">
            <div class="editarCampo"> 
                <label for="imagen" class="editarLabel">Imagen: *</label>
                <div class="editarImagen" onclick="document.getElementById('imagen').click();">
                    <span id="iconoPlus" style="<?= !empty($anuncio->urlImagen) ? 'display:none;' : 'display:block;' ?>">+</span>
                    <img 
                        id="preview" 
                        src="<?= !empty($anuncio->urlImagen) ? htmlspecialchars($anuncio->urlImagen) : '' ?>" 
                        alt="Vista previa"
                        style="<?= !empty($anuncio->urlImagen) ? 'display:block;' : 'display:none;' ?>">
                </div>
                <input type="file" id="imagen" name="imagen" accept="image/*" style="display:none;">
            </div>
            <div class="subirCampo">
                <label for="nombre" class="subirLabel">Nombre: * </label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre del producto" required class="subirInput">
            </div>    
            <div class="subirCampo">
                <label for="descripcion" class="subirLabel">Descripción: * </label>
                <textarea id="descripcion" name="descripcion" placeholder="Escribe la descripción" rows="10" cols="80" style="resize: none" required class="subirInput"></textarea>
            </div>
            <div class="subirFila">
                <div class="subirCampo">
                    <label for="categoria" class="subirLabel">Categoría: *</label>
                    <select id="categoria" name="categoria" required class="subirInput">
                        <option value="">Selecciona una categoría ▼</option>
                        <?php foreach($categorias as $categoria):?>
                            <option value="<?=$categoria["Nombre"]?>"><?=$categoria["Nombre"]?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="subirCampo">
                    <label for="precio" class="subirLabel">Precio: *</label>
                    <input type="text" id="precio" name="precio" placeholder="€" required class="subirInput">
                </div>
                <div class="subirCampo">
                    <label for="stock" class="subirLabel">Stock:</label>
                    <input type="text" id="stock" name="stock" value="1" min="1" class="subirInput">
                </div>
            </div>
            <?php if (isset($_SESSION["error"])): ?>
                <div id="mensajeResultado" class="mensajeResaultado <?= $_SESSION["tipoMensaje"] ?>">
                    <?= htmlspecialchars($_SESSION["error"]) ?>
                </div>
                <?php unset($_SESSION["error"], $_SESSION["tipoMensaje"]); ?>
            <?php endif; ?>
            <div class="subirBotones">  
                <button type="submit" class="subirBoton">Guardar cambios</button>
                <a href="index.php?controller=InicioController" class="subirBotonAtras">
                    Volver a página principal
                </a>
            </div>
        </form>
    </main>
    <?php include __DIR__ . '/layout/footer.php'; ?>
    <script src="./assets/scripts/previsualizar.js"></script>
</html>
