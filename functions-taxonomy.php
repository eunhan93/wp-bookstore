<?php


function bs_custom_taxonomy(){
  
  register_taxonomy('book_subject', 'book', [
    'labels' => [
        'name'              => '주제',
        'singular_name'     => '주제',
        'search_items'      => '주제 검색',
        'all_items'         => '전체 주제',
        'parent_item'       => '상위 주제',
        'parent_item_colon' => '상위 주제:',
        'edit_item'         => '주제 편집',
        'update_item'       => '주제 수정',
        'add_new_item'      => '새 주제',
        'new_item_name'     => '새 주제 이름',
        'menu_name'         => '주제',
    ],
    'show_admin_column' => true,
    'hierarchical' => true,
  ]);


  register_taxonomy('book_author', 'book', [
    'labels' => [
      'name'              => '저자',
      'singular_name'     => '저자',
      'search_items'      => '저자 검색',
      'all_items'         => '전체 저자',
      'edit_item'         => '저자 편집',
      'update_item'       => '저자 수정',
      'add_new_item'      => '새 저자',
      'new_item_name'     => '새 저자 이름',
      'menu_name'         => '저자',
  ],
    'show_admin_column' => true,
  ]);

  register_taxonomy('book_translator', 'book', [
    'labels' => [
      'name'              => '역자',
      'singular_name'     => '역자',
      'search_items'      => '역자 검색',
      'all_items'         => '전체 역자',
      'edit_item'         => '역자 편집',
      'update_item'       => '역자 수정',
      'add_new_item'      => '새 역자',
      'new_item_name'     => '새 역자 이름',
      'menu_name'         => '역자',
  ],
    'show_admin_column' => true,
  ]);


}

add_action('init', 'bs_custom_taxonomy');