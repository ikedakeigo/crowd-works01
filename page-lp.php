<?php
/*
Template Name:Landing Page
*/
__('Landing Page', 'tcd-ankle');
?>
<?php
    get_header();
    
    $options = get_design_plus_option();

    $page_header_type = get_post_meta($post->ID, 'page_header_type', true) ?  get_post_meta($post->ID, 'page_header_type', true) : 'type1';
    $catch = get_post_meta($post->ID, 'page_header_catch', true);
    $catch_sp = get_post_meta($post->ID, 'page_header_catch_sp', true);
    $catch_font_type = get_post_meta($post->ID, 'page_header_catch_font_type', true) ?  get_post_meta($post->ID, 'page_header_catch_font_type', true) : 'type3';
    $desc = get_post_meta($post->ID, 'page_header_desc', true);
    $desc_sp = get_post_meta($post->ID, 'page_header_desc_sp', true);

    $bg_image = wp_get_attachment_image_src(get_post_meta($post->ID, 'page_header_bg_image', true), 'full');
    $overlay_color = get_post_meta($post->ID, 'page_header_overlay_color', true) ?  get_post_meta($post->ID, 'page_header_overlay_color', true) : '#000000';
    $overlay_color = implode(",",hex2rgb($overlay_color));
    $overlay_opacity = get_post_meta($post->ID, 'page_header_overlay_opacity', true) ?  get_post_meta($post->ID, 'page_header_overlay_opacity', true) : '0.3';
    $page_content_width = get_post_meta($post->ID, 'page_content_width', true) ?  get_post_meta($post->ID, 'page_content_width', true) : 'normal';
    

    if($page_header_type != 'type1'){

?>
<div id="page_header" class="header_<?php echo $page_header_type; ?>">
  <div class="content">
    <?php if($catch){ ?>
    <h1 class="catch animate_item rich_font_<?php echo esc_attr($catch_font_type); ?>">
      <?php if($catch_sp) { ?><span class="mobile"><?php echo wp_kses_post(nl2br($catch_sp)); ?></span><?php } ?>
      <span class="pc"><?php echo wp_kses_post(nl2br($catch)); ?></span>
    </h1>
    <?php }; ?>
    <?php if($desc){ ?>
    <p class="desc">
      <?php if($desc_sp) { ?><span class="mobile"><?php echo wp_kses_post(nl2br($desc_sp)); ?></span><?php } ?>
      <span class="pc"><?php echo wp_kses_post(nl2br($desc)); ?></span>
    </p>
    <?php }; ?>
  </div>
  <?php if($page_header_type == 'type3') { ?>
  <a class="animate_item" id="page_contents_link" href="#main_contents"></a>
  <?php } ?>
  <div class="overlay" style="background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
  <?php if(!empty($bg_image)) { ?>
  <div class="bg_image" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center top; background-size:cover;"></div>
  <?php }; ?>
</div>
<?php }; ?>
<div id="main_contents" class="style_lp <?php echo $page_content_width; ?>">
  <article id="article">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="post_content clearfix">
    <?php
      the_content();
      if ( ! post_password_required() ) custom_wp_link_pages();
    ?>
    </div>
  <?php endwhile; endif; ?>
  </article>
</div><!-- END #main_contents -->
<?php get_footer(); ?>