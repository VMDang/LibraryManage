$(function () {
    $('#select-book-id').change(function(){
        id = $('#select-book-id').find(':selected').data('id')
        author = $('#select-book-id').find(':selected').data('author')
        $('#book-id').attr('value', id)
        $('#input-author').attr('value', author)
    })

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
             'bookname', 'author', 'status', 'location', 'message_user', 'date_borrow',
             'due_date',].forEach(field => {
                modalApprove.find('#' + field).val(BorrowingInfo[field]);
            });

            if(BorrowingInfo.status){
                $('#btnDeni').addClass('d-none');
                $('#btnSave').addClass('d-none');
                $('#message_approver').prop('readonly', true);
                $('#due_date').prop('disabled', true);
            }

            if (BorrowingInfo['gender']) {
                modalApprove.find('#gender1').prop('checked', true);
            } else {
                modalApprove.find('#gender2').prop('checked', true);
            }

            modalApprove.find('#birthday').flatpickr('#birthday', {
                dateFormat: 'd/m/Y',
            })

            if(BorrowingInfo['status']){
                modalApprove.find('#status').val('Đã duyệt');
            } else {
                modalApprove.find('#status').val('Chưa duyệt');
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
                    setTimeout(function() { window.location.reload(); }, 1000);
                
                });
            },
    
            rules: {
                due_date: {
                    required: true
                },
                date_borow: {
                    require: true
                },
            },
            messages: {
                due_date: {
                    required: "Nhập hạn trả trước khi phê duyệt",
                },
                date_borrow: {
                    require: "Nhập ngày mượn trước khi phê duyệt"
                }
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
                    setTimeout(function() { window.location.reload(); }, 1000);
                
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