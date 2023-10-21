<?php $options = get_design_plus_option(); global $post; ?>
<!DOCTYPE html>
<html class="pc" <?php language_attributes(); ?>>
<?php if($options['use_ogp']) { ?>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
<?php } else { ?>
<head>
<?php }; ?>
<meta charset="<?php bloginfo('charset'); ?>">
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
<meta name="viewport" content="width=device-width">
<title><?php wp_title('|', true, 'right'); ?></title>
<meta name="description" content="<?php seo_description(); ?>">
<?php if(is_attachment() && (get_option( 'blog_public' ) != 0)) { ?>
<meta name='robots' content='noindex, nofollow' />
<?php }; ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php wp_enqueue_style('style', get_stylesheet_uri(), false, version_num(), 'all'); wp_enqueue_script( 'jquery' ); if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body id="body" <?php body_class(); ?>>
<?php

  // ロード画面の出力
  do_action( 'tcd_output_loading_screen' );

  // ヘッダーメッセージ
  if( (!is_page_template('page-lp.php') || get_post_meta($post->ID, 'hide_header_message', true) != 'hide') && $options['show_header_message'] ) {
    get_template_part( 'template-parts/header-message' );
  }


  if(!is_page_template('page-lp.php') || get_post_meta($post->ID, 'page_header_type', true) != 'type3'){


    if( !is_page_template('page-lp.php') || get_post_meta($post->ID, 'hide_header_bar', true) != 'hide'){

      $site_title = esc_html( get_bloginfo('name') );
      $site_desc = (get_bloginfo('description')) ? ' ｜ '.esc_html( get_bloginfo('description') ) : '';

?>
<header id="header_top">
  <div class="inner l-inner">
    <div class="description">
      <a class="pc" href="<?php echo esc_url( home_url('/') ); ?>"><?php echo $site_title.$site_desc; ?></a>
    </div>
    <?php header_logo(true); ?>
    <div class="menu_list">
      <?php // ヘッダー検索フォーム ?>
      <div class="header_search">
        <div class="header_search_inner">
          <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
          <?php if ( is_woocommerce_active() ) { ?>
            <div class="input_area"><input type="search" value="<?php echo get_search_query(); ?>" name="s" /></div>
            <div class="search_area"><button class="search_button" type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'woocommerce' ); ?>"></button></div>
            <input type="hidden" name="post_type" value="product" />
          <?php } else { // woocommerceが有効でない場合は、デフォルトの検索フォームを表示 ?>
            <div class="input_area"><input type="text" value="" id="input_area" name="s" autocomplete="off"></div>
            <div class="search_area"><label class="search_button" for="header_search_button"></label><input class="visually-hidden" type="submit" id="header_search_button" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>"></div>
          <?php } ?>
          </form>
        </div>
      </div>

      <div id="js-header-search" class="header_search_toggle_button">
        <div class="header_search_toggle_button_open"></div>
        <div class="header_search_toggle_button_close"><span class="left"></span><span class="right"></span></div>
      </div>
      <?php

        $totalquantity = null;
        if ( is_woocommerce_active() ) {

          $totalquantity = WC()->cart->get_cart_contents_count();
          if ( ! $totalquantity ) $totalquantity = null;

          $wishlist_color = ($options['header_wishlist_badge_color']) ? esc_attr($options['header_wishlist_badge_color']) : '#d787bc';
          $cart_color = ($options['header_cart_badge_color']) ? esc_attr($options['header_cart_badge_color']) : '#bf9d87';

      ?>
      <ul class="header_member_navigation">
        <li class="header_member_wishlist">
          <a href="<?php echo esc_attr( wc_get_account_endpoint_url( 'wishlist' ) ); ?>">
            <span id="js-header-wishlist-count" class="header_member_badge" style="background-color:<?php echo $wishlist_color; ?>;"><?php if ( $like_cout = get_like_count() ) echo absint( $like_cout ); ?></span>
          </a>
        </li>
        <li class="header_member_mypage"><a id="js-header-mypage" href="<?php echo esc_attr( wc_get_account_endpoint_url( 'dashboard' ) ); ?>"></a></li>
        <li class="header_member_cart">
          <a id="js-header-cart" href="<?php echo esc_attr( wc_get_cart_url() ); ?>">
            <span id="js-header-cart-item-count" class="header_member_badge" style="background-color:<?php echo $cart_color; ?>;"><?php echo $totalquantity; ?></span>
          </a>
        </li>
      </ul>
      <?php } ?>
      <button id="js-menu-button" class="p-menu-button c-icon-button"><span></span><span></span><span></span></button>
    </div>
    <?php

    if ( is_woocommerce_active() ) {

      get_template_part( 'wc/header-login' );
      get_template_part( 'wc/header-view-cart' );

    }

    ?>
  </div>
</header>

<?php

  }

  if( (!is_page_template('page-lp.php') || get_post_meta($post->ID, 'hide_global_menu', true) != 'hide') && !is_404() ){

    $show_slider = $options['show_index_slider'];

?>
<div id="header_bottom" class="header_bottom" <?php if($show_slider && is_front_page()) echo 'style="border-bottom:none;"'; ?>>
	<div class="inner">
		<?php

      header_logo();
      
      if ( has_nav_menu( 'global-menu' ) ){

        wp_nav_menu( array(
          'container' => 'nav',
          'container_class' => 'global_nav_container',
          'depth' => 3,
          'menu_class' => 'global_nav_menu',
          'menu_id' => '',
          'theme_location' => 'global-menu',
          'link_after' => ''
        ) );

      }
      
    ?>
	</div>
</div>
<?php

  }


}

?>
<div id="container">




