<?php

function bs_mng_book_post_columns($columns) {
  $columns = array ( 
    'cb' => "<input type='checkbox' />", 
    'cover' => '표지',
    'title' => '제목', 
    'taxonomy-book_subject' => '주제', 
    'taxonomy-book_author' => '저자', 
    'taxonomy-book_translator' => '역자', 
    'date' => '날짜', 
  );


  return $columns ;
}

function bs_mng_book_posts_custom_column($column, $post_id) {

  switch($column){
    case 'cover' : 
      
      $cover_id = get_post_meta($post_id, 'cover_id', true);
      if(!$cover_id){
        break;
      }

      $imgUrl = wp_get_attachment_image_url($cover_id, 'medium');

      if(!$imgUrl){
        break;
      }

      echo "<img src='{$imgUrl}'>";
      
      break;
  }
}


add_filter('manage_book_posts_columns', 'bs_mng_book_post_columns');

add_action('manage_book_posts_custom_column', 'bs_mng_book_posts_custom_column', 10, 2);