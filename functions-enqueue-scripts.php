<?php

function bs_admin_enqueue_scripts(){

  if(get_current_screen() -> id === 'book'){
    wp_enqueue_script(
      'bs_media', 
      get_template_directory_uri() . '/js/book-edit-media.js', 
      ['media-views'],  // [] = deps 의존, 다른 스크립트의 handle 값(첫번째 인자값). 여기에 값이 들어가면 해당 값 다음에 입력됨.
      '2021-02-16', true);
  }


  wp_enqueue_style('bs-bookstore-admin-css',
    get_template_directory_uri() . '/admin.css',
    [],
    1.0
  );  
}



add_action('admin_enqueue_scripts', 'bs_admin_enqueue_scripts');



add_action('wp_enqueue_scripts', function(){
  wp_enqueue_script(
    'wpwp_media', 
    get_template_directory_uri() . '/js/script-book-info.js', 
    ['media-views'],  // [] = deps 의존, 다른 스크립트의 handle 값(첫번째 인자값). 여기에 값이 들어가면 해당 값 다음에 입력됨.
    '2021-02-18', true);


    wp_enqueue_style('bs-bookstore-css',
    get_template_directory_uri() . '/css/style.css',
    [],
    1.0
  ); 
});