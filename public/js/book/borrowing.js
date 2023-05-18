$(function () {
    $('#select-book-id').change(function(){
        id = $('#select-book-id').find(':selected').data('id')
        author = $('#select-book-id').find(':selected').data('author')
        $('#book-id').attr('value', id)

        $('#input-author').attr('value', author)        
    })
    
})