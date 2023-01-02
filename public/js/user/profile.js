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
})
