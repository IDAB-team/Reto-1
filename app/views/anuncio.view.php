<!doctype html>
<html lang="en">
    <?php
    // Incluir header dinámico
    include __DIR__ . '/layout/' . $header;
    ?>

    <main class="anuncioMain">
        <div class="anuncioDivision">
            <div class="anuncioIzquierda">
                <div class="tituloFavorito">
                    <h1 class="tituloAnuncio"><?= htmlspecialchars($anuncio->nombreAnuncio) ?></h1>

                    <!-- Boton favorito -->
                    <?php if(!empty($user)) : ?>
                    <a href="index.php?controller=AnuncioController&accion=existeFavorito&ID_Anuncio=<?= $anuncio->ID_Anuncio ?>" 
                    class="favoritoToggle <?= $esFavorito ? 'favoritoActivo' : '' ?>">
                        <svg class="iconoFavorito" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 10.5L11 12.5L15.5 8M19 21V7.8C19 6.11984 19 5.27976 18.673 4.63803C18.3854 4.07354 17.9265 3.6146 17.362 3.32698C16.7202 3 15.8802 3 14.2 3H9.8C8.11984 3 7.27976 3 6.63803 3.32698C6.07354 3.6146 5.6146 4.07354 5.32698 4.63803C5 5.27976 5 6.11984 5 7.8V21L12 17L19 21Z" 
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <?php endif; ?>
                </div>

                <div class="anuncioMedio">
                    <img src="<?= $anuncio->urlImagen ?>" alt="<?= htmlspecialchars($anuncio->nombreAnuncio) ?>">
                </div>

                <div class="anuncioAbajo">
                    <p><?= htmlspecialchars($anuncio->descAnuncio) ?></p>
                    <div class="precioFecha">
                        <p class="pPrecio"><?= htmlspecialchars($anuncio->precioAnuncio) ?>€</p>
                        <p><?= date('d/m/Y', strtotime($anuncio->fechaAnuncio)) ?></p>
                    </div> 
                </div>            
            </div>

            <div class="contactoDerecha">
                <h1>Si estas interesado/a</h1>
                <h2>CONTACTA CON <a class="linkComerciante" href="index.php?controller=VendedorController&accion=index&id=<?= $anuncio->idComerciante?>"><?= htmlspecialchars( $anuncio-> userName ) ?><a></h2>
                    <div class="anuncioFormulario">
                        <label>Correo Electronico:</label>
                        <input class="inputLabel" type="text" name="correo" placeholder="Introduce tu correo">
                        <label>Asunto:</label>
                        <input class="inputLabel" type="text" name="asunto" placeholder="Escriba un asunto">
                        <label>Mensaje:</label>
                        <textarea class="inputTextArea" name="mensaje" placeholder="Escriba el mensaje"></textarea>
                        <button class ="bEnviar" name="bEnviarCorreo">Enviar</button>
                    </div>
            </div>
        </div>
        
    </main>

    
    <?php include __DIR__ . '/layout/footer.php'; ?>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="assets/scripts/anuncioFavorito.js"></script>

</html>
