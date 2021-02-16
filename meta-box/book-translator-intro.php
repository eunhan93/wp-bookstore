<div class="postbox">
<h2 class="postbox-header">역자 소개</h2>
<div class="inside">
<?php
$book_translator_intro = get_post_meta(get_the_ID(), 'book_translator_intro', true);
wp_editor($book_translator_intro, 'book_translator_intro', [
  'textarea_name' => 'meta[book_translator_intro]',
  'textarea_rows' => 5,
]);

?>
</div>


</div>
