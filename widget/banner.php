<?php

class tcd_banner_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'tcd_banner_widget',// ID
      __( 'Banner (tcd ver)', 'tcd-ankle' ),
      array(
        'classname' => 'tcd_banner_widget',
        'description' => __('Display designed banner.', 'tcd-ankle')
      )
    );
  }


  function widget($args, $instance) {

    extract($args);

    // Before widget //
    echo $before_widget;

    if(isset($instance['banner_image'])) {
      $image = wp_get_attachment_image_src( $instance['banner_image'], 'full' );
    };
    
    if(!empty($image)) {
      $title = isset($instance['banner_title']) ?  $instance['banner_title'] : '';
      $sub_title = isset($instance['banner_sub_title']) ?  $instance['banner_sub_title'] : '';
      $font_color = isset($instance['banner_font_color']) ?  $instance['banner_font_color'] : '#ffffff';
      $url = isset($instance['banner_url']) ?  $instance['banner_url'] : '#';
      $use_overlay = isset($instance['banner_use_overlay']) ?  $instance['banner_use_overlay'] : '';
      $overlay_color = isset($instance['banner_overlay_color']) ?  $instance['banner_overlay_color'] : '#000000';
      $overlay_color = hex2rgb($instance['banner_overlay_color']);
      $overlay_color = implode(",",$overlay_color);
      $overlay_style = 'background:-moz-linear-gradient(to top, rgba('.esc_attr($overlay_color).', 95%), transparent);'.
                       'background:-webkit-linear-gradient(to top, rgba('.esc_attr($overlay_color).', 95%), transparent);'.
                       'background:linear-gradient(to top, rgba('.esc_attr($overlay_color).', 95%), transparent);';

?>
<a class="link" href="<?php echo esc_url($url); ?>">
  <?php if($title || $sub_title) { ?>
  <div class="content" style="color:<?php echo esc_attr($font_color); ?>;">
    <span class="sub_title"><?php echo nl2br(esc_html($sub_title)); ?></span>
    <span class="title"><?php echo nl2br(esc_html($title)); ?></span>
  </div>
  <?php } if($use_overlay) { ?>
  <div class="overlay" style="<?php echo $overlay_style; ?>"></div>
  <?php }; ?>
  <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center; background-size:cover;"></div>
</a>
<?php

      }

    // After widget //
    echo $after_widget;

  }

  // Update Settings //
  function update($new_instance, $old_instance) {
    $instance['banner_title'] = $new_instance['banner_title'];
    $instance['banner_sub_title'] = $new_instance['banner_sub_title'];
    $instance['banner_font_color'] = $new_instance['banner_font_color'];
    $instance['banner_url'] = $new_instance['banner_url'];
    $instance['banner_image'] = strip_tags($new_instance['banner_image']);
    $instance['banner_use_overlay'] = $new_instance['banner_use_overlay'];
    $instance['banner_overlay_color'] = $new_instance['banner_overlay_color'];
    return $instance;
  }

  // Widget Control Panel //
  function form($instance) {

    $defaults['banner_title'] = '';
    $defaults['banner_sub_title'] = '';
    $defaults['banner_font_color'] = '#ffffff';
    $defaults['banner_url'] = '#';
    $defaults['banner_image'] = '';
    $defaults['banner_use_overlay'] = '';
    $defaults['banner_overlay_color'] = '#961717';

    $instance = wp_parse_args( (array) $instance, $defaults );

?>
<div class="tcd_widget_content">
  <h3 class="tcd_widget_headline"><?php echo tcd_admin_label('headline'); ?></h3>
  <input type="text" class="full_width" name="<?php echo $this->get_field_name('banner_title'); ?>" value="<?php echo esc_html($instance['banner_title']); ?>" />
</div>

<div class="tcd_widget_content">
  <h3 class="tcd_widget_headline"><?php echo tcd_admin_label('sub_headline'); ?></h3>
  <input type="text" class="full_width" name="<?php echo $this->get_field_name('banner_sub_title'); ?>" value="<?php echo esc_html($instance['banner_sub_title']); ?>" />
</div>

<div class="tcd_widget_content">
  <h3 class="tcd_widget_headline"><?php echo tcd_admin_label('color'); ?></h3>
  <input type="text" name="<?php echo $this->get_field_name('banner_font_color'); ?>" value="<?php echo esc_attr( $instance['banner_font_color'] ); ?>" data-default-color="#ffffff" class="color-picker">
</div>

<div class="tcd_widget_content">
  <h3 class="tcd_widget_headline"><?php _e('URL', 'tcd-ankle'); ?></h3>
  <input style="width:100%;" type="text" name="<?php echo $this->get_field_name('banner_url'); ?>" value="<?php echo esc_url($instance['banner_url']); ?>" />
</div>

<div class="tcd_widget_content">
  <h3 class="tcd_widget_headline"><?php echo tcd_admin_label('bg_image'); ?></h3>
  <div class="widget_media_upload cf cf_media_field hide-if-no-js <?php echo $this->get_field_id('banner_image'); ?>">
    <input type="hidden" value="<?php echo $instance['banner_image']; ?>" id="<?php echo $this->get_field_id('banner_image'); ?>" name="<?php echo $this->get_field_name('banner_image'); ?>" class="cf_media_id">
    <div class="preview_field"><?php if($instance['banner_image']){ echo wp_get_attachment_image($instance['banner_image'], 'medium'); }; ?></div>
    <div class="buttton_area">
      <input type="button" value="<?php echo tcd_admin_label('select_image'); ?>" class="cfmf-select-img button">
      <input type="button" value="<?php echo tcd_admin_label('remove_image'); ?>" class="cfmf-delete-img button <?php if(!$instance['banner_image']){ echo 'hidden'; }; ?>">
    </div>
  </div>
</div>    

<div class="tcd_widget_content">
  <h3 class="tcd_widget_headline"><?php echo tcd_admin_label('overlay'); ?></h3>
  <p class="displayment_checkbox"><label><input name="<?php echo $this->get_field_name('banner_use_overlay'); ?>" type="checkbox" value="1" <?php checked( $instance['banner_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-ankle' ); ?></label></p>
  <ul class="option_list" style="border-top:1px dotted #ddd; padding:8px 0 0 0;">
    <li class="cf"><span class="label"><?php echo tcd_admin_label('overlay_color'); ?></span><input type="text" name="<?php echo $this->get_field_name('banner_overlay_color'); ?>" value="<?php echo esc_attr( $instance['banner_overlay_color'] ); ?>" data-default-color="#961717" class="color-picker"></li>
  </ul>
</div>
<?php

  } // end Widget Control Panel
} // end class


function register_tcd_banner_widget() {
	register_widget( 'tcd_banner_widget' );
}
add_action( 'widgets_init', 'register_tcd_banner_widget' );