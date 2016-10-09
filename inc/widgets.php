<?php

// Custom Widget Area
if (function_exists('register_sidebar')) {

	register_sidebar(array(
		'name'          => 'About',
		'id'            => 'about',
		'description'   => 'This is the widgetized about',
		'before_widget' => '<div id="%1$s" class="sidebar-module %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));
	register_sidebar(array(
		'name'          => 'Sidebar Main',
		'id'            => 'sidebar',
		'description'   => 'This is the widgetized sidebar.',
		'before_widget' => '<div id="%1$s" class="list-unstyled %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));
  register_sidebar(array(
		'name'          => 'Sticky Post',
		'id'            => 'fixed',
		'description'   => 'This is the widgetized Sticky Post On Single',
		'before_widget' => '<div id="%1$s" class="sidebar-module %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));
  register_sidebar(array(
		'name'          => 'Sidebar Post',
		'id'            => 'sidesingle',
		'description'   => 'This is the widgetized sidebar.',
		'before_widget' => '<div id="%1$s" class="sidebar-module %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));
  // Register widgets
  register_widget('ebs_social_widget');
}

// Example vCard widget
class ebs_social_widget extends WP_Widget {
  private $fields = array(
    'title'          => 'Title (optional)',
    'twitter'        => 'Twitter',
    'github'         => 'Github',
    'googleplus'     => 'Google Plus',
    'linkedin'       => 'Linkedin'
  );
  function __construct() {
    $widget_ops = array('classname' => 'ebs_social_widget', 'description' => __('Use this widget to add a social', 'ebs'));
    $this->WP_Widget('ebs_social_widget', __('Social by @misterebs_', 'ebs'), $widget_ops);
    $this->alt_option_name = 'ebs_social_widget';
    add_action('save_post', array(&$this, 'flush_widget_cache'));
    add_action('deleted_post', array(&$this, 'flush_widget_cache'));
    add_action('switch_theme', array(&$this, 'flush_widget_cache'));
  }
  function widget($args, $instance) {
    $cache = wp_cache_get('ebs_social_widget', 'widget');
    if (!is_array($cache)) {
      $cache = array();
    }
    if (!isset($args['widget_id'])) {
      $args['widget_id'] = null;
    }
    if (isset($cache[$args['widget_id']])) {
      echo $cache[$args['widget_id']];
      return;
    }
    ob_start();
    extract($args, EXTR_SKIP);
    $title = apply_filters('widget_title', empty($instance['title']) ? __('Follow us', 'ebs') : $instance['title'], $instance, $this->id_base);
    foreach($this->fields as $name => $label) {
      if (!isset($instance[$name])) { $instance[$name] = ''; }
    }
    echo $before_widget;
    if ($title) {
      echo $before_title, $title, $after_title;
    }
  ?>
    <p class="social">
      <span class="social">
        <span class="twitter"><span class="value"><?php $instance['twitter']; ?></span></span>
        <a class="socialtwitter" href="<?php echo $instance['twitter']; ?>"target="_blank"><i class="fa fa-twitter"></i></a>
        <span class="github"><span class="value"><?php $instance['github']; ?></span></span>
        <a class="socialgithub" href="<?php echo $instance['github']; ?>" target="_blank"><i class="fa fa-github"></i></a>
        <span class="googleplus"><span class="value"><?php $instance['googleplus']; ?></span></span>
        <a class="socialgoogleplus" href="<?php echo $instance['googleplus']; ?>"target="_blank"><i class="fa fa-google-plus"></i></a>
        <span class="linkedin"><span class="value"><?php $instance['linkedin']; ?></span></span>
        <a class="sociallinkedin" href="<?php echo $instance['linkedin']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
      </span>
    </p>
  <?php
    echo $after_widget;
    $cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('ebs_social_widget', $cache, 'widget');
  }
  function update($new_instance, $old_instance) {
    $instance = array_map('strip_tags', $new_instance);
    $this->flush_widget_cache();
    $alloptions = wp_cache_get('alloptions', 'options');
    if (isset($alloptions['ebs_social_widget'])) {
      delete_option('ebs_social_widget');
    }
    return $instance;
  }
  function flush_widget_cache() {
    wp_cache_delete('ebs_social_widget', 'widget');
  }
  function form($instance) {
    foreach($this->fields as $name => $label) {
      ${$name} = isset($instance[$name]) ? esc_attr($instance[$name]) : '';
    ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id($name)); ?>"><?php _e("{$label}:", 'ebs'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id($name)); ?>" name="<?php echo esc_attr($this->get_field_name($name)); ?>" type="text" value="<?php echo ${$name}; ?>">
    </p>
    <?php
    }
  }
}

?>
