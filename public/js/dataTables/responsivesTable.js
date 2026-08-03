import { myLanguage } from "./language.js";

$(document).ready(function () {

    $('#responsiveTable').DataTable({
        ajax: {
            url: $('#responsiveTable').data('url'),
            dataSrc: '',
            type: 'GET'
        },
        columns: [
            { data: 'responsiva_number' },
            { data: 'name' },
            { data: 'description' },
            { data: 'no' },
            { data: 'status' },
            { data: 'button' },
        ],
        order: [[0, 'desc']],
        columnDefs: [{ orderable: false, targets: 5}],
        pageLength: 10,
        language: myLanguage,
    });
});
