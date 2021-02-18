jQuery('.js-import').click(function(e){
  let $ = jQuery,
      base64EncodedBook = $(this).data('book');

  $.post(ajaxurl, {
    action: 'import_books',
    base64EncodedBook: base64EncodedBook,
  }, function(res) {
    console.log(res)
    if(res.result === 'success'){
      $(e.target)
        .text('가져옴')
        .attr('disabled', true);
    } else {
      alert(res.message)
    }
  }, 'json')
});
