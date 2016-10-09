<?php
/*
Template Name: Archives
*/

?>

<?php get_header(); ?>
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
        <div class="col-sm-8 blog-main">
          <div class="blog-post">
            <?php the_post(); ?>
            <h2 class="blog-post-title">
              Archives by Month :
            </h2>
            <?php get_search_form(); ?>
            <?php wp_get_archives('type=monthly'); ?>
		      </div>
        </div><!-- /.blog-main -->

        <aside class="col-sm-3">
          <div class="widget sidebar-module-inset">
            <?php if(is_active_sidebar('about')): ?>
              <?php dynamic_sidebar('about'); ?>
            <?php endif; ?>
          </div>
          <div class="widget sidebar-module">
            <?php if(is_active_sidebar('sidebar')): ?>
              <?php dynamic_sidebar('sidebar'); ?>
            <?php endif; ?>
          </div>
        </aside><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->



    <?php get_footer(); ?>
