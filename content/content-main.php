<body>
<div class="blog-masthead">
  <div class="container">
    <nav class="blog-nav cl-effect-3">

      <?php
        wp_nav_menu( array(
            'menu'              => 'primary',
            'theme_location'    => 'primary',
            'depth'             => 2,
            'container'         => 'div',
            'container_class'   => 'collapse navbar-collapse',
            'container_id'      => 'bs-example-navbar-collapse-1',
            'menu_class'        => 'nav navbar-nav',
            'echo' 		          => true,
            'before'            => '',
            'after'             => '',
            'link_before'       => '',
            'link_after'        => '',
            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
            'walker'            => new custom_nav())
        );
      ?>
    </nav>
  </div>
</div>

<div class="container">
  <div class="jumbotron">
    <div class="row">
      <div class="col-md-6">
        <h1 class="blog-title">
          <?php bloginfo('name'); ?>
        </h1>
        <p class="lead blog-description">
          <?php bloginfo('description'); ?>
        </p>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-9 blog-main">
      <?php if(have_posts()) : ?>
      <?php while(have_posts()) : the_post(); ?>
      <div class="blog-post">
        <h2 class="blog-post-title">
          <a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>

        <p><?php the_excerpt(); ?></p>
      </div><!-- /.blog-post -->
    <?php endwhile; ?>
    <?php else: ?>
      <?php __('No Post Found'); ?>
    <?php endif; ?>

      <nav>
        <ul class="pager">
          <li><a href="#">Previous</a></li>
          <li><a href="#">Next</a></li>
        </ul>
      </nav>

    </div><!-- /.blog-main -->
