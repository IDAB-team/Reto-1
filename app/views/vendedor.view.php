<!doctype html>
<html lang="en">
    <?php
    // Incluir header dinámico
    include __DIR__ . '/layout/' . $header;
    ?>

<main class="vendedorMain">
    <div class="vendedorPerfil">
        <h2><?= htmlspecialchars($user['username']) ?></h2>
        <p>Tipo: <?= htmlspecialchars($user['tipo']) ?></p>
        <p><?= htmlspecialchars($user['email']) ?></p>
    </div>

    <div class="vendedorAnuncios">
        <h4>Anuncios ▼</h4>
    </div>

    <div class="vendedorGrid">
        <?php if ($listaAnuncios && $listaAnuncios->num_rows > 0): ?>
            <?php while ($row = $listaAnuncios->fetch_assoc()): ?>
                <div class="vendedorCard">
                    <div class="vendedorCardBody">
                        <h4><?= htmlspecialchars($row['Nombre']) ?></h4>
                        <p><?= htmlspecialchars($row['Descripcion']) ?></p>
                        <h3>$<?= number_format($row['Precio'], 2) ?></h3>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No tienes anuncios publicados todavía.</p>
        <?php endif; ?>
    </div>

    <!-- Paginación -->
    <div class="vendedorPaginacion">
        <?php if ($totalPaginas > 1): ?>
            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <a href="?controller=Vendedor&action=index&pagina=<?= $i ?>"
                   class="<?= $i == $paginaActual ? 'activo' : '' ?>">
                   <?= $i ?>
                </a>
            <?php endfor; ?>
        <?php endif; ?>
    </div>

</main>

<?php include __DIR__ . '/layout/footer.php'; ?>

</body>
</html>
