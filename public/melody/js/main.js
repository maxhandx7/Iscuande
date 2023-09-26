const temaOscuro = () => {
    document.querySelector("body").setAttribute("class", "sidebar-dark");
    document.querySelector("#navbar").setAttribute("class", "navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar navbar-dark");
    document.querySelector("#dl-icon").setAttribute("class", "fa fa-sun");
    localStorage.setItem("tema", "oscuro");
}

const temaClaro = () => {
    document.querySelector("body").setAttribute("class", "");
    document.querySelector("#navbar").setAttribute("class", "navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar");
    document.querySelector("#dl-icon").setAttribute("class", "fa fa-moon");
    localStorage.setItem("tema", "claro");
}

const cambiarTema = () => {
    document.querySelector("body").getAttribute("class") === "" ?
        temaOscuro() : temaClaro();
}

window.addEventListener("DOMContentLoaded", () => {
    setTimeout(function () {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.opacity = '0';
            setTimeout(function () {
                successMessage.style.display = 'none';
            }, 1000);
        }
    }, 5000);

    const temaGuardado = localStorage.getItem("tema");
    if (temaGuardado === "oscuro") {
        temaOscuro();
    } else if (temaGuardado === "claro") {
        temaClaro();
    }
});


function confirmDelete() {
    return confirm('¿Estás seguro de que deseas eliminar este registro?');
}

$(document).ready(function () {
    // Maneja el envío del formulario
    $("#search-form").submit(function () {
        // Muestra el loader cuando se envía el formulario
        $(".dot-opacity-loader").prop("hidden", false);
        $("#loader-container").fadeIn(200);
    });

    // Puedes ocultar el loader en otra parte de tu código cuando hayas completado la acción de carga
    // Por ejemplo, después de recibir una respuesta de la solicitud AJAX
    // $("#loader-container").fadeOut(200);
});






