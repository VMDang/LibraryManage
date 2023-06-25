$(function () {
    let modalApprove = $('#modalApprove');

    $('#tableListBorrowers').on('click', '.btnDetail', function() {

        let id = $(this).attr('data-id');
        callAjaxGet(BASE_URL + '/borrow/approve/getBorrowingOfInfoAjax/' + id).done(function(res) {
            if (!res.status) {
                notifyMessage('Lỗi!', res.msg, 'error', 3000);
                return;
            }
            let BorrowingInfo = res.data;

            /* set field value */
            ['id', 'name', 'birthday', 'email', 'gender',
             'bookname', 'author', 'status', 'location', 'message_user',
             'due_date', 'message_approver'].forEach(field => {
                modalApprove.find('#' + field).val(BorrowingInfo[field]);
            });

            if(BorrowingInfo.status){
                $('#btnDeni').addClass('d-none');
                $('#btnSave').addClass('d-none');
                $('#message_approver').prop('readonly', true);
                $('#due_date').prop('disabled', true);
                $('#borrow_date').prop('disabled', true);
            }else

            if (BorrowingInfo['gender']) {
                modalApprove.find('#gender1').prop('checked', true);
                modalApprove.find('#gender2').attr("disabled",true);
            } else {
                modalApprove.find('#gender2').prop('checked', true);
                modalApprove.find('#gender1').attr("disabled",true)
            }

            $("#due_date").flatpickr({
                dateFormat: "d/m/Y",
                minDate: "today",
            });

            $('#borrow_date').flatpickr({
                dateFormat: "d/m/Y",
                // defaultDate: "today"
            });

            if(BorrowingInfo['status'] == 0){
                modalApprove.find('#status').val('Chưa duyệt').css("color", "blue");
            } else if(BorrowingInfo['status'] == 1){
                modalApprove.find('#status').val('Đồng ý').css("color", "green");
            }else if (BorrowingInfo['status'] == 2){
                modalApprove.find('#status').val('Từ ch́ối').css("color", "red");
            }

            modalApprove.modal('show');
        });
    });

    //Sự kiện Đóng modal
    $('.closeModal').on('click', function() {
        eventCloseHiddenModal(modalApprove);
        $('#btnDeni').removeClass('d-none');
        $('#btnSave').removeClass('d-none');
        $('#message_approver').prop('readonly', false);
        $('#due_date').prop('disabled', false);

    });

    //Sự kiện Ẩn Modal
    modalApprove.on('hidden.bs.modal', function() {
        eventCloseHiddenModal(modalApprove);
        $('#btnDeni').removeClass('d-none');
        $('#btnSave').removeClass('d-none');
        $('#message_approver').prop('readonly', false);
        $('#due_date').prop('disabled', false);
    });

    $('#btnSave').click(function(){
        modalApprove.find('form').validate({
            submitHandler: function() {
                let data = modalApprove.find('form').serialize();

                callAjaxPost(BASE_URL + '/borrow/approve/approveBorrowingAjax', data).done(function(res) {
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
                borrow_date: {
                    required: true
                },
                due_date: {
                    required: true
                },
            },
            messages: {
                borrow_date: {
                    require: "Nhập ngày mượn trước khi phê duyệt"
                },
                due_date: {
                    required: "Nhập hạn trả trước khi phê duyệt",
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
        modalApprove.find('form').validate({
            submitHandler: function() {
                let data = modalApprove.find('form').serialize();

                callAjaxPost(BASE_URL + '/borrow/approve/approveBorrowingAjax', data).done(function(res) {
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
                message_approver: {
                    required: true
                },
            },
            messages: {
                message_approver: {
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
