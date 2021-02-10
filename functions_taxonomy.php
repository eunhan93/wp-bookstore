<?php


function bs_custom_taxonomy(){
  
  register_taxonomy('book_subject', 'book', [
    'label' => [
        'name'              => '주제',
        'singular_name'     => '주제',
        'search_items'      => __( 'Search Genres', 'textdomain' ),
        'all_items'         => __( 'All Genres', 'textdomain' ),
        'parent_item'       => __( 'Parent Genre', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Genre:', 'textdomain' ),
        'edit_item'         => __( 'Edit Genre', 'textdomain' ),
        'update_item'       => __( 'Update Genre', 'textdomain' ),
        'add_new_item'      => __( 'Add New Genre', 'textdomain' ),
        'new_item_name'     => __( 'New Genre Name', 'textdomain' ),
        'menu_name'         => __( 'Genre', 'textdomain' ),
    ],
    'show_admin_column' => true,
    'hierarchical' => true,
  ]);

  register_taxonomy('book_author', 'book', [
    'label' => '저자',
    'show_admin_column' => true,
  ]);

  register_taxonomy('book_translator', 'book', [
    'label' => '역자',
    'show_admin_column' => true,
  ]);


}

add_action('init', 'bs_custom_taxonomy');