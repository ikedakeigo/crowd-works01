<?php

$options = get_design_plus_option();


 // ブログカルーセル

?>
<section id="index_blog_carousel" class="blog_carousel index_section" style="background-color:<?php esc_attr_e($options['blog_carousel_bg_color']); ?>;">
  <div class="inner">
  <?php

    $title = $options['blog_carousel_headline'];
    $sub_title = $options['blog_carousel_sub_headline'];
    $desc = $options['blog_carousel_desc'];
    if($title || $sub_title){

  ?>
  <div class="common_header">
    <h2 class="heading rich_font">
      <?php if($title){ ?><span class="heading_top common_headline"><?php echo esc_html($title); ?></span><?php } ?>
      <?php if($sub_title){ ?><span class="heading_bottom"><?php echo esc_html($sub_title); ?></span><?php } ?>
    </h2>
    <?php if($desc){ ?><p class="description"><?php echo wp_kses_post(nl2br($desc)); ?></p><?php } ?>
  </div>
  <?php

    }

    $post_num = $options['blog_carousel_num'];
    if(is_mobile()) $post_num = $options['blog_carousel_num_sp'];

    $post_type = $options['blog_carousel_post_type'];
    if($post_type == 'recent_post') {
      $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC') );
    } else {
      $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'), 'meta_key' => $post_type, 'meta_value' => 'on');
    };

    $blog = new WP_Query( $args );

    if($blog->have_posts()):

  ?>
  <div class="post_list">
		<div id="blog_carousel_slider" class="swiper">
			<div class="swiper-wrapper">
      <?php

        while($blog->have_posts()): $blog->the_post();

          $image_size = (is_mobile()) ? 'landscape1' : 'landscape2';
          if(has_post_thumbnail()) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id(), $image_size );
          } elseif($options['blog_no_image']) {
            $image = wp_get_attachment_image_src( $options['blog_no_image'], $image_size );
          } elseif($options['no_image1']) {
            $image = wp_get_attachment_image_src( $options['no_image1'], $image_size );
          } else {
            $image = array();
            $image[0] = get_template_directory_uri() . "/img/common/no_image1.gif";
          }

          $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
          if ( $category && ! is_wp_error($category) ) {
            foreach ( $category as $cat ) :
              $cat_name = $cat->name;
              $cat_id = $cat->term_id;
              $cat_url = get_category_link( $cat_id );
              break;
            endforeach;
          }
          
      ?>
      <article class="swiper-slide item">
        <a class="link animate_background" href="<?php the_permalink(); ?>">

          <div class="image_wrap">
            <div class="title_wrap">
              <h3 class="title line2"><span><?php echo mb_strimwidth( strip_tags( get_the_title() ), 0, 200, '...' ); ?></span></h3>
            </div>
            <div class="overlay"></div>
            <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center; background-size:cover;"></div>
          </div>

          <div class="content_wrap">
            <ul class="meta_wrap">
              <li class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></li>
              <?php if ( $category && ! is_wp_error($category) ) { ?>
              <li class="category"><span class="category_link cat_id<?php echo esc_attr($cat_id); ?> js-category-link" data-href="<?php echo esc_attr($cat_url); ?>"><?php echo esc_attr($cat_name); ?></span></li>
              <?php } ?>
            </ul>
            
            <p class="desc line2"><span><?php echo trim_excerpt(150); ?></span></p>

          </div>
        </a>
      </article>
      <?php

        endwhile; wp_reset_postdata();

      ?>
      </div><!-- END .swiper-wrapper -->
    </div><!-- END .swiper -->
    <div class="swiper-button-prev swiper_arrow"></div>
		<div class="swiper-button-next swiper_arrow"></div>
  </div><!-- END .post_list -->
  <?php

    endif;

    if($options['blog_carousel_button_display'] == 'display'){

  ?>
    <div class="button_wrap">
      <a class="q_custom_button q_custom_<?php echo $options['blog_carousel_button_type']; ?>" href="<?php echo esc_url(get_post_type_archive_link('post')); ?>"><?php echo esc_html($options['blog_carousel_button_label']); ?></a>
    </div>
  <?php } ?>
  </div>
</section>