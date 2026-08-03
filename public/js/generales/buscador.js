$(document).ready(function () {
    $('.select-teacher').select2({
        placeholder: 'Seleccione un usuario',
        allowClear: true,
        width: '100%'
    });

    $('.select-device').select2({
        placeholder: 'Seleccione un dispositivo',
        allowClear: true,
        width: '100%'
    });
});