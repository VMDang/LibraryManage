$(function () {
    let modalApprove = $('#modalApprove');
    let validator = null;

    $('#tableListReturners').on('click', '.btnDetail', function() {

        let id = $(this).attr('data-id');
        callAjaxGet(BASE_URL + '/return/getRequestReturnBookAjax/' + id).done(function(res) {
            if (!res.status) {
                notifyMessage('Lỗi!', res.msg, 'error', 3000);
                return;
            }
            let aRequestReturnBook = res.data;

            /* set field value */
            ['id', 'name', 'birthday', 'email', 'gender',
                'bookname', 'author', 'location', 'message_user',
                'borrow_date', 'due_date', 'approve_status', 'date_return', 'message_mod'].forEach(field => {
                modalApprove.find('#' + field).val(aRequestReturnBook[field]);
            });

            if(aRequestReturnBook['approve_status']){
                $('#btnDeni').addClass('d-none');
                $('#btnSave').addClass('d-none');
                $('#message_mod').prop('readonly', true);
                $('#borrow_date').prop('disabled', true);
                $('#date_return').prop('disabled', true);
            }else

            if (aRequestReturnBook['gender']) {
                modalApprove.find('#gender1').prop('checked', true);
                modalApprove.find('#gender2').attr("disabled",true);
            } else {
                modalApprove.find('#gender2').prop('checked', true);
                modalApprove.find('#gender1').attr("disabled",true)
            }
            if(aRequestReturnBook['approve_status'] === 0){
                modalApprove.find('#approve_status').val('Chưa duyệt').css("color", "blue");
            } else if(aRequestReturnBook['approve_status'] === 1){
                modalApprove.find('#approve_status').val('Đồng ý').css("color", "green");
            }else if (aRequestReturnBook['approve_status'] === 2){
                modalApprove.find('#approve_status').val('Từ ch́ối').css("color", "red");
            }

            modalApprove.modal('show');
        });
    });

    $('.closeModal').on('click', function() {
        eventCloseHiddenModal(modalApprove);
        $('#btnDeni').removeClass('d-none');
        $('#btnSave').removeClass('d-none');
        $('#message_mod').prop('readonly', false);
        $('#date_return').prop('disabled', false);
        validator.destroy();
        validator = null;
    });

    //Sự kiện Ẩn Modal
    modalApprove.on('hidden.bs.modal', function() {
        eventCloseHiddenModal(modalApprove);
        $('#btnDeni').removeClass('d-none');
        $('#btnSave').removeClass('d-none');
        $('#message_mod').prop('readonly', false);
        $('#date_return').prop('disabled', false);
        validator.destroy();
        validator = null;
    });

    $('#btnSave').click(function(){
         validator = modalApprove.find('form').validate({
            submitHandler: function() {
                let data = modalApprove.find('form').serialize();

                callAjaxPost(BASE_URL + '/return/approve', data).done(function(res) {
                    if (!res.status) {
                        notifyMessage('Lỗi!', res.msg, 'error', 3000);
                        return;
                    }
                    notifyMessage('Thông báo!', res.msg, 'success');
                    modalApprove.modal('hide');
                    setTimeout(function() { window.location.reload(); }, 3000);

                });
            },

            rules: {
                date_return: {
                    required: true
                },
            },
            messages: {
                date_return: {
                    required: "Nhập ngày trả trước khi phê duyệt"
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    })

    $('#btnDeni').click(function(){
        validator = modalApprove.find('form').validate({
            submitHandler: function() {
                let data = modalApprove.find('form').serialize();

                callAjaxPost(BASE_URL + '/return/approve', data).done(function(res) {
                    if (!res.status) {
                        notifyMessage('Lỗi!', res.msg, 'error', 3000);
                        return;
                    }
                    notifyMessage('Thông báo!', res.msg, 'success');
                    modalApprove.modal('hide');
                    setTimeout(function() { window.location.reload(); }, 3000);

                });
            },
            rules: {
                message_mod: {
                    required: true
                },
            },
            messages: {
                message_mod: {
                    required: "Nhập lời nhắn/lý do đến người yêu cầu trước khi từ chối",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    })
})
