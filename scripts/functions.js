// functions.js

$(document).ready(function () {
    $("input[name='search']").focus();

    // Obtener referencias a los elementos HTML
    var $searchInput = $("#search-input");
    var $tableRows = $(".table tbody tr");

    // Evento de entrada en el campo de búsqueda
    $searchInput.on('input', function () {
        var searchText = $searchInput.val().trim().toLowerCase();

        // Filtrar las filas de la tabla según el texto de búsqueda
        $tableRows.hide().filter(function () {
            var article = $(this).find(".article").text().trim().toLowerCase();
            var price = $(this).find(".price").text().trim().toLowerCase();

            return article.includes(searchText) || price.includes(searchText);
        }).show();
    });

    $('form').hide();
    $('.addProduct').click(e => {
        e.preventDefault();
        $('form').toggle();
        $("#art").focus();


    })
    // functions.js

    // Mostrar modal de confirmación al hacer clic en el botón Eliminar
    $("form[action='delete.php']").submit(function (event) {
        event.preventDefault(); // Evitar que el formulario se envíe automáticamente

        // Obtener el ID del producto a eliminar
        var productId = $(this).find("input[name='id']").val();

        // Actualizar el valor del input en el modal de confirmación
        $("#confirmDeleteModal input[name='id']").val(productId);

        // Mostrar el modal de confirmación
        $("#confirmDeleteModal").modal("show");
    });
    // Mostrar el modal al pulsar el botón "Eliminar"
    $("form[action='delete.php']").submit(function (e) {
        e.preventDefault(); // Evitar el envío del formulario

        // Obtener el ID del producto a eliminar
        var productId = $(this).find("input[name='id']").val();

        // Mostrar el modal de confirmación
        $("#confirmDeleteModal").modal("show");

        // Manejar el evento de clic en el botón "Eliminar" del modal
        $("#confirmDeleteModal .btn-danger").click(function () {
            // Enviar la solicitud para eliminar el producto de la base de datos
            $.ajax({
                url: "delete.php",
                method: "POST",
                data: { id: productId },
                success: function (response) {
                    // Cerrar el modal de confirmación
                    $("#confirmDeleteModal").modal("hide");

                    // Mostrar el modal de éxito
                    $("#deleteSuccessModal").modal("show");

                    // Actualizar la página después de unos segundos
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                },
                error: function (xhr, status, error) {
                    // Manejar los errores en caso de fallo en la solicitud
                    console.log(error); // Puedes mostrar el error en la consola del navegador
                    alert("Ha ocurrido un error. Por favor, intenta nuevamente.");
                }
            });
        });
    });




});
