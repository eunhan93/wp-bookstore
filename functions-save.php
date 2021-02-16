<?php

function bs_save_post_book($post_id) {
  
  if(!empty($_POST['meta'])){  //$_POST['meta'] 값이 있을 때만
    foreach($_POST['meta'] as $k => $v) {
      update_post_meta($post_id, $k, $v);
    }
  }
}

add_action('save_post_book', 'bs_save_post_book');