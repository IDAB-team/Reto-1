<!doctype html>
<html lang="en">
    <?php
    // Incluir header dinámico
    include __DIR__ . '/layout/' . $header;
    ?>

    <main class="errorMain">
        <h1>❌ Error de acceso</h1>
        <p><?= htmlspecialchars($mensaje) ?></p>
        <a href="index.php" class="btn-volver">Volver al inicio</a>
    </main>

    
    <?php include __DIR__ . '/layout/footer.php'; ?>
</html>
