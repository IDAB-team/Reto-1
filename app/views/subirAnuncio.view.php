<!doctype html>
<html lang="en">
    <?php
    // Incluir header dinámico
    include __DIR__ . '/layout/' . $header;
    ?>
    <main class="mainSubir">
        <h1 class="tituloSubir">Subir anuncio</h1>
        <form action="ejer1.php" method="post" class="formularioSubir">
            <div class="campoImagen">
                <label for="imagen">Imagen: *</label>
                <div class="imagenSubir" onclick="document.getElementById('imagen').click();">
                    <span>+</span>
                    <img id="preview" src="" alt="" style="display:none;">
                </div>
                <input type="file" id="imagen" name="imagen" accept="image/*" style="display:none;" required>
            </div>
            <div>
                <label for="nombre">Nombre: * </label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre del producto" required>
            </div>    
            <div>
                <label for="descripcion">Descripción: * </label>
                <textarea id="descripcion" placeholder="Escribe la descipción" rows="10" cols="80" style="resize: none" required></textarea>
            </div>
            <div class="filaSubir">
                <div class="campoSubir">
                    <label for="categoria">Categoría: *</label>
                    <select id="categoria" name="categoria" required>
                        <option value="">Selecciona una categoría ▼</option>
                        <option value="ropa">Ropa</option>
                        <option value="tecnologia">Tecnología</option>
                        <option value="hogar">Hogar</option>
                    </select>
                </div>

                <div class="campoSubir">
                    <label for="precio">Precio: *</label>
                    <input type="text" id="precio" name="precio" placeholder="€" required>
                </div>

                <div class="campoSubir">
                    <label for="stock">Stock:</label>
                    <input type="text" id="stock" name="stock" value="1" min="1">
                </div>
            </div>
            <div>  
                <button type="submit">Guardar cambios</button>
            </div>
        </form>
    </main>
    <?php include __DIR__ . '/layout/footer.php'; ?>
</html>
