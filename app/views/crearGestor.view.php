<!doctype html>
<html lang="en">
    <?php
    // Incluir header dinámico
    include __DIR__ . '/layout/' . $header;
    ?>

    <main class="crearGestorMain">
        <h1 class="crearGestorTitulo">Crear Gestor</h1>
        <form action="index.php?controller=CrearGestorController&accion=crear" method="post" class="crearGestorFormulario">
            <div class="crearGestorFormularioGrupo">
                <label for="email" class="crearGestorLabel">Username : </label>
                <input type="text" id="username" name="username" placeholder="gestor1" class="crearGestorInput">
            </div>    
            <div class="crearGestorFormularioGrupo">
                <label for="email" class="crearGestorLabel">Correo electronico : </label>
                <input type="text" id="email" name="email" placeholder="gestor@gmail.com" class="crearGestorInput">
            </div>    
            <div class="ajustesFormularioGrupo">
                <label for="contraseña" class="ajustesLabel">Contraseña : </label>
                <div class="crearGestorPasswordWrapper">
                    <input type="password" id="contraseña" name="contraseña" placeholder="***********" class="crearGestorInput">
                    <span class="crearGestorTogglePassword" onclick="togglePassword('contraseña', this)"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.7429 5.09232C11.1494 5.03223 11.5686 5 12.0004 5C17.1054 5 20.4553 9.50484 21.5807 11.2868C21.7169 11.5025 21.785 11.6103 21.8231 11.7767C21.8518 11.9016 21.8517 12.0987 21.8231 12.2236C21.7849 12.3899 21.7164 12.4985 21.5792 12.7156C21.2793 13.1901 20.8222 13.8571 20.2165 14.5805M6.72432 6.71504C4.56225 8.1817 3.09445 10.2194 2.42111 11.2853C2.28428 11.5019 2.21587 11.6102 2.17774 11.7765C2.1491 11.9014 2.14909 12.0984 2.17771 12.2234C2.21583 12.3897 2.28393 12.4975 2.42013 12.7132C3.54554 14.4952 6.89541 19 12.0004 19C14.0588 19 15.8319 18.2676 17.2888 17.2766M3.00042 3L21.0004 21M9.8791 9.87868C9.3362 10.4216 9.00042 11.1716 9.00042 12C9.00042 13.6569 10.3436 15 12.0004 15C12.8288 15 13.5788 14.6642 14.1217 14.1213" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg></span>
                </div>
            </div>
            <div class="ajustesFormularioGrupo">   
                <label for="repetirContraseñaGestor" class="crearGestorLabel">Repetir contraseña : </label>
                <div class="crearGestorPasswordWrapper">
                    <input type="password" id="crearGestorContraseña" name="repetirContraseñaGestor" placeholder="***********" class="crearGestorInput">
                    <span class="crearGestorTogglePassword" onclick="togglePassword('crearGestorContraseña', this)"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.7429 5.09232C11.1494 5.03223 11.5686 5 12.0004 5C17.1054 5 20.4553 9.50484 21.5807 11.2868C21.7169 11.5025 21.785 11.6103 21.8231 11.7767C21.8518 11.9016 21.8517 12.0987 21.8231 12.2236C21.7849 12.3899 21.7164 12.4985 21.5792 12.7156C21.2793 13.1901 20.8222 13.8571 20.2165 14.5805M6.72432 6.71504C4.56225 8.1817 3.09445 10.2194 2.42111 11.2853C2.28428 11.5019 2.21587 11.6102 2.17774 11.7765C2.1491 11.9014 2.14909 12.0984 2.17771 12.2234C2.21583 12.3897 2.28393 12.4975 2.42013 12.7132C3.54554 14.4952 6.89541 19 12.0004 19C14.0588 19 15.8319 18.2676 17.2888 17.2766M3.00042 3L21.0004 21M9.8791 9.87868C9.3362 10.4216 9.00042 11.1716 9.00042 12C9.00042 13.6569 10.3436 15 12.0004 15C12.8288 15 13.5788 14.6642 14.1217 14.1213" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg></span>
                </div>
            </div>
            <div id="mensajeResultado" class="<?= isset($_SESSION['error']) ? 'visible ' . $_SESSION['tipoMensaje'] : 'oculto' ?>">
                <?= isset($_SESSION['error']) ? htmlspecialchars($_SESSION['error']) : '' ?>
                <?php
                unset($_SESSION['error']);
                unset($_SESSION['tipoMensaje']);
                ?>
            </div>
            <div class="crearGestorBotones">  
                <button type="submit" class="crearGestorBoton">Guardar cambios</button>
                <a href="index.php?controller=InicioController" class="crearGestorBotonAtras">
                    Volver a página principal
                </a>
            </div>
        </form>
    </main>

    
    <?php include __DIR__ . '/layout/footer.php'; ?>
</html>
