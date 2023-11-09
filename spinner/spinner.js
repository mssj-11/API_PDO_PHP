document.addEventListener("DOMContentLoaded", function () {
    // Muestra el spinner
    document.getElementById("spinner").style.display = "block";

    // Después de 4 segundos, oculta el spinner
    setTimeout(function () {
        document.getElementById("spinner").style.display = "none";
    }, 4000); // 4000 milisegundos = 4 segundos
});