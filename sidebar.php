<?php

  global $post;
  $options = get_design_plus_option();

    // 「WooCommerce Pages」カスタム投稿タイプの固定ページに対してサイドバーを表示しない
    if(is_singular('woocommerce_page')) {
      return;
    }

  $sidebar = '';

  if ( is_mobile() ) {

    if(is_singular('news')) {
      $sidebar = 'news_single_widget_mobile';
    } elseif ( is_single() || is_home() || is_archive() || is_search()) {
      $sidebar = 'single_widget_mobile';
    } elseif(is_page()) {
      $sidebar = 'page_widget_mobile';
    }

    if ( is_active_sidebar( $sidebar ) || is_active_sidebar( 'common_widget_mobile' )) {
?>
<aside id="side_col" class="secondary">
  <?php if ( is_active_sidebar( $sidebar ) ) { dynamic_sidebar( $sidebar ); } elseif(is_active_sidebar( 'common_widget_mobile' )) { dynamic_sidebar( 'common_widget_mobile' ); }; ?>
</aside>
<?php
    };

  } else {

    if(is_singular('news')) {
      $sidebar = 'news_single_widget';
    } elseif ( is_single() || is_home() || is_archive() || is_search()) {
      $sidebar = 'single_widget';
    } elseif(is_page()) {
      $sidebar = 'page_widget';
    }

    if ( is_active_sidebar( $sidebar ) || is_active_sidebar( 'common_widget' )) {
?>
<aside id="side_col">
  <?php if ( is_active_sidebar( $sidebar ) ) { dynamic_sidebar( $sidebar ); } elseif(is_active_sidebar( 'common_widget' )) { dynamic_sidebar( 'common_widget' ); }; ?>
</aside>
<?php
    };

  };
?>
