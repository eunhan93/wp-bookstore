<?php
class BsImportBooks {
  function __construct()
  {
    add_action('admin_menu', [$this, 'addMenu']);
    add_action('admin_enqueue_scripts', [$this, 'scripts']);
    add_action('wp_ajax_import_books', [$this, 'import']);
  }

  public function addMenu() {
    add_submenu_page(
      'edit.php?post_type=book', 
      '가져오기', 
      '가져오기', 
      'publish_posts', 
      'import-books',
      function () {
        include get_template_directory() . '/admin-pages/import-books-form.php';
        if(!empty($_GET['query'])){
          $request_page = (!empty($_GET['request_page'])) ? $_GET['request_page'] : 1;
          echo $request_page;
          $this -> displayPage($_GET['query'], $request_page);
        }
        
        // if($_SERVER['REQUEST_METHOD'] === 'GET'){
        //   include get_template_directory() . '/admin-pages/import-books-form.php';

        // }
        // if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //   include get_template_directory() . '/admin-pages/import-books-form.php';
        //     $this -> displayPage();
        // }
      }
    );
  }

  public function displayPage($query, $request_page){
      $response = $this -> get($query, $request_page);

      $response_code = wp_remote_retrieve_response_code($response);
      $response_message = wp_remote_retrieve_response_message($response);
      $headers = wp_remote_retrieve_headers($response);
      $body = json_decode(wp_remote_retrieve_body($response));



      $body -> documents = $this -> markDuplications($body -> documents);


      include get_template_directory() . '/admin-pages/import-books-result.php';

  }

  public function get($query, $page = 1){
    $url = "https://dapi.kakao.com/v3/search/book?";

    $query_string = http_build_query([
      "query" => $query,
      "size" => 50,
      "page" => $page
    ]);
    
    $args = [
      'httpversion' => 1.1,
      'headers' => [
        'authorization' => 'KakaoAK ' . KAKAO_REST_API_KEY,
      ],
    ];


    return wp_remote_get($url.$query_string, $args);
}

  
  public function scripts(){
    $current_screen = get_current_screen();
    if($current_screen -> id === 'book_page_import-books'){
      wp_enqueue_script('import-books', get_template_directory_uri() . '/js/import-books.js', ['jquery'], '1.0', true);
    }
    
  }

  public function import(){
    $book = json_decode(base64_decode($_POST['base64EncodedBook']));

    try{
      // book insert
      // 표지 임포트
      $post_id = $this -> insertBook($book);


        // 저자, 
      if(!empty($book -> authors)){
        $result = $this -> insertAuthors($post_id, $book);
      }
     

      
      //역자 지정
      if(!empty($book -> translators)){
        $result = $this -> insertTranslators($post_id, $book);
      }


      // 표지 저장

      if(!empty($book -> thumbnail)){
        $this->insertCover($post_id, $book);
        
      }


      //isbn

      $this -> insertEtc($post_id, $book);



      $response = [
        'result' => 'success',
        'message' => $book -> title . ' 입력 완료.'
      ];
    } catch (\Exception $e){
      $response = [
        'result' => 'fail',
        'message' => $e -> getMessage()
      ];
    }
    
    echo json_encode($response);
    die();
  }


  private function insertBook($book){
    $post_id = wp_insert_post([
      'post_title' => $book -> title,
      'post_content' => $book -> contents,
      'post_status' => 'publish',
      'post_type' => 'book',
    ], true);

    

    if(is_wp_error($post_id)){
      $wp_error = $post_id;
      throw new Exception('책 입력 중 에러.' . $wp_error -> get_error_code() . ' : ' . $wp_error -> get_error_message());
    }

    return $post_id;
  }

  private function insertAuthors($post_id, $book){
    $result = wp_set_post_terms($post_id, $book->authors, 'book_author', true);
    if($result === false){
      throw new Exception('저자 입력 중 post_id에 0이 들어왔습니다.');
    }
    if(is_wp_error($result)){
      $wp_error = $result;
      throw new Exception('저자 입력 중 에러.' . $wp_error -> get_error_code() . ' : ' . $wp_error -> get_error_message());
    }
    return $result;
  }

  private function insertTranslators($post_id, $book){
    $result = wp_set_post_terms($post_id, $book->translators, 'book_translator', true);
    if($result === false){
      throw new Exception('역자 입력 중 post_id에 0이 들어왔습니다.');
    }
    if(is_wp_error($result)){
      $wp_error = $result;
      throw new Exception('역자 입력 중 에러.' . $wp_error -> get_error_code() . ' : ' . $wp_error -> get_error_message());
    }
    return $result;
  }

  private function insertCover($post_id, $book){
    try{
      $parsed = parse_url($book -> thumbnail);
      parse_str($parsed['query'], $query);
      if(!empty($query['fname'])){
        $cover_url = $query['fname'];
      } else {
        $cover_url = $book -> thumbnail;
      }

      $attachment_id = crb_insert_attachment_from_url($cover_url, "{$book->isbn}.jpg", $post_id);
      update_post_meta($post_id, 'cover_id', $attachment_id);

    } catch(\Exception $e){
      throw $e;
    }

  }

  private function insertEtc($post_id, $book){
    update_post_meta($post_id, 'price', $book -> price);
    update_post_meta($post_id, 'isbn', $book -> isbn);
    update_post_meta($post_id, 'published_date', date('Y-m-d', strtotime($book -> datetime)));
  }

  private function markDuplications($books){
    foreach ($books as $i => $book){
      $the_query = new WP_Query([
        'post_type' => 'book',
        'meta_query' => [
          [
            'key' => 'isbn',
            'value' => $book -> isbn
          ]
        ]
      ]);

      $books[$i] -> is_duplication = false;
      if($the_query -> post_count){
        $books[$i] -> is_duplication = true;
      }
    }

    return $books;
  }

}

new BsImportBooks();



// function bs_admin_menu() {
//   add_submenu_page(
//     'edit.php?post_type=book', 
//     '가져오기', 
//     '가져오기', 
//     'publish_posts', 
//     'import-books',
//     function () {
//       include get_template_directory() . '/admin-pages/import-books-form.php';

//       if($_SERVER['REQUEST_METHOD'] === 'POST'){
//         $response = bs_remote_books($_POST['query']);

//         $response_code = wp_remote_retrieve_response_code($response);
//         $response_message = wp_remote_retrieve_response_message($response);
//         $headers = wp_remote_retrieve_headers($response);
//         $body = json_decode(wp_remote_retrieve_body($response));


//         include get_template_directory() . '/admin-pages/import-books-result.php';

//       }
//     }
//   );
// }


// add_action('admin_menu', 'bs_admin_menu'); 


// dcc2c7da6deb4c18299e5094dd469e21