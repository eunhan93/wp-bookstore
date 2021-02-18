<html>
<head>
  <?php wp_head(); ?>
  <title><?php bloginfo('name') ?></title>
</head>
<body>
  <header class="header">
    <div class="inner_header">
      <h1>
        <a href="<?php echo home_url(); ?>">
          <img src="http://localhost/wp-1/wp-content/uploads/2021/02/LOGO.png" alt="로고">
        </a>
      </h1>
      <nav>
        <a href="<?php echo home_url(); ?>">home</a>
        <a href="<?php echo get_post_type_archive_link('book'); ?>">book</a>
      </nav>
    </div>
  </header>