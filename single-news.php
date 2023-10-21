<?php

  get_header();
  $options = get_design_plus_option();
  get_template_part('template-parts/breadcrumb');
  
?>
<main id="main_contents" class="two_columns">
  <div id="main_col">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article id="article">
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
          ?>
        </ul>
        <h1 class="title news"><?php the_title(); ?></h1>

      </div>

      <?php

        // sns button top ------------------------------------------------------------------------------------------------------------------------
        if($options['news_single_show_sns_top'] == 'display') get_template_part('template-parts/single-sns-button');

        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['news_single_show_copy_top'] == 'display') echo copy_title_url_button();

      }; // ***** END only show on first page *****

      // post content ------------------------------------------------------------------------------------------------------------------------

      echo '<div class="post_content clearfix">';

      the_content();
      if ( ! post_password_required() ) custom_wp_link_pages();

      echo '</div>';

      // sns button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
      if($options['news_single_show_sns_btm'] == 'display') get_template_part('template-parts/single-sns-button');

      // page nav ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
      echo next_prev_post_link();
      
      ?>
    </article><!-- END #article -->
    <?php
    
    endwhile; endif;
      
      // recent news ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
      if ($options['show_recent_news']){

        $post_num = $options['recent_news_num'];
        if(is_mobile()) $post_num = $options['recent_news_num_sp'];

        $args = array( 'post_type' => 'news', 'post__not_in' => array($post->ID), 'showposts'=> $post_num);
        $the_query = new WP_Query($args);
        if($the_query->have_posts()):

    ?>
    <section id="recent_news">
      <h2 class="headline rich_font_<?php // echo esc_attr($headline_font_type); ?>"><span><?php echo wp_kses_post(nl2br($options['recent_news_headline'])); ?></span></h3>
      <div class="news_list">
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <article class="item">
          <a class="link" href="<?php the_permalink(); ?>">
            <div class="inner">
              <p class="date">
                <time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
              </p>
              <h3 class="title line1"><span><?php echo mb_strimwidth( strip_tags( get_the_title() ), 0, 200, '...' ); ?></span></h3>
            </div>
          </a>
        </article>
        <?php endwhile; wp_reset_postdata(); ?>
      </div><!-- END .news_list -->
    </section>
  <?php
        endif;
      };
  ?>
  </div><!-- END #main_col -->
<?php
    // widget ------------------------
    get_sidebar();
?>
</main><!-- END #main_contents -->
<?php get_footer(); ?>