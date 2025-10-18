<!doctype html>
<html lang="en">
    <?php
    // Incluir header dinámico
    include __DIR__ . '/layout/' . $header;
    ?>
    <main class="ajustesMain">
        <h1 class="ajustesTitulo">Editar datos</h1>
        <form action="ejer1.php" method="post" class="ajustesFormulario">
            <div class="ajustesFormularioGrupo">
                <label for="email" class="ajustesLabel">Correo electronico : </label>
                <input type="text" id="email" name="email" placeholder="comerciagasteiz@gmail.com" class="ajustesInput">
            </div>    
            <div class="ajustesFormularioGrupo">
                <label for="contraseña" class="ajustesLabel">Contraseña : </label>
                <input type="password" id="contraseña" name="contraseña" placeholder="***********" class="ajustesInput">
            </div>
            <div class="ajustesFormularioGrupo">   
                <label for="nuevaContraseña" class="ajustesLabel">Nueva contraseña : </label>
                <input type="password" id="nuevaContraseña" name="nuevaContraseña" placeholder="***********" class="ajustesInput">
            </div>
            <div class="ajustesFormularioGrupo">    
                <label for="repetirNuevaContraseña" class="ajustesLabel">Repetir nueva contraseña :</label>
                <input type="password" id="repetirNuevaContraseña" name="repetirNuevaContraseña" placeholder="***********" class="ajustesInput">
            </div>
            <div>  
                <button type="submit" class="ajustesBoton">Guardar cambios</button>
            </div>
        </form>
    </main>
    <?php include __DIR__ . '/layout/footer.php'; ?>
</html>
