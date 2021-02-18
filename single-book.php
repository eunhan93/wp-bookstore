<?php 

get_header();

if(have_posts()){
  while(have_posts()){
    the_post();

    $postId = get_the_ID();
    $metaArr = get_post_meta($postId);
    // var_dump($metaArr);
    $coverImgId = get_post_meta( $postId, 'cover_id', true );
    $coverImage = get_post($coverImgId);

    // echo '<pre>';
    // var_dump(get_the_terms($postId, get_post_taxonomies($postId)[1])[0] -> name);
    // echo '</pre>';
    ?>

    <div class="wrap singleBookDetail">
      <div class="container">

      <article>  
    <?php 
    // echo '<pre>' ;
    // var_dump($metaArr);
    // echo '</pre>';
    
    ?>
    <header>
      <h1><?php the_title(); ?> 
      <?php 

      if(!empty(get_post_meta( $postId, 'subtitle_head', true ))){
        ?>
      <span style="font-size:1rem; font-weight:normal"> - <?php echo get_post_meta( $postId, 'subtitle_head', true ); ?></span>
        <?php 
      }
        ?>
    
    </h1>
    </header>
    <?php 
      if(!is_page()) { 
    ?>
    <aside>
    
      <?php echo get_the_terms($postId, get_post_taxonomies($postId)[1])[0] -> name; ?> | 
      <?php echo get_the_terms($postId, get_post_taxonomies($postId)[2])[0] -> name; ?> | 
      <?php
      if(!empty(get_post_meta( $postId, 'subtitle_tail', true ))){
        ?>
      <?php echo get_post_meta( $postId, 'subtitle_tail', true ); ?> | 
        <?php } ?>
      
        
      <?php echo get_post_meta( $postId, 'published_date', true ); ?>
      
    </aside>
    <?php    
      }
    ?>
    <section style="display: flex;" class="single_book_section">
    <div>
      <img src="<?php echo $coverImage -> guid;?>" alt="커버" />
    </div>
    <div>
      <?php  ?>
      <table class="single_book_table">
        <tbody>
          <tr>
            <th>정가</th>
            <td><?php echo number_format(get_post_meta( $postId, 'price', true )); ?> 원</td>
          </tr>
          <tr>
            <th>출판일</th>
            <td><?php echo get_post_meta( $postId, 'published_date', true ); ?></td>
          </tr>
          <tr>
            <th>페이지수</th>
            <td><?php echo get_post_meta( $postId, 'pages', true ); ?></td>
          </tr>
          <tr>
            <th>ISBN</th>
            <td><?php echo get_post_meta( $postId, 'isbn', true ); ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    </section>
    
    <div>
    <?php the_content(); ?>
    
    </div>

    <div>
      <h2>목차</h2>
      <div class="toc">
        <?php 
        $tocContent = get_post_meta( $postId, 'toc', true );
          echo nl2br($tocContent);
        ?>
      </div>
    </div>

    <div>
      <h2>저자 소개</h2>
      <div class="bookAuthorInfo">
        <?php 
        $bookAuthorInfo = get_post_meta( $postId, 'book_author_intro', true );
          echo nl2br($bookAuthorInfo);
        ?>
      </div>
    </div>

    <?php 
      $bookTranslatorInfo = get_post_meta( $postId, 'book_translator_intro', true );

      if(!empty($bookTranslatorInfo)){
        ?>
      <div>
        <h2>역자 소개</h2>
        <div class="bookAuthorInfo">
          <?php 
            echo nl2br($bookTranslatorInfo);
          ?>
        </div>
      </div>
      <?php 
      }
    ?>
    


    </article>
      </div>

    </div>


    
    <?php
    
  }
}

get_footer();