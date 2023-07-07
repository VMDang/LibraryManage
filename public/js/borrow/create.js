$(document).ready(function() {
    $('.select2').select2();

    $('#select-book-id').change(function(){
        let id = $('#select-book-id').find(':selected').data('id')
        let author = $('#select-book-id').find(':selected').data('author')
        $('#book-id').attr('value', id)
        $('#input-author').attr('value', author)

        callAjaxGet(BASE_URL + '/borrow/create/updateIDforShowLocationAjax/' + id).done(function(res){
            if (!res.status) {
                notifyMessage('Lỗi!', res.msg, 'error', 3000);
                return;
            }

            let array_shelf = res.data;

            // Lấy phần tử select "book-location"
            let selectBookLocation = $('#select-book-location');
                    
            // Xóa tất cả các tùy chọn hiện tại
            selectBookLocation.empty();
                    
            // Thêm tùy chọn mặc định
            selectBookLocation.append('<option data-id="0" selected="selected">Vị trí</option>');
                    
            // Thêm các tùy chọn từ mảng array_shelf
            for (let i = 0; i < array_shelf.length; i++) {
                let shelf = array_shelf[i];
                let option = $('<option></option>').attr('data-id', shelf).text(shelf);
                selectBookLocation.append(option);
            }
            
            // Refresh select2
            selectBookLocation.select2();
        })
    })
});