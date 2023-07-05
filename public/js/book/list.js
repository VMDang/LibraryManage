$(function () {
    let tableBooks = $('#tableListBooks').DataTable();
    tableBooks.destroy();
    function exportDataTable(table) {
        table.DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "pageLength": 25,
            "columnDefs": [
                { "orderable": false, "targets": [2, 3, 4, 5, 7, 8] }
            ]
        }).buttons().container().appendTo('#' + table.attr('id') + '_wrapper .col-md-6:eq(0)');
    }

    exportDataTable($('#tableListBooks'));

    let modalBorrowBook = $('#modalBorrowBook');
    $('#tableListBooks').on('click', '.btnBorrowBook', function () {
        let userId = $(this).attr('data-user-id');
        callAjaxGet(BASE_URL + '/user/getInfoAjax/' + userId).done(function(res) {
            if (!res.status) {
                notifyMessage('Lỗi!', res.msg, 'error', 3000);
                return;
            }
            let user = res.data;
            /* set field value */
            ['name', 'birthday', 'email', 'gender'].forEach(field => {
                modalBorrowBook.find('#' + field).val(user[field]);
            });

            if (user['gender']) {
                modalBorrowBook.find('#gender1').prop('checked', true);
                modalBorrowBook.find('#gender2').attr("disabled",true);
            } else {
                modalBorrowBook.find('#gender2').prop('checked', true);
                modalBorrowBook.find('#gender1').attr("disabled",true)
            }

            modalBorrowBook.modal('show');
        });

        let bookId = $(this).attr('data-book-id');

        callAjaxGet(BASE_URL + '/books/getInfoAjax/' + bookId).done(function (res) {
            if (!res.status) {
                notifyMessage('Lỗi!', res.msg, 'error', 3000);
                return;
            }

            let book = res.data;
            modalBorrowBook.find('#book_id').val(book['id']);
            modalBorrowBook.find('#book-name').val(book['name']);
            modalBorrowBook.find('#author').val(book['author']);
            modalBorrowBook.find('#book_location').val(book['author']);
        })
    })

    $('[data-toggle="popover"]').popover();

    $('.closeModal').on('click', function () {
        eventCloseHiddenModal(modalBorrowBook);
    })

    modalBorrowBook.on('hidden.bs.modal', function () {
        eventCloseHiddenModal(modalBorrowBook);
    })
})
