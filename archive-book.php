<?php get_header(); ?>

<div class="wrap postTypeBook">
  <div class="container">

  
    <?php 


      if ( have_posts() ) {
        while ( have_posts() ) {
          the_post();

         

          $coverImgId = get_post_meta( get_the_ID(), 'cover_id', true );
      ?>
      <a href="<?php the_permalink(); ?>">
        <section class="section">
          <div class="inner_section">
            <img src="<?php echo get_post($coverImgId) -> guid; ?>" alt="<?php echo the_title();?>">
          </div>
          <div class="inner_section">
          <h2>
              
                <?php the_title(); ?>
            </h2>
            <p>
            <?php the_content(); ?>
              
            </p>
          </div>
            
          </section>
          </a>

        <?php
        }
      }
    ?>
  

  </div>


</div>

<?php get_footer(); ?>
