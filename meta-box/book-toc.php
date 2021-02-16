<div class="postbox">
<h2 class="postbox-header">목차</h2>
<div class="inside">
<?php

$meta_toc = get_post_meta(get_the_ID(), 'toc', true);
wp_editor($meta_toc, 'book_toc', [
  'textarea_name' => 'meta[toc]',
]);

?>
</div>


</div>
