//confirm modal
function showConfirmModal(title, msg, func, data, callback){
    if (data){
        data = JSON.stringify(data);
    }
    var confirmModal;
    confirmModal = $('#confirmModalMsg');
    confirmModal.find('.modal-title').text(title);
    confirmModal.find('.modal-body').text(msg);
    confirmModal.find('#btnConfirm').attr({'rel': func, 'data' : data});
    if (typeof callback !== 'undefined') {
        confirmModal.find('#btnDisagree').attr({'rel': callback, 'data' : data});
    }
    confirmModal.modal('show');
}

//confirm
$('#confirmModalMsg').on('click', '#btnConfirm, #btnDisagree', function(){
    var func, data;
    func = $(this).attr('rel');
    data = $(this).attr('data');
    $('#confirmModalMsg').modal('hide');
    if (isEmptyValues(func)){
        return false;
    }
    window[func](data);
});

//loading img
function loadingImg(action){
    if (action === 'show') {
        $('#spinLoading').attr('hidden');
    } else {
        $('#spinLoading').removeAttr('hidden');
    }
}

/* Xóa các dữ liệu, validate các trường khi ẩn Modal */
function eventCloseHiddenModal(modal, fieldSelect = []) {
    modal.find('.is-invalid').removeClass('is-invalid');
    modal.find('.form-control').val('');
    if(fieldSelect.length > 0) {
        fieldSelect.forEach(field => {
            modal.find('#' + field).find(`option[value=""]`).prop('selected', true);
        });
    }
}

function setOptionSelectedDisable(id, text) {
    document.getElementById(id).innerHTML = '<option value="" selected disabled>--- Chọn ' + text + ' ---</option>';
}

try {
    //show notify message
    function notifyMessage(title = 'Lỗi!', message = '', type = 'error', timeout = 5000) {
        if (!timeout) {
            timeout = 5000;
        }

        if (['success', 'info', 'warning', 'error'].indexOf(type) > -1) {
            Swal.fire({
                title: title,
                icon: type,
                text: message,
                showConfirmButton: true,
                confirmButtonText: 'Đóng',
                timer: timeout
            });
            return;
        }
        Swal.fire({
            title: title,
            icon: 'error',
            text: message,
            showConfirmButton: true,
            confirmButtonText: 'Đóng',
            timer: timeout
        });
        return;
    }

    // scrollTo element
    $(function(){
        $.fn.scrollTo = function(speed){
            if (!speed) {
                speed = 1000;
            }
            $('html, body').animate({
                scrollTop: this.offset().top - 150
            }, speed);
        }
    });

    // ajax get
    function callAjaxGet(url, data, ajaxType, loading) {
        if (!data || typeof data == 'undefined') {
            data = {};
        }
        if (!ajaxType || typeof ajaxType == 'undefined') {
            ajaxType = 'json';
        }
        if (loading !== 'hide') {
            loading = 'show'
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            }
        });
        return $.ajax({
            url: url,
            type: 'get',
            data: data,
            dataType: ajaxType,
            beforeSend: loadingImg(loading),
            timeout: 15000
        })
            .always(function() {
                loadingImg('hide');
            })
            .fail(function(data) {
                // console.log(data);
            })
            .done(function(res){
                /* if (!res.status) {
                    checkToken();
                } */
            });
    }

    //ajax post
    function callAjaxPost(url, data, loading) {
        if (!data || typeof data == 'undefined'){
            data = {};
        }
        if (loading !== 'hide') {
            loading = 'show';
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            }
        });
        return $.ajax({
            url: url,
            type: 'post',
            data: data,
            dataType: 'json',
            beforeSend: loadingImg(loading),
            timeout: 15000
        })
            .always(function() {
                loadingImg('hide');
            })
            .fail(function(data) {
                // console.log(data);
            })
            .done(function(res){
                /* if (!res.status) {
                    checkToken();
                } */
            });
    }

    function checkErrorResAjax(res) {
        if (!res.status) {
            notifyMessage('Thông báo Lỗi!', res.msg, 'error', 3000);
            return;
        }
    }
} catch(err) {
    console.log(err);
}

function isEmptyValues(value) {
    return value === undefined || value === null || value === NaN || (typeof value === 'object' && Object.keys(value).length === 0 || (typeof value === 'string' && value.trim().length === 0));
}

$('[data-toggle="popover"]').popover();
