$(document).ready(function() {

    $('.open-books-modal').on('click', function(e) {
        e.preventDefault();

        var categoryName = $(this).data('category-name');
        var bookList = $(this).data('book-list');

        // Hiển thị tên của category trong modal
        $('#modalCategoryName').text($(this).closest('tr').find('td:nth-child(2)').text());

        // Hiển thị danh sách sách trong modal
        var modalBookList = $('#modalBookList');
        modalBookList.empty();

        bookList.forEach(function(book) {
            var row = $('<tr>');
            row.append('<td>' + book.name + '</td>');
            row.append('<td>' + book.shelf_id + '</td>');
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

         var category = $(this).data('category');
         var inputID = $('#input-id');
         var inputName = $('#input-name1');
         var inputStatus = $('#input-status');
         var inputDescription = $('#input-description');

         inputID.val(category.id);
         inputName.val(category.name);
         inputStatus.val(category.status);
         inputDescription.val(category.description);

         // Mở modal sách
        $.magnificPopup.open({
            items: {
                src: '#updateModal'
            },
            type: 'inline',
            midClick: true,
            closeBtnInside: true
        });
    })
    setTimeout(function() {
        var errorAlert = document.getElementById('error-alert');
        if (errorAlert) {
            errorAlert.style.display = 'none';
        }
    }, 1500);

    $('#input-category-search').on('click', function(e){
        $('#input-category-search').val("");
    })
    $('.deleteBtn').on('click', function () {
        let data = {
            id: $(this).data('category')
        };
        let uri = '/category/list/delete';
        confirmAlert('Xóa Thể loại', 'Hành động này không thể khôi phục!', 'warning', uri, data);
    });
        
});
