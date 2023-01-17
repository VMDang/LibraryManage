$(function () {

    function exportDataTable(table) {
        table.DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "pageLength": 25
        }).buttons().container().appendTo('#' + table.attr('id') + '_wrapper .col-md-6:eq(0)');
    }

    exportDataTable($('#tableListUsers'));

    exportDataTable($('#tableListUsersSoftDeleted'));

    exportDataTable($('#tableListAdmins'));

    exportDataTable($('#tableListMods'));
})
