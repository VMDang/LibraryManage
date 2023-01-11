$(document).ready(function () {
    'use strict'
    let formUpdateInfoUser = $('#formUpdateInfoUser');

    let inputBirthday = formUpdateInfoUser.find('#birthday');

    /* set datepicker */
    formUpdateInfoUser.find('#birthdayDate').datetimepicker({
        format : datetimepickerFormat,
        locale : 'vi',
        useCurrent: false,
        minDate: moment(inputBirthday.data('min'), datetimepickerFormat),
        maxDate: moment(currentMaxDate, datetimepickerFormat),
    });

    formUpdateInfoUser.validate({
        submitHandler: function () {
            let data = formUpdateInfoUser.serialize()

            callAjaxPost(BASE_URL + '/user/updateUserAjax', data).done(function (res) {
                checkErrorResAjax(res);

                notifyMessage('Thông báo!', res.msg,'success');
                setTimeout(function(){
                    location.reload();
                }, 3000);
            });
        },

        rules: {
            name: {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            phone: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Tên người dùng không được để trống!",
                minlength: "Tên người dùng phải có độ dài ít nhất 2 ký tự",
                maxlength: "Tên người dùng không dài quá 100 ký tự "
            },
            phone: {
                required: "Số điện thoại không để trống",
            },

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

    $('#btnRecoverAccount').on('click', function (e) {
        e.preventDefault();
        let data = {
            id: $(this).attr('data-id')
        };
        let uri = '/user/recoverAccountAjax';
        confirmAlert('Xác nhận', 'Bạn có chắc chắn muỗn khôi phục tài khoản này không?', 'warning', uri, data);
    });

    $('#btnLockAccount').on('click', function (e) {
        e.preventDefault();
        let data = {
            id: $(this).attr('data-id')
        };
        let uri = '/user/lockAccountAjax';
        confirmAlert('Xác nhận', 'Bạn có chắc chắn muốn khóa tài khoản này không?', 'warning', uri, data);
    });

    $('#btnDeleteAccount').on('click', function (e) {
        e.preventDefault();
        let data = {
            id: $(this).attr('data-id')
        };
        let uri = '/user/deleteAccountAjax';
        confirmAlert('Xóa tài khoản', 'Hành động này không thể khôi phục!', 'warning', uri, data);
    });


    $('.btn-change-role').on('click', function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        let data = {
            id: $(this).attr('data-id'),
            role_id : $(this).attr('value'),
        };
        let uri = '/user/updateRoleAjax';
        confirmAlert('Cập nhật vai trò', 'Bạn có chắc chắn muốn cấp quyền cho người dùng này?', 'warning', uri, data);
    })
})
