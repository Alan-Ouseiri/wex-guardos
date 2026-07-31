import { myLanguage } from "./language.js";

$(document).ready(function () {

    $('#devicesTable').DataTable({
        ajax: {
            url: $('#devicesTable').data('url'),
            dataSrc: '',
            type: 'GET'
        },
        columns: [
            { data: 'description' },
            { data: 'serial_number' },
            { data: 'status' },
            { data: 'buttons' },
        ],
        columnDefs: [{ orderable: false, targets: 3 }],
        pageLength: 10,
        language: myLanguage,
    });
});
