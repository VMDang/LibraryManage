
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
        var location = shelf.location.split(" - ");
        var floorSelected = location[0];
        var roomSelected = location[1];
        var shelfSelected = location[2];
        console.log(floorSelected, roomSelected, shelfSelected);
        inputId.val(shelf.id);
         
         // Lấy tất cả các option trong phần tử select
        var optionsStatus = inputStatus.find('option');
        // Lặp qua từng option và làm việc với chúng
        optionsStatus.each(function() {
            var text = $(this).text(); // Lấy nội dung hiển thị của option
            if(text === status) $(this).prop('selected',true);
        });

        var optionsFloor = inputFloor.find('option');
        // Lặp qua từng option và làm việc với chúng
        optionsFloor.each(function() {
            var text = $(this).text(); // Lấy nội dung hiển thị của option
            if(text === floorSelected) $(this).prop('selected',true);
        });
        handleFloorChange(inputFloor);
        var optionsRoom = inputRoom.find('option');
        // Lặp qua từng option và làm việc với chúng
        optionsRoom.each(function() {
            var text = $(this).text(); // Lấy nội dung hiển thị của option
            if(text === roomSelected) $(this).prop('selected',true);
        });
        handleRoomChange(inputRoom);
        var optionsShelf = inputshelf.find('option');
        // Lặp qua từng option và làm việc với chúng
        optionsShelf.each(function() {
            var text = $(this).text(); // Lấy nội dung hiển thị của option
            if(text === shelfSelected) $(this).prop('selected',true);
        });
        
         // Mở modal sách
        $.magnificPopup.open({
            items: {
                src: '#updateModal'
            },
            type: 'inline',
            midClick: true,
            closeBtnInside: true
        })
        
    });
   
        
    
    $('#input-shelf-search').on('click', function(e){
        $('#input-shelf-search').val("");
    })

    function validateForm() {
        var floorSelect = document.getElementById('floorSelect');
        var roomSelect = document.getElementById('roomSelect');
        var shelfSelect = document.getElementById('shelfSelect');
        var inputName = document.getElementById('input-name');
        var inputStatus = document.getElementById('input-status');
        // Kiểm tra xem các trường đã được chọn hết hay chưa
        if (floorSelect.value === '' || roomSelect.value === '' || shelfSelect.value === ''|| inputName.value === ''|| inputStatus.value === '') {
            alert('Vui lòng chọn đầy đủ các trường!');
            return false; // Ngăn form được submit
        }
        return true; // Cho phép form được submit
    }
    
});