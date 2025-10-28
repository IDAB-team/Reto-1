document.getElementById('imagen').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('preview');
    const plus = document.getElementById('iconoPlus');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(ev) {
            preview.src = ev.target.result;
            preview.style.display = 'block';
            if (plus) plus.style.display = 'none'; // Oculta el símbolo +
        };
        reader.readAsDataURL(file);
    }
});