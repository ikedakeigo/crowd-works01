<?php

get_header();
$options = get_design_plus_option();
get_template_part('template-parts/breadcrumb');

?>
<main id="main_contents" class="two_columns">
  <article id="main_col" class="primary">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div id="article">
      
      <?php if($page == '1') { // ***** only show on first page ***** ?>

      <div class="article_header">
        <?php

          if ( has_post_thumbnail() ) :
            echo "\t\t\t\t";
            echo '<div class="featured_image">' . "\n";
            echo "\t\t\t\t\t";
            the_post_thumbnail( 'post-thumbnail' );
            echo "\n";
            echo "\t\t\t\t";
            echo "</div>\n";
          endif;

          $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
          if ( $category && ! is_wp_error($category) ) {
            foreach ( $category as $cat ) :
              $cat_name = $cat->name;
              $cat_id = $cat->term_id;
              $cat_url = get_term_link($cat_id,'category');
              break;
            endforeach;
          };

        ?>
        <ul class="meta_wrap">
          <li class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></li>
          <?php
              $post_date = get_the_time('Ymd');
              $modified_date = get_the_modified_date('Ymd');
              if($post_date < $modified_date){
          ?>
          <li class="update"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date('Y.m.d'); ?></time></li>
          <?php
              };
              if ( $category && ! is_wp_error($category) ) {
          ?>
          <li class="category">
            <a class="category_link cat_id<?php echo esc_attr($cat_id); ?>" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
          </li>
          <?php } ?>
        </ul>
        <h1 class="title rich_font_ post"><?php the_title(); ?></h1>

      </div>
      <?php

        // sns button top ------------------------------------------------------------------------------------------------------------------------
        if($options['blog_single_show_sns_top'] == 'display') get_template_part('template-parts/single-sns-button');

        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['blog_single_show_copy_top'] == 'display') echo copy_title_url_button();
        
      }; // ***** END only show on first page *****
      
      // post content ------------------------------------------------------------------------------------------------------------------------
      echo '<div class="post_content clearfix">';
      the_content();
      if ( ! post_password_required() ) custom_wp_link_pages();
      echo '</div>';

      // CTA -----------------------------
      if ( $options['single_cta_display'] != '5') get_template_part( 'template-parts/single-cta' );
      
      // sns button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
      if($options['blog_single_show_sns_btm'] == 'display') get_template_part('template-parts/single-sns-button');
      
      // meta ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
      if ($options['blog_single_show_meta_category'] == 'display' || ( $options['blog_single_show_meta_tag'] == 'display' && get_the_tags() ) || $options['blog_single_show_meta_author'] == 'display' )
        echo tcd_metabox($options);
      
      // page nav ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
      echo next_prev_post_link();

    ?>
    </div><!-- END #article -->
<?php
    
    echo tcd_author_profile($options);
    
  endwhile; endif;

  // related post ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  if ($options['show_related_post']){
    $categories = get_the_category($post->ID);
    if ($categories) {

      $post_num = $options['related_post_num'];
      if(is_mobile()) $post_num = $options['related_post_num_sp'];
      
      $category_ids = array();
      foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
      $args = array( 'category__in' => $category_ids, 'post__not_in' => array($post->ID), 'showposts'=> $post_num, 'orderby' => 'rand');
      $the_query = new WP_Query($args);
      if($the_query->have_posts()):

?>
  <section id="related_post">
    <h3 class="headline rich_font"><span><?php echo wp_kses_post(nl2br($options['related_post_headline'])); ?></span></h3>

    <div class="post_list">
    <?php

      while( $the_query->have_posts() ) : $the_query->the_post();

        $image_size = 'landscape1';
        if(has_post_thumbnail()) {
          $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $image_size );
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
        <a class="link" href="<?php the_permalink(); ?>">
          <div class="image_wrap animate_background">
            <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center; background-size:cover;"></div>
          </div>
          <h3 class="title line2"><span><?php the_title(); ?></span></h3>
        </a>
      </article>
    <?php endwhile; wp_reset_postdata(); ?>
    </div><!-- END .post_list -->
  </section><!-- END #related_post -->
<?php
      endif;
    };
  };

  // comment ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  if (comments_open() || pings_open()) { comments_template('', true); };

?>
  </article><!-- END #main_col -->
<?php
      // widget ------------------------
      get_sidebar();
?>
</main><!-- END #main_contents -->
<?php get_footer(); ?>