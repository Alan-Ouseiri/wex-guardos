import { myLanguage } from "./language.js";

$(document).ready(function () {

    $('#miTabla').DataTable({
        ajax: {
            url: $('#miTabla').data('url'),
            dataSrc: '',
            type: 'GET'
        },
        columns: [
            { data: 'user' },
            { data: 'email' },
            { data: 'role' },
            { data: 'buttons' },
        ],
        ordering: true,
        pageLength: 10,
        language: myLanguage,
    });
});
