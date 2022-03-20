$(document).ready(function() {
    $('#table-ss').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "./list",
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "phone" },
            { "data": "job" },
            { "data": "created_at" },
        ]
    });
});