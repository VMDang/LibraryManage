$(document).ready(function() {
    $('.open-books-modal').on('click', function(e) {
        e.preventDefault();

        var shelfID = $(this).data('shelf-id');
        var bookList = $(this).data('book-list');

        // Hiển thị tên của category trong modal
        $('#modalShelfID').text($(this).closest('tr').find('td:nth-child(2)').text());

        // Hiển thị danh sách sách trong modal
        var modalBookList = $('#modalBookList');
        modalBookList.empty();

        bookList.forEach(function(book) {
            var row = $('<tr>');
            row.append('<td>' + book.name + '</td>');
            row.append('<td>' + book.category_id + '</td>');
            row.append('<td>' + book.preview_content + '</td>');
            row.append('<td>' + book.file_book + '</td>');
            row.append('<td>' + book.author + '</td>');
            row.append('<td>' + book.publisher + '</td>');
            row.append('<td>' + book.date_publication + '</td>');
            row.append('<td>' + book.cost + '</td>');
            row.append('<td>' + book.number + '</td>');
            row.append('<td>' + book.status + '</td>');

            modalBookList.append(row);
        });

        // Mở modal sách
        $.magnificPopup.open({
            items: {
                src: '#booksModal'
            },
            type: 'inline',
            midClick: true,
            closeBtnInside: true
        });
    });

    $('.updateBtn').on('click', function(e){
         e.preventDefault();

         var shelf = $(this).data('shelf');    
         var inputId = $('#input-shelfID');
         var inputStatus = $('#statusSelectUpdate');
         var inputFloor = $('#floorSelectUpdate');
         var inputRoom = $('#roomSelectUpdate');
         var inputshelf = $('#shelfSelectUpdate');
 
        var status = shelf.status === 1 ? 'Còn trống' : 'Đầy';
        inputId.val(shelf.id);
         
        //  // Lấy tất cả các option trong phần tử select
        var optionsStatus = inputStatus.find('option');
        // Lặp qua từng option và làm việc với chúng
        optionsStatus.each(function() {
            var text = $(this).text(); // Lấy nội dung hiển thị của option
            if(text === status) $(this).prop('selected',true);
        });
         // Mở modal sách
        $.magnificPopup.open({
            items: {
                src: '#updateModalShelf'
            },
            type: 'inline',
            midClick: true,
            closeBtnInside: true
        })
        
    });
   
    $('.deleteBtn').on('click', function () {
        let data = {
            id: $(this).data('shelf')
        };
        let uri = '/shelf/list/delete';
        confirmAlert('Xóa Vị Trí', 'Hành động này không thể khôi phục!', 'warning', uri, data);
    });
        
    
    $('#input-shelf-search').on('click', function(e){
        $('#input-shelf-search').val("");
    })

    
    
});