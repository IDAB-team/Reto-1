document.querySelectorAll('.misAnunciosEdicion a[href*="accion=eliminar"]').forEach(link => {
    link.addEventListener('click', function(e) {
        if (!confirm('¿Estás seguro?')) {
            e.preventDefault();
        }
    });
});
