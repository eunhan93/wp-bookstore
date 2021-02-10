<html>
<head>
  <?php wp_head(); ?>
  <title><?php bloginfo('name') ?></title>
</head>
<body>
  <nav>
    <a href="<?php echo home_url(); ?>">home</a>
    <a href="<?php echo get_post_type_archive_link('book'); ?>">book</a>

  </nav>
  <hr>