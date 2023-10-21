<?php

class styled_post_list_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'styled_post_list_widget',// ID
      __( 'Styled post list (tcd ver)', 'tcd-ankle' ),
      array(
        'classname' => 'styled_post_list_widget',
        'description' => __('Displays styled post list.', 'tcd-ankle')
      )
    );
  }

  // Extract Args //
  function widget($args, $instance) {

    extract( $args );

    // Before widget //
    echo $before_widget;

    // Title of widget //
    $title = $instance['title'];
    if ( $title ) echo $before_title . $title . $after_title;

    $post_num = $instance['post_num'];
    $post_type = $instance['post_type'];
    $post_order = $instance['post_order'];

    // Widget output //
    if($post_type == 'recent_post') {
      $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => $post_order);
    } else {
      $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
    };

    $options = get_design_plus_option();
    $styled_post_list=new WP_Query($args);

?>
<div class="styled_post_list">
<?php

		if ($styled_post_list->have_posts()) {
      while ($styled_post_list->have_posts()) : $styled_post_list->the_post();

        $image_size = 'square1';
				if(has_post_thumbnail()) {
          $image = wp_get_attachment_image_src( get_post_thumbnail_id(), $image_size );
        } elseif($options['blog_no_image']) {
          $image = wp_get_attachment_image_src( $options['blog_no_image'], $image_size );
        } elseif($options['no_image1']) {
          $image = wp_get_attachment_image_src( $options['no_image1'], $image_size );
        } else {
          $image = array();
          $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image1.gif";
        }

?>
<article class="item">
  <a class="link animate_background" href="<?php the_permalink() ?>">
		<div class="image_wrap">
			<div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
		</div>
		<div class="title_area">
			<h4 class="title line3"><span><?php the_title_attribute(); ?></span></h4>
		</div>
  </a>
</article>
<?php endwhile; wp_reset_query(); } else { ?>
<p class="no_post"><?php _e('There is no registered post.', 'tcd-ankle');  ?></p>
<?php }; ?>
</div>
<?php

    // After widget //
    echo $after_widget;

  } // end function widget


  // Update Settings //
  function update($new_instance, $old_instance) {
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['post_num'] = $new_instance['post_num'];
    $instance['post_order'] = $new_instance['post_order'];
    $instance['post_type'] = $new_instance['post_type'];
    return $instance;
  }

  // Widget Control Panel //
  function form($instance) {
    $defaults = array( 'title' => __('Recent post', 'tcd-ankle'), 'post_num' => 3, 'post_order' => 'date', 'post_type' => 'recent_post');
    $instance = wp_parse_args( (array) $instance, $defaults );
?>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php echo tcd_admin_label('headline'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>'" type="text" value="<?php echo $instance['title']; ?>" />
</div>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Article type', 'tcd-ankle'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_type'); ?>" class="widefat" style="width:100%;">
  <option value="recent_post" <?php selected('recent_post', $instance['post_type']); ?>><?php _e('All post', 'tcd-ankle'); ?></option>
  <option value="recommend_post1" <?php selected('recommend_post1', $instance['post_type']); ?>><?php _e('Recommend post', 'tcd-ankle'); ?>1</option>
  <option value="recommend_post2" <?php selected('recommend_post2', $instance['post_type']); ?>><?php _e('Recommend post', 'tcd-ankle'); ?>2</option>
  <option value="recommend_post3" <?php selected('recommend_post3', $instance['post_type']); ?>><?php _e('Recommend post', 'tcd-ankle'); ?>3</option>
 </select>
</div>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Number of post', 'tcd-ankle'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_num'); ?>" class="widefat" style="width:100%;">
  <option value="2" <?php selected('2', $instance['post_num']); ?>>2</option>
  <option value="3" <?php selected('3', $instance['post_num']); ?>>3</option>
  <option value="4" <?php selected('4', $instance['post_num']); ?>>4</option>
  <option value="5" <?php selected('5', $instance['post_num']); ?>>5</option>
  <option value="6" <?php selected('6', $instance['post_num']); ?>>6</option>
  <option value="7" <?php selected('7', $instance['post_num']); ?>>7</option>
  <option value="8" <?php selected('8', $instance['post_num']); ?>>8</option>
  <option value="9" <?php selected('9', $instance['post_num']); ?>>9</option>
  <option value="10" <?php selected('10', $instance['post_num']); ?>>10</option>
 </select>
</div>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Post order', 'tcd-ankle'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_order'); ?>" class="widefat" style="width:100%;">
  <option value="date" <?php selected('date', $instance['post_order']); ?>><?php _e('Post date', 'tcd-ankle'); ?></option>
  <option value="rand" <?php selected('rand', $instance['post_order']); ?>><?php _e('Random', 'tcd-ankle'); ?></option>
 </select>
</div>
<?php

  } // end function form

} // end class


function register_styled_post_list_widget() {
	register_widget( 'styled_post_list_widget' );
}
add_action( 'widgets_init', 'register_styled_post_list_widget' );