document.querySelectorAll('.misAnunciosEdicion a[href*="eliminar"]').forEach(link => {
    console.log("Encontré un enlace:", link.href);
    link.addEventListener('click', function(e) {
        if(!confirm('¿Estás seguro de que quieres eliminar este anuncio?')) {
            e.preventDefault();
        } 
    });
});
