<?php

  global $post;
  $options = get_design_plus_option();

  // ニュースティッカー
  $post_num = '5';
  $post_type = $options['news_ticker_post_type'];
  $post_order = $options['news_ticker_post_order'];

  if($post_order == 'rand'){
    $args = array( 'post_type' => $post_type, 'posts_per_page' => $post_num, 'orderby' => 'rand' );
  } else {
    $args = array( 'post_type' => $post_type, 'posts_per_page' => $post_num );
  }

  $post_list_query = new WP_Query($args);
  if($post_list_query->have_posts()) {

?>
<div id="news_ticker">
  <div class="inner">
    <div class="list swiper" id="news_ticker_slider">
      <div class="swiper-wrapper">
        <?php while($post_list_query->have_posts()): $post_list_query->the_post(); ?>
        <article class="swiper-slide item">
          <p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p>
          <h3 class="title"><a class="link line" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        </article>
        <?php endwhile; ?>
      </div><!-- END .swiper-wrapper -->
    </div><!-- END .swiper-container -->
  </div><!-- END #news_ticker -->
</div><!-- END #news_ticker_wrap -->
<?php 

  } // post_list_query

