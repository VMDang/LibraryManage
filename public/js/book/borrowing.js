$(function () {
    $('#select-book-id').change(function(){
        id = $('#select-book-id').find(':selected').data('id')
        author = $('#select-book-id').find(':selected').data('author')
        $('#book-id').attr('value', id)
        $('#input-author').attr('value', author)
    })

    // $('.view-form').click(function() {
    //     var index = $(this).data('index'); // Lấy vị trí của popup từ thuộc tính data-index
    //     var borrowing = borrowings[index];

    //     // Lấy thông tin từ đối tượng borrowing tại vị trí index
    //     var user_name = borrowing.user.name;
    //     var user_gender = borrowing.user.gender;
    //     var user_birthday = borrowing.user.birthday;
    //     var user_email = borrowing.user.email;
    //     var book_name = borrowing.book.name;
    //     var author = borrowing.book.author;

    //     // Hiển thị thông tin trong popup
    //     $('#borrowing-click').find('.modal-body #fullname').val(user_name);
    //     $('#borrowing-click').find('.modal-body #gender').val(user_gender);
    //     $('#borrowing-click').find('.modal-body #birthday').val(user_birthday);
    //     $('#borrowing-click').find('.modal-body #email').val(user_email);
    //     $('#borrowing-click').find('.modal-body #bookname').val(book_name);
    //     $('#borrowing-click').find('.modal-body #author').val(author);
    // });

})