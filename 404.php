<?php

	get_header();
	$options = get_design_plus_option();

	$catch = ($options['page_404_catch']) ? $options['page_404_catch'] : '404 NOT FOUND';
	$desc = $options['page_404_desc'];
	$font_color = ($options['page_404_font_color']) ? esc_attr($options['page_404_font_color']) : '#000000';
	$overlay_color = ($options['page_404_bg_color']) ? esc_attr($options['page_404_bg_color']) : '#ffffff';
	$overlay_color = implode(",",hex2rgb($overlay_color));
  $overlay_opacity = $options['page_404_bg_opacity'];
	$bg_image = wp_get_attachment_image_src($options['page_404_bg_image'], 'full');

?>
<div id="page_404_header" class="animate" style="color:<?php echo $font_color; ?>;">
  <div class="content">
    <h1 class="catch common_headline rich_font"><?php echo nl2br(esc_html($catch)); ?></h1>
    <?php if ($desc) { ?><p class="desc"><?php echo nl2br(remove_non_inline_elements($desc)); ?></p><?php } ?>
  </div>
	<div class="overlay" style="background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
	<?php if($bg_image){ ?>
	<div class="bg_image" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center top; background-size:cover;"></div>
	<?php } ?>
</div>
<?php get_footer(); ?>