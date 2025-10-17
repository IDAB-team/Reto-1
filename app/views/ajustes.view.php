<!doctype html>
<html lang="en">
    <?php
    // Incluir header dinámico
    include __DIR__ . '/layout/' . $header;
    ?>
    <main class="mainAjustes">
        <h1 class="tituloAjustes">Editar datos</h1>
        <form action="ejer1.php" method="post" class="formularioAjustes">
            <div>
                <label for="email">Correo electronico : </label>
                <input type="text" id="email" name="email" placeholder="comerciagasteiz@gmail.com">
            </div>    
            <div>
                <label for="contraseña">Contraseña : </label>
                <input type="password" id="contraseña" name="contraseña" placeholder="***********">
            </div>
            <div>   
                <label for="nuevaContraseña">Nueva contraseña : </label>
                <input type="password" id="nuevaContraseña" name="nuevaContraseña" placeholder="***********">
            </div>
            <div>    
                <label for="repetirNuevaContraseña">Repetir nueva contraseña :</label>
                <input type="password" id="repetirNuevaContraseña" name="repetirNuevaContraseña" placeholder="***********">
            </div>
            <div>  
                <button type="submit">Guardar cambios</button>
            </div>
        </form>
    </main>
    <?php include __DIR__ . '/layout/footer.php'; ?>
</html>
