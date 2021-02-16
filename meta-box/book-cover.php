<style>
  .button-like-text{
    border: none;
    padding: 0;
    background: none;
  }
  .color-danger{
    color : #a00;
    transition: all 0.5s ease;
    font-weight: bold;
    text-decoration: underline;
  }

  .color-danger:hover{
    color : #cd3232;
  }
</style>

<div style="text-align:center">
  <p>
    <button type="button" class="button button-primary js-open-book-cover-media ">표지 넣기</button>
  </p>
  <div class="js-book-cover-thumbnail">

  </div>
  <input type="hidden" name="meta[cover_id]" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'cover_id', true)); ?>">
  <p>
    <button type="button" class="button-like-text color-danger js-remove-book-cover " style="display: none;"
    >표지 제거</button>
  </p>
  
</div>
