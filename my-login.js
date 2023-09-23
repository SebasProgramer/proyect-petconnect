$(document).ready(function() {
    var emptyEmailMsg = "Debe colocar un correo";
    var emptyPasswordMsg = "Contraseña requerida";
    var emptyNameMsg = "Debe introducir un nombre";
    var incorrectPasswordMsg = "Contraseña incorrecta";
    var userDoesNotExistMsg = "El usuario con ese correo electrónico no existe.";
    

    $("#email").on("input", function() {
        var email = $(this).val().trim();
        var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if (email === "" || !emailRegex.test(email)) {
            $("#email").siblings(".invalid-feedback").text(emptyEmailMsg);
            $("#email").addClass("is-invalid");
        } else {
            $("#email").siblings(".invalid-feedback").text("");
            $("#email").removeClass("is-invalid");
        }
    });

    $("#password").on("input", function() {
        if ($(this).val().trim() !== "") {
            $(this).siblings(".invalid-feedback").text("");
            $(this).removeClass("is-invalid");
        }
    });

    $("#name").on("input", function() {
        if ($(this).val().trim() !== "") {
            $(this).siblings(".invalid-feedback").text("");
            $(this).removeClass("is-invalid");
        }
    });

    $("#agree").change(function() {
        if(this.checked) {
            // Eliminar el mensaje de error
            $(this).siblings(".invalid-feedback").text("");
    
            // Eliminar la clase "is-invalid"
            $(this).removeClass("is-invalid");
        } else {
            // Restaurar el mensaje de error
            $(this).siblings(".invalid-feedback").text("Debes estar de acuerdo con nuestros terminos y condiciones");
    
            // Agregar la clase "is-invalid" para mostrar el mensaje de error
            $(this).addClass("is-invalid");
        }
    });
    

    $(".my-login-validation-index").submit(function(event) {
        event.preventDefault();

        var email = $("#email").val().trim();
        var password = $("#password").val().trim();
        var isValid = true;

        var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if (email === "" || !emailRegex.test(email)) {
            $("#email").siblings(".invalid-feedback").text(emptyEmailMsg);
            $("#email").addClass("is-invalid");
            isValid = false;
        }

        if (password === "") {
            $("#password").siblings(".invalid-feedback").text(emptyPasswordMsg);
            $("#password").addClass("is-invalid");
            isValid = false;
        }

        if (isValid) {
            $.ajax({
                type: "POST",
                url: "login.php",
                data: { email: email, password: password },
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        if (response.error === "userDoesNotExist") {
                            $("#email").siblings(".invalid-feedback").text(userDoesNotExistMsg);
                            $("#email").addClass("is-invalid");
                        } else if (response.error === "incorrectPassword") {
                            $("#password").siblings(".invalid-feedback").text(incorrectPasswordMsg);
                            $("#password").addClass("is-invalid");
                        }
                    } else {
                        window.location.href = "primerapag.html";
                    }
                },
                error: function() {
                    // Opcional: manejo de errores de la solicitud AJAX
                }
            });
        }
    });

    // Validación para el formulario de registro (register.html)
    $(".my-register-validation").submit(function(event) {
        event.preventDefault();

        var name = $("#name").val().trim();
        var email = $("#email").val().trim();
        var password = $("#password").val().trim();
        var isValid = true;
        var isCheckboxChecked = $("#agree").is(":checked");

        $("#name, #email, #password").removeClass("is-invalid").removeClass("is-valid");

        if (name === "") {
            $("#name").addClass("is-invalid");
            $("#name").siblings(".invalid-feedback").text(emptyNameMsg);
            isValid = false;
        }

        if (email === "") {
            $("#email").addClass("is-invalid");
            $("#email").siblings(".invalid-feedback").text(emptyEmailMsg);
            isValid = false;
        }

        if (password === "") {
            $("#password").addClass("is-invalid");
            $("#password").siblings(".invalid-feedback").text(emptyPasswordMsg);
            isValid = false;
        }
        
        if (!isCheckboxChecked) {
            $("#agree").addClass("is-invalid");
            isValid = false;
        }

        if (isValid) {
            $.ajax({
                type: "POST",
                url: "register.php",
                data: { name: name, email: email, password: password },
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        if (response.error === "userAlreadyExists") {
                            $("#email").siblings(".invalid-feedback").text("Este correo electrónico ya está registrado.");
                            $("#email").addClass("is-invalid");
                        } else if (response.error === "insertFailed") {
                            // Aquí puedes mostrar un mensaje de error general si la inserción falla
                            alert("Hubo un problema al crear la cuenta. Inténtalo de nuevo más tarde.");
                        }
                    } else if (response.success) {
                        window.location.href = "index.html"; // Redirige al inicio de sesión
                    }
                },
                error: function() {
                    // Opcional: manejo de errores de la solicitud AJAX
                    alert("Error en la solicitud. Inténtalo de nuevo más tarde.");
                }
            });
        }
    });
});