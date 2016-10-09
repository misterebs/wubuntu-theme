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
          <?php custom_breadcrumbs(); ?>
          <h2 class="blog-post-title">
            <?php the_title(); ?>
          </h2>
          <p class="blog-post-meta">Post on <?php the_time('F j, Y'); ?> by
            <a href="<?php echo get_author_posts_url(get_the_author_meta(ID)); ?>">
                    <?php the_author(); ?>
            </a>
          </p>
          <?php if(has_post_thumbnail()) : ?>
                <div class="post-thumb animated zoomIn">
                  <?php the_post_thumbnail(); ?>
                </div>
              <?php endif; ?>
          <?php the_content(); ?>
          Tags : <?php the_tags(' ', ', ', '<br/>'); ?>
              <hr>

            <?php
            $tags = wp_get_post_tags($post->ID);
            if ($tags) {
              $tag_ids = array();
              foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
              $args=array(
                'tag__in' => $tag_ids,
                'post__not_in' => array($post->ID),
                'showposts'=>5, // Number of related posts that will be shown.
                'caller_get_posts'=>1
              );
              $my_query = new wp_query($args);
              if( $my_query->have_posts() ) {
                echo '<h3>Related Posts</h3><ul>';

                while ($my_query->have_posts()) {
                $my_query->the_post();
            ?>
              <div class="related">
                <li>
                <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
              </li>
              </div>
            <?php
      }
      echo '</ul>';
    }
  }
?>

          <?php comments_template(); ?>
        </div><!-- /.blog-post -->
      <?php endwhile; ?>
      <?php else: ?>
        <?php __('No Post Found'); ?>
      <?php endif; ?>

        <nav>
          <ul class="pager">
            <li><a href="<?php next_posts_link('&laquo; Previous Entries') ?>">Previous</a></li>
            <li><a href="<?php previous_posts_link('Next Entries &raquo;') ?>">Next</a></li>
          </ul>
        </nav>

      </div><!-- /.blog-main -->
