<!doctype html>
<html lang="en">
    <?php
    // Incluir header dinámico
    include __DIR__ . '/layout/' . $header;
    ?>
    <main class="editarMain">
        <h1 class="editarTitulo">Editar anuncio</h1>
        <form action="index.php?controller=editarAnuncioController&accion=editarAnuncio&anuncio=<?=$idAnuncio?>" 
            enctype="multipart/form-data" 
            method="post" 
            class="editarFormulario">
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
            <div class="editarCampo">
                <label for="nombre" class="editarLabel">Nombre: * </label>
                <input type="text" id="nombre" name="nombre" 
                value="<?= htmlspecialchars($anuncio->nombreAnuncio ?? '') ?>"
                placeholder="Nombre del producto" class="editarInput">
            </div>    
            <div class="editarCampo">
                <label for="descripcion" class="editarLabel">Descripción: * </label>
                <textarea id="descripcion" name="descripcion" placeholder="Escribe la descripción" 
                rows="10" cols="80" class="editarInput"><?= htmlspecialchars($anuncio->descAnuncio ?? '') ?></textarea>
            </div>
            <div class="editarFila">
                <div class="editarCampo">
                    <label for="categoria" class="editarLabel">Categoría: *</label>
                    <select id="categoria" name="categoria" class="editarInput">
                        <option value="">Selecciona una categoría ▼</option>
                        <?php foreach($categorias as $categoria): ?>
                            <option 
                                value="<?= htmlspecialchars($categoria['Nombre']) ?>"
                                <?= ($categoria['Nombre'] === $nombre) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($categoria['Nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="editarCampo">
                    <label for="precio" class="editarLabel">Precio: *</label>
                    <input type="text" id="precio" name="precio" 
                    value="<?= htmlspecialchars($anuncio->precioAnuncio ?? '') ?>"
                    placeholder="€" class="editarInput">
                </div>                <div class="editarCampo">
                    <label for="stock" class="editarLabel">Stock:</label>
                    <input type="text" id="stock" name="stock" 
                    value="1" min="1" class="editarInput">
                </div>
            </div>
            <?php if (isset($_SESSION["error"])): ?>
                <div id="mensajeResultado" class="mensaje <?= $_SESSION["tipoMensaje"] ?>">
                    <?= htmlspecialchars($_SESSION["error"]) ?>
                </div>
                <?php unset($_SESSION["error"], $_SESSION["tipoMensaje"]); ?>
            <?php endif; ?>
            <div class="editarBotones">  
                <button type="submit" class="editarBoton">Guardar cambios</button>
                <a href="index.php?controller=InicioController" class="editarBotonAtras">
                    Volver a página principal
                </a>
            </div>
        </form>
    </main>

    <?php include __DIR__ . '/layout/footer.php'; ?>
    <script src="./assets/scripts/previsualizar.js"></script>
</html>