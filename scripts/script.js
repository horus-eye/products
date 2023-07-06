$(() => {
    const form = $('.form, form');
    const faSave = $('.fa-save');
    const faCancel = $('.fa-cancel');
    const faEdit = $('.fa-edit');
    const faTrash = $('.fa-trash');
    const fields = $('.fields');

    form.hide();
    faSave.hide();
    faCancel.hide();
    faEdit.show();
    faTrash.show();

    $(".addProduct").click(e => {
        e.preventDefault();
        $("#art").focus();
    }

    )
    // Agregar
    $('.controllerAdd').click((e) => {
        e.preventDefault();
        form.fadeToggle('fast');
        $('input[type="submit"]').val('Agregar +');
    });

    // Editar
    faEdit.click((e) => {
        e.preventDefault();
        faSave.toggle();
        faCancel.toggle();
        faEdit.toggle();
        faTrash.toggle();
        fields.attr('disabled', false);
        fields.css('background-color', 'white');
        fields.first().focus();
    });

    // Actualizar
    faSave.click((e) => {
        e.preventDefault();
        faSave.toggle();
        faCancel.toggle();
        faEdit.toggle();
        faTrash.toggle();
        fields.attr('disabled', true);
        fields.css('background-color', 'initial');
    });

    // Cancelar
    faCancel.click((e) => {
        e.preventDefault();
        faSave.toggle();
        faCancel.toggle();
        faEdit.toggle();
        faTrash.toggle();
        fields.attr('disabled', true);
        fields.css('background-color', 'initial');
    });

    // Eliminar
    $('tr').click((e) => {
        e.preventDefault();
        $(this).css('background-color', 'orange');
    });
});
