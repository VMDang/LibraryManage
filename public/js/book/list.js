// function addBook() {
//     // Lấy giá trị từ các trường input
//     var category = $('#category').val();
//     var shelf = $('#shelf').val();
//     var title = $('#title').val();
//     var content = $('#content').val();
//     var file = $('#file').val();
//     var author = $('#author').val();
//     var cost = $('#cost').val();
//     var number = $('#number').val();
  
//     // Gửi yêu cầu AJAX đến server để thêm sách
//     $.ajax({
//         url: '/books/add', // Đường dẫn xử lý thêm sách
//         method: 'POST',
//         data: {
//             category: category,
//             shelf: shelf,
//             title: title,
//             content: content,
//             file: file,
//             author: author,
//             cost: cost,
//             number: number
//         },
//         success: function(response) {
//             // Xử lý phản hồi từ server (nếu cần)
//             // Sau khi thêm thành công, làm mới trang để hiển thị danh sách sách mới
//             location.reload();
//         },
//         error: function(xhr) {
//             // Xử lý lỗi (nếu có)
//             console.log(xhr.responseText);
//         }
//     });
//   }