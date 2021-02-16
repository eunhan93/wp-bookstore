(function () {


  const coverImageBtn = document.querySelector('.js-open-book-cover-media')

  const bookCoverRemoveBtn = document.querySelector(".js-remove-book-cover")
  
  
  function renderCoverAndShowRemoveBtn(attachment) {
    let imgEl = `<img src="${attachment.sizes.medium.url}" />`
    const bookCoverThumb = document.querySelector('.js-book-cover-thumbnail')
    bookCoverThumb.innerHTML = imgEl;
    bookCoverRemoveBtn.style.display = 'inline-block'
  }


  function initMediaObject() {
    return wp.media({
      frame: 'post',
      title : '표지를 선택해 주세요',
      library:{
        type : 'image'
      },
      button : {
        text : '넣기'
      },
      // className : 'media-frame custom-class-name' => media-frame 먼저 넣어주고 뒤에 넣고 싶으면 넣는다
    });
  }


  function bindOpenMediaLibrary() {
    coverImageBtn.addEventListener('click', function(){
      media.open();
    });
  }

  function bindSelectCover() {
    media.on('insert', function () { // frame이 post라면 insert, select 또는 입력하지 않았다면 select
      let attachment = media.state().get('selection').first().toJSON();
      let attachments = media.state().get('selection').toJSON();

  
      renderCoverAndShowRemoveBtn(attachment);
  
      const bookCoverInput = document.querySelector("[name='meta[cover_id]']")
      bookCoverInput.value = attachment.id
    });
  }

  function renderCoverAlreadyHas(){
    if(document.querySelector("[name='meta[cover_id]']").value){
      wp.media.attachment(document.querySelector("[name='meta[cover_id]']").value)
      .fetch()
      .then(renderCoverAndShowRemoveBtn)
    }
  }

  function bindRemoveCover() {
    bookCoverRemoveBtn.addEventListener('click', function() {
      document.querySelector("[name='meta[cover_id]']").value = ''
      document.querySelector('.js-book-cover-thumbnail').innerHTML = ''
      this.style.display = 'none'
    })
  }

  let media = initMediaObject()

  bindOpenMediaLibrary();

  bindSelectCover();

  renderCoverAlreadyHas();
  
  bindRemoveCover();
  


  


}());

