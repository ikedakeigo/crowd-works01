<?php

  $options = get_design_plus_option();
  global $post;

  $image_size = (is_mobile()) ? 'landscape2' : 'landscape3';
  if(has_post_thumbnail()) {
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $image_size );
  } elseif($post->post_type == 'post' && $options['blog_no_image']) {
    $image = wp_get_attachment_image_src( $options['blog_no_image'], $image_size );
  } elseif($post->post_type == 'news' && $options['news_no_image']) {
    $image = wp_get_attachment_image_src( $options['news_no_image'], $image_size );
  } elseif($options['no_image1']) {
    $image = wp_get_attachment_image_src( $options['no_image1'], $image_size );
  } else {
    $image = array();
    $image[0] = get_template_directory_uri() . "/img/common/no_image1.gif";
  }

  $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
  if ( !is_search() && !is_category() && $category && ! is_wp_error($category) ) {
    foreach ( $category as $cat ) :
      $cat_name = $cat->name;
      $cat_id = $cat->term_id;
      $cat_url = get_category_link( $cat_id );
      break;
    endforeach;
  }

  $desc = trim_excerpt(150);

?>
      <article class="item">
        <a class="link animate_background" href="<?php the_permalink(); ?>">

          <div class="image_wrap">
            <div class="title_wrap">
              <h3 class="title line2 rich_font"><span><?php the_title(); ?></span></h3>
            </div>
            <div class="overlay"></div>
            <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center; background-size:cover;"></div>
          </div>

          <div class="content_wrap">
            <ul class="meta_wrap">
              <li class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></li>
              <?php if ( !is_search() && !is_category() && $category && ! is_wp_error($category) ) { ?>
              <li class="category"><span class="category_link cat_id<?php echo esc_attr($cat_id); ?> js-category-link" data-href="<?php echo esc_attr($cat_url); ?>"><?php echo esc_attr($cat_name); ?></span></li>
              <?php } ?>
            </ul>
            <?php if($desc){ ?><p class="desc line2"><span><?php echo trim_excerpt(150); ?></span></p><?php } ?>

          </div>
        </a>
      </article>
<?php
