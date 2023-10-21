<?php

  $options = get_design_plus_option();

  // 固定ページのフッター非表示
  if( !is_page_template('page-lp.php') || get_post_meta($post->ID, 'hide_footer', true) != 'hide'){

?>

  <footer id="footer">

    <?php

    if(!is_404()){

      // フッターメッセージ
      if($options['show_footer_message']){

        $message = $options['footer_message'];
        $url = $options['footer_message_url'];
        $font_color = $options['footer_message_font_color'];
        $bg_color = $options['footer_message_bg_color'];

    ?>
    <div id="footer_message" style="color:<?php esc_attr_e($font_color);?>;background-color:<?php esc_attr_e($bg_color);?>;">
      <div class="inner">
        <?php if($url){ ?>
        <a href="<?php echo esc_url($url); ?>" class="label"><?php echo nl2br(esc_html($message)); ?></a>
        <?php }else{ ?>
        <p class="label"><?php echo nl2br(esc_html($message)); ?></p>
        <?php } ?>
      </div>
    </div>

    <?php } ?>

    <?php
        // footer menu ------------------------------------------------------
        if ( has_nav_menu('footer-menu1') || has_nav_menu('footer-menu2') || has_nav_menu('footer-menu3') ) {
    ?>
    <div id="footer_menu">
    <?php if (has_nav_menu('footer-menu1')) { ?>
      <div class="footer_menu">
      <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'footer-menu1' , 'container' => '' , 'depth' => '1') ); ?>
      </div>
    <?php }; if (has_nav_menu('footer-menu2')) { ?>
      <div class="footer_menu">
      <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'footer-menu2' , 'container' => '' , 'depth' => '1') ); ?>
      </div>
    <?php }; if (has_nav_menu('footer-menu3')) { ?>
      <div class="footer_menu">
      <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'footer-menu3' , 'container' => '' , 'depth' => '1') ); ?>
      </div>
    <?php }; ?>
    </div><!-- END #footer_menu -->
    <?php };

    } // is_404

    ?>
    <div class="footer_bottom">
      <div class="inner">
        <?php
          // footer sns ------------------------------------
          if($options['show_footer_sns']) {
            $facebook = $options['sns_button_facebook_url'];
            $twitter = $options['sns_button_twitter_url'];
            $insta = $options['sns_button_instagram_url'];
            $pinterest = $options['sns_button_pinterest_url'];
            $youtube = $options['sns_button_youtube_url'];
            $contact = $options['sns_button_contact_url'];
            $show_rss = $options['sns_button_show_rss'];
        ?>
        <ul id="footer_sns" class="sns_button_list clearfix color_<?php echo esc_attr($options['sns_button_color_type']); ?><?php if(is_ios()) echo ' device_ios' ?>">
          <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow noopener" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
          <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow noopener" target="_blank" title="Twitter"><span>Twitter</span></a></li><?php }; ?>
          <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow noopener" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
          <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow noopener" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
          <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow noopener" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
          <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow noopener" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
          <?php if($show_rss) { ?><li class="rss"><a href="<?php esc_url(bloginfo('rss2_url')); ?>" rel="nofollow noopener" target="_blank" title="RSS"><span>RSS</span></a></li><?php }; ?>
        </ul>
        <?php }; ?>
        <p class="copyright"><?php echo wp_kses_post($options['copyright']); ?></p>
      </div>
    </div>

  </footer>

<?php }; // hide footer ?>

</div><!-- #container -->
<?php

if( !is_404() && !is_singular('product') ){


  if( !is_page_template('page-lp.php') || !get_post_meta($post->ID, 'hide_footer', true) != 'hide' ){

    // footer bar for mobile device -------------------
    if( is_mobile() && ($options['footer_bar_display'] != 'type3') && ($options['footer_bar_type'] == 'type1')) {

      get_template_part('template-parts/footer-bar');

    } elseif( is_mobile() && ($options['footer_bar_display'] != 'type3') && ($options['footer_bar_type'] == 'type2')) {
?>
<div id="dp-footer-bar" class="type2">
<?php
      for($i = 1; $i <= 2; $i++) {
        if($options['show_footer_button'.$i]) {
?>
  <a class="footer_button num<?php echo $i; ?>" href="<?php echo esc_html($options['footer_button_url'.$i]); ?>" <?php if($options['footer_button_target'.$i]){ echo 'target="_blank"'; }; ?>>
    <span><?php echo esc_html($options['footer_button_label'.$i]); ?></span>
  </a>
<?php }; }; ?>
</div>
<?php

    }

?>
<div id="return_top">
  <a href="#body"><span>TOP</span></a>
</div>
<?php

  }; // hide footer

} // is_404


// ドロワーメニュー
$drawer_color_type = ($options['drawer_menu_color_type']) ? esc_attr($options['drawer_menu_color_type']) : 'light';

?>
<div id="js-drawer" class="drawer_wrap <?php echo esc_attr($drawer_color_type); ?>_color">
	<div class="drawer_contents">

    <div class="drawer_header">
      <p class="drawer_header_caption"><span><?php echo esc_html($options['drawer_menu_caption']); ?></span></p>
      <button id="js-drawer-close-button" class="drawer_close_button" type="button" ><span class="bar"></span><span class="bar"></span></button>
      <?php

        $image =  wp_get_attachment_image_src( $options['drawer_menu_image'], 'full' );
        if($image){

          $title = get_bloginfo('name');
          if($options['drawer_menu_image_retina'] == 'yes') {
            $image[1] = round($image[1] / 2);
            $image[2] = round($image[2] / 2);
          };

      ?>
      <div class="drawer_header_logo">
        <a href="<?php echo esc_url(home_url('/')); ?>">
          <img class="logo_image"
            src="<?php echo esc_attr($image[0]); ?>?<?php echo esc_attr(time()); ?>"
            alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>"
            width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
        </a>
      </div>
      <?php } ?>
    </div>
<?php

  // 会員メニュー
  if ( is_woocommerce_active() ) {

  $login_label = (is_user_logged_in()) ? esc_html( get_woocommerce_myaccount_page_title() ) : __( 'Login / Registration', 'tcd-ankle' );
  $wishlist_label = ($options['product_wishlist_label']) ? ($options['product_wishlist_label']) : __( 'Wishlist', 'tcd-ankle' );

?>
    <ul class="drawer_member_navigation">
      <li class="drawer_member_mypage"><a href="<?php echo esc_attr( wc_get_account_endpoint_url( 'dashboard' ) ); ?>"><?php echo $login_label; ?></a></li>
      <li class="drawer_member_wishlist"><a href="<?php echo esc_attr( wc_get_account_endpoint_url( 'wishlist' ) ); ?>"><?php echo esc_html( $wishlist_label ); ?></a></li>
    </ul>
<?php

  };

  if ( has_nav_menu( 'global-menu' ) ) :
    wp_nav_menu( array(
      'container' => 'nav',
      'container_class' => 'drawer_nav_container',
      'depth' => 3,
      'menu_class' => 'drawer_nav_menus',
      'menu_id' => 'drawer_nav_menus',
      'theme_location' => 'global-menu',
      'link_after' => '<span class="drawer_nav_toggle_button"></span>'
    ) );
  endif;

?>
	</div>
	<div id="js-drawer-overlay" class="drawer_overlay"></div>
</div>
<?php

// share button ----------------------------------------------------------------------
if ( is_single() && ( $options['blog_single_show_sns_top'] || $options['blog_single_show_sns_btm'] || $options['news_single_show_sns_top'] || $options['news_single_show_sns_btm']) ) :
  if ( $options['sns_share_design_type'] == 'type5') :
    if ( $options['show_sns_share_twitter'] ) :
?>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<?php
    endif;

    if ( $options['show_sns_share_fblike'] || $options['show_sns_share_fbshare'] ) :
?>
<!-- facebook share button code -->
<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<?php
    endif;
    if ( $options['show_sns_share_hatena'] ) :
?>
<script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
<?php
    endif;
    if ( $options['show_sns_share_pocket'] ) :
?>
<script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
<?php
    endif;
    if ( $options['show_sns_share_pinterest'] ) :
?>
<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
<?php
    endif;
  endif;
endif;
?>

<?php wp_footer(); ?>

</body>
</html>
