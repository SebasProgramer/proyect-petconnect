'use strict';

$(function() {

    var invalidEmailMsg = "Solo se permiten correos con '@gmail.com' o '@otroservicio.com'";
    var emptyEmailMsg = "Debe colocar un correo";
    var emptyPasswordMsg = "Contraseña requerida";

    // Elimina las clases de validación para empezar "limpio"
    $("#email, #password").removeClass("is-invalid").removeClass("is-valid");

    $(".my-login-validation-index").submit(function(event) {
        event.preventDefault(); // Prevenir el envío del formulario por defecto
        var email = $("#email").val();
        var password = $("#password").val();

        // Quitamos cualquier clase de validación previa
        $("#email, #password").removeClass("is-invalid").removeClass("is-valid");

        if (email === "") {
            $("#email").addClass("is-invalid");
            $("#email").siblings(".invalid-feedback").text(emptyEmailMsg);
        }

        if (password === "") {
            $("#password").addClass("is-invalid");
            $("#password").siblings(".invalid-feedback").text(emptyPasswordMsg);
        }

        if (email !== "" && password !== "") {
            // Aquí puedes manejar el envío del formulario cuando ambos campos están llenos
        }
    });

    $("#email").on("input", function() {
        var email = $(this).val();
        var feedback = $(this).siblings(".invalid-feedback");

        if (email && !email.endsWith('@gmail.com') && !email.endsWith('@otroservicio.com')) {
            feedback.text(invalidEmailMsg);
        } else {
            feedback.text(emptyEmailMsg);
        }
    });
});
