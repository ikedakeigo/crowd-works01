<?php

  $options = get_design_plus_option();
  get_header();

  // ヘッダースライダー
  if($options['show_index_slider']) get_template_part( 'template-parts/header-slider' );

  // ニュースティッカー
  if($options['show_news_ticker']) get_template_part( 'template-parts/news-ticker' );

  // メインコンテンツ
  if($options['main_content_type'] == 'type1'){

    echo '<div class="front_page_main_contents">';

    // フリースペース 1
    if($options['show_free_space1']){

?>
<section class="index_free_space <?php esc_attr_e($options['free_space1_width']); ?> padding_<?php esc_attr_e($options['free_space1_padding']) ?>" style="background-color:<?php esc_attr_e($options['free_space1_bg_color']); ?>;">
  <div class="inner">
    <div class="post_content clearfix">
    <?php echo apply_filters('the_content', $options['free_space1_editor'] ); ?>
    </div>
  </div>
</section>
<?php

    }

    // 商品一覧
    if($options['show_product_list'] && is_woocommerce_active() ) get_template_part( 'template-parts/product-list' );

    // フリースペース 2
    if($options['show_free_space2']){

?>
<section class="index_free_space <?php esc_attr_e($options['free_space2_width']); ?> padding_<?php esc_attr_e($options['free_space2_padding']) ?>" style="background-color:<?php esc_attr_e($options['free_space2_bg_color']); ?>;">
  <div class="inner">
    <div class="post_content clearfix">
    <?php echo apply_filters('the_content', $options['free_space2_editor'] ); ?>
    </div>
  </div>
</section>
<?php

    }

    // ブログカルーセル
    if($options['show_blog_carousel']) get_template_part( 'template-parts/blog-carousel' );


    // フリースペース 3
    if($options['show_free_space3']){

?>
<section class="index_free_space <?php esc_attr_e($options['free_space3_width']); ?> padding_<?php esc_attr_e($options['free_space3_padding']) ?>" style="background-color:<?php esc_attr_e($options['free_space3_bg_color']); ?>;">
  <div class="inner">
    <div class="post_content clearfix">
    <?php echo apply_filters('the_content', $options['free_space3_editor'] ); ?>
    </div>
  </div>
</section>
<?php

    }

  echo '</div>';


  // トップページ用の固定ページ
  }else{

    if ( have_posts() ) : while ( have_posts() ) : the_post();

?>
<article class="index_page_content <?php esc_attr_e($options['main_content_width']); ?>">
  <div class="inner">
    <div class="post_content clearfix">
    <?php
        the_content();
        if ( ! post_password_required() ) custom_wp_link_pages();
    ?>
    </div>
  </div>
</article>
<?php

    endwhile; endif;

  }

  get_footer();

?>
