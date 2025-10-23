<!doctype html>
<html lang="en">
    <?php
    // Incluir header dinámico
    include __DIR__ . '/layout/' . $header;
    ?>
    <main class="editarMain">
        <h1 class="editarTitulo">Editar anuncio</h1>
        <form action="ejer1.php" method="post" class="editarFormulario">
            <div class="editarCampo">
                <label for="imagen" class="editarLabel">Imagen: *</label>
                <div class="editarImagen" onclick="document.getElementById('imagen').click();">
                    <span>+</span>
                    <img id="preview" src="" alt="" style="display:none;">
                </div>
                <input type="file" id="imagen" name="imagen" accept="image/*" style="display:none;" required>
            </div>
            <div class="editarCampo">
                <label for="nombre" class="editarLabel">Nombre: * </label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre del producto" required class="editarInput">
            </div>    
            <div class="editarCampo">
                <label for="descripcion" class="editarLabel">Descripción: * </label>
                <textarea id="descripcion" placeholder="Escribe la descripción" rows="10" cols="80" style="resize: none" required class="editarInput"></textarea>
            </div>
            <div class="editarFila">
                <div class="editarCampo">
                    <label for="categoria" class="editarLabel">Categoría: *</label>
                    <select id="categoria" name="categoria" required class="editarInput">
                        <option value="">Selecciona una categoría ▼</option>
                        <?php foreach($categorias as $categoria):?>
                            <option value="<?=$categoria["Nombre"]?>"><?=$categoria["Nombre"]?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="editarCampo">
                    <label for="precio" class="editarLabel">Precio: *</label>
                    <input type="text" id="precio" name="precio" placeholder="€" required class="editarInput">
                </div>
                <div class="editarCampo">
                    <label for="stock" class="editarLabel">Stock:</label>
                    <input type="text" id="stock" name="stock" value="1" min="1" class="editarInput">
                </div>
            </div>
            <div class="editarBotones">  
                <button type="submit" class="editarBoton">Guardar cambios</button>
                <button type="submit" class="editarBotonAtras">
                    <a href="index.php?controller=InicioController">
                        Volver a página principal
                    </a>
                </button>
            </div>
        </form>
    </main>
    <?php include __DIR__ . '/layout/footer.php'; ?>
</html>