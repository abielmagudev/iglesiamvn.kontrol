<script>
// Convierte la primera letra de cada palabra en mayuscula
function capitalizarTexto($string)
{
    return $string.toLowerCase().replace(/\b\w/g, function(occurrence) {
        return occurrence.toUpperCase();
    });
}

// Debounce Function: Espera cierto tiempo despues de escribir
function debounce(func, delay) {
    let timeoutId;
    
    return function(...args)
    {
        clearTimeout(timeoutId);

        timeoutId = setTimeout(() => {
            func.apply(this, args);
        }, delay);
    };
}
</script>
