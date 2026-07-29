$(document).ready(function () {

    const baseEditUrl = $('#miTabla').data('edit-url');

    $('#miTabla').DataTable({
        ajax: {
            url: $('#miTabla').data('url'),
            dataSrc: '',
            type: 'GET'
        },
        columns: [
            {
                data: null,
                render: function (data, type, row) {
                    return row.name + ' ' + row.surname;
                }
            },
            { data: 'email' },
            { data: 'role' },
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function (data, type, row) {

                    let editUrl = baseEditUrl.toString().replace('0', row.id);

                    let html = `<a href="${editUrl}" class="me-2 text-decoration-none">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>`;

                    if (!row.responsivas_count) {
                        html += `<button type="button" class="btn btn-link text-danger p-0 align-baseline" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteTeacherModal${row.id}">
                                    <i class="fa-regular fa-trash-can text-danger"></i>
                                </button>`;
                    }

                    return html;
                }
            }
        ],
        ordering: true,
        pageLength: 10,
        language: {
            processing: "Procesando...",
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros",
            info: "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 al 0 de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            loadingRecords: "Cargando...",
            zeroRecords: "No se encontraron resultados",
            emptyTable: "Ningún dato disponible en esta tabla",
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Último"
            },
        },
    });
});
