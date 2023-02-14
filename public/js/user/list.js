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

    $('.recoverAccount').on('click', function () {
        let data = {
            id: $(this).attr('data-id')
        };
        let uri = '/user/recoverAccountAjax';
        confirmAlert('Xác nhận', 'Bạn có chắc chắn muỗn khôi phục tài khoản này không?', 'warning', uri, data);
    });

    $('.lockAccount').on('click', function () {
        let data = {
            id: $(this).attr('data-id')
        };
        let uri = '/user/lockAccountAjax';
        confirmAlert('Xác nhận', 'Bạn có chắc chắn muốn khóa tài khoản này không?', 'warning', uri, data);
    });

    $('.deleteAccount').on('click', function () {
        let data = {
            id: $(this).attr('data-id')
        };
        let uri = '/user/deleteAccountAjax';
        confirmAlert('Xóa tài khoản', 'Hành động này không thể khôi phục!', 'warning', uri, data);
    });

    $('.change-role-account').on('click', function () {
        let data = {
            id: $(this).attr('data-id'),
            role_id : $(this).attr('data-action'),
        };
        let uri = '/user/updateRoleAjax';
        confirmAlert('Cập nhật vai trò', 'Bạn có chắc chắn muốn cấp quyền cho người dùng này?', 'warning', uri, data);
    })

    let formFilterUser = $('#formFilterUser');
    //Đặt các trường dữ liệu về empty khi khi bấm reset form filter
    formFilterUser.on('click', '#btnReset', function (){
        formFilterUser.find('.form-control').val('');
        formFilterUser.find('option[value=""]').prop('selected');
    });
})
