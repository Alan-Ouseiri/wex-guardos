import { myLanguage } from "./language.js";

$(document).ready(function () {

    $('#responsiveActiveTable').DataTable({
        ajax: {
            url: $('#responsiveActiveTable').data('url'),
            dataSrc: '',
            type: 'GET'
        },
        columns: [
            { data: 'responsiva_number' },
            { data: 'name' },
            { data: 'description' },
            { data: 'no' },
            { data: 'button' },
        ],
        order: [[0, 'desc']],
        columnDefs: [{ orderable: false, targets: 4 }],
        pageLength: 10,
        language: myLanguage,
    });
});
