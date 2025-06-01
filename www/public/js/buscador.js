document.addEventListener('DOMContentLoaded', function () {
    const buscador = document.getElementById('buscador');

    if (!buscador) return;

    buscador.addEventListener('input', function () {
        const filtro = buscador.value.toLowerCase();

        // Buscar en tablas (usuarios, etc.)
        const filas = document.querySelectorAll('table tbody tr');
        if (filas.length > 0) {
            filas.forEach(fila => {
                const texto = fila.textContent.toLowerCase();
                fila.style.display = texto.includes(filtro) ? '' : 'none';
            });
        }

        // Buscar en tarjetas (películas)
        const cards = document.querySelectorAll('.pelicula-card');
        if (cards.length > 0) {
            cards.forEach(card => {
                const titulo = card.querySelector('.card-title')?.textContent.toLowerCase();
                card.style.display = titulo.includes(filtro) ? '' : 'none';
            });
        }
    });
});
