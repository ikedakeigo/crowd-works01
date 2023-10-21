<?php


function header_logo( $sp = false ){

  $tag = is_front_page() ? 'h1' : 'div';
  $title = get_bloginfo('name');
  $options = get_design_plus_option();

  $device = '';
  if($sp == true) $device = '_sp';

  $image = wp_get_attachment_image_src( $options['header_logo_image'.$device], 'full' );

  if($image && $options['header_logo_retina'.$device] == 'yes') {
    $image[1] = round($image[1] / 2);
    $image[2] = round($image[2] / 2);
  };

?>
<<?php echo $tag; ?> class="header_logo">
  <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr($title); ?>">

    <?php if( ($options['header_logo_type'] == 'type2') && $image ){ ?>

    <img class="logo_image logo<?php echo $device; ?>"
       src="<?php echo esc_attr($image[0]); ?>?<?php echo esc_attr(time()); ?>"
       alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>"
       width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>"
       style="width:<?php echo esc_attr($image[1]); ?>px;"
    />

    <?php } else { ?>
    <span class="logo_text rich_font_<?php esc_attr_e($options['header_logo_font_type']) ?>" style="font-size:<?php esc_attr_e($options['header_logo_font_size'.$device]) ?>px;"><?php echo esc_html($title); ?></span>
    <?php }; ?>

  </a>
</<?php echo $tag; ?>>
<?php


}