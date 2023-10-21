<?php

class post_slider_widget extends WP_Widget {

  function __construct() {
    $options = get_design_plus_option();
    parent::__construct(
      'post_slider_widget',// ID
      __('Post slider (tcd ver)', 'tcd-ankle'),
      array(
        'classname' => 'post_slider_widget',
        'description' => __('Display post slider.', 'tcd-ankle'),
      )
    );
  }

  // Extract Args //
  function widget($args, $instance) {

    global $post;

    extract( $args );
    $title = $instance['title'];
    $post_num = $instance['post_num'];
    $post_type = $instance['post_type'];
    $post_order = $instance['post_order'];

    // Before widget //
    echo $before_widget;

    // Title of widget //
    if ( $title ) { echo $before_title . $title . $after_title; }

    // Widget output //
    if($post_type == 'recent_post') {
      $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => $post_order);
    } else {
      $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
    };

    $options = get_design_plus_option();
    $post_slider_query = new WP_Query($args);
?>
<div class="post_slider swiper">
  <?php

    if ($post_slider_query->have_posts()) {

      $post_count = $post_slider_query->post_count;

  ?>
  <div class="swiper-wrapper" data-post-num="<?php echo $post_count; ?>">
  <?php

      while ($post_slider_query->have_posts()) : $post_slider_query->the_post();

        $image_size = 'landscape2';
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
    <article class="swiper-slide item">
      <a class="link animate_background" href="<?php the_permalink(); ?>">
        <div class="image_wrap">
          <div class="title_area">
            <h4 class="title line2"><span><?php the_title_attribute(); ?></span></h4>
          </div>
          <div class="overlay"></div>
          <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center; background-size:cover;"></div>
        </div>
      </a>
    </article>
  <?php

      endwhile; wp_reset_postdata();

  ?>
  </div><!-- END .swiper-wrapper -->
  <?php if($post_count > 1){ ?>
  <div class="pagination_area">
    <div class="swiper-pagination"></div>
  </div>
  <?php
      }

    }else{

      echo '<p class="no_post">'.__('There is no registered post.', 'tcd-ankle').'</p>';

    }
  
  ?>
</div><!-- END .swiper -->
<?php

    // After widget //
    echo $after_widget;

  } // end function widget


  // Update Settings //
  function update($new_instance, $old_instance) {
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['post_num'] = $new_instance['post_num'];
    $instance['post_type'] = $new_instance['post_type'];
    $instance['post_order'] = $new_instance['post_order'];
    return $instance;
  }

  // Widget Control Panel //
  function form($instance) {
    $defaults = array('title' => '', 'post_num' => 3, 'post_type' => 'recent_post', 'post_order' => 'rand');
    $instance = wp_parse_args( (array) $instance, $defaults );
    $options = get_design_plus_option();
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
    <?php for ( $i = 2; $i <= 10; $i++ ) { ?>
    <option value="<?php echo $i; ?>" <?php selected($i, $instance['post_num']); ?>><?php echo $i; ?></option>
    <?php } ?>
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


function register_post_slider_widget() {
	register_widget( 'post_slider_widget' );
}
add_action( 'widgets_init', 'register_post_slider_widget' );

