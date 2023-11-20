$(document).ready(function () {
    // Agrega eventos input para cada campo
    $("#refugio_name").on("input", function () {
        $("#error-refugio_name").text("");
    });

    $("#refugio_direction").on("input", function () {
        $("#error-refugio_direction").text("");
    });

    $("#refugio_cellphone").on("input", function () {
        $("#error-refugio_cellphone").text("");
    });

    $("#refugio_images").on("input", function () {
        $("#error-refugio_images").text("");
    });

    $("#refugio_information").on("input", function () {
        $("#error-refugio_information").text("");
    });

    $("#submitBtn").click(function () {
        // Validar cada campo antes de enviar el formulario
        var isValid = true;

        // Validar Nombre del Refugio
        var refugioName = $("#refugio_name").val();
        if (refugioName === "") {
            $("#error-refugio_name").text("Coloca el Nombre de tu Refugio");
            isValid = false;
        }

        // Validar Dirección del Refugio
        var refugioDirection = $("#refugio_direction").val();
        if (refugioDirection === "") {
            $("#error-refugio_direction").text("Coloca la Direccion de tu refugio porfavor");
            isValid = false;
        }
        
        // Validar Número Telefonico del Refugio
        var refugioCellphone = $("#refugio_cellphone").val();
        if (refugioCellphone === "") {
            $("#error-refugio_cellphone").text("Coloca este campo");
            isValid = false;
        } else if (!/^\d+$/.test(refugioCellphone)) {
            $("#error-refugio_cellphone").text("Ingresa solo números en este campo");
            isValid = false;
        }


        // Validar Imágenes del Refugio
        var refugioImages = $("#refugio_images").val();
        if (refugioImages === "") {
            $("#error-refugio_images").text("Debes adjuntar fotografias de tu refugio");
            isValid = false;
        }

        // Validar Informacion Adicional
        var refugioInformation = $("#refugio_information").val();
        if (refugioInformation === "") {
            $("#error-refugio_information").text("Completa este campo con informacion adicional");
            isValid = false;
        }

        // Si todos los campos son válidos, enviar el formulario
        if (isValid) {
            $(".register_ref").submit();
        }
    });
});
