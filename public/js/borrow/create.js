$(document).ready(function() {
    $('.select2').select2();

    $('#select-book-id').change(function(){
        let id = $('#select-book-id').find(':selected').data('id')
        let author = $('#select-book-id').find(':selected').data('author')
        $('#book-id').attr('value', id)
        $('#input-author').attr('value', author)
    })
});
