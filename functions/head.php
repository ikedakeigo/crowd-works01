<?php

function tcd_head() {
    
  $options = get_design_plus_option();

?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/design-plus.css?ver=<?php echo version_num(); ?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/sns-botton.css?ver=<?php echo version_num(); ?>">
<link rel="stylesheet" media="screen and (max-width:1024px)" href="<?php echo get_template_directory_uri(); ?>/css/footer-bar.css?ver=<?php echo version_num(); ?>">
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.4.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jscript.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.cookie.min.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/comment.js?ver=<?php echo version_num(); ?>"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/simplebar.css?ver=<?php echo version_num(); ?>">
<script src="<?php echo get_template_directory_uri(); ?>/js/simplebar.min.js?ver=<?php echo version_num(); ?>"></script>
<?php if(is_mobile()) { ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/footer-bar.js?ver=<?php echo version_num(); ?>"></script>
<?php };

  do_action('tcd_woocommerc_output_style');

/* URLやモバイル等でcssが変わらないものをここで出力 */

?>
<style type="text/css">
<?php
  
  // フォントの設定　------------------------------------------------------------------
  $headline_font_size = $options['headline_font_size'] ? $options['headline_font_size'] : '32';
  $headline_font_size_sp = $options['headline_font_size_sp'] ? $options['headline_font_size_sp'] : '22';

?>
body { font-size:<?php echo esc_html($options['content_font_size']); ?>px; }
.common_headline { font-size:<?php echo esc_html($headline_font_size); ?>px !important; }
@media screen and (max-width:767px) {
  body { font-size:<?php echo esc_html($options['content_font_size_sp']); ?>px; }
  .common_headline { font-size:<?php echo esc_html($headline_font_size_sp); ?>px !important; }
}
<?php
  // フォントタイプ
?>
body, input, textarea { font-family: var(--tcd-font-<?php echo esc_html($options['content_font_type']); ?>); }
.rich_font, .p-vertical { font-family: var(--tcd-font-<?php echo esc_html($options['headline_font_type']); ?>); }
<?php
  // ヘッダー -------------------------------------------------------------------------------
  if($options['header_logo_type'] == 'type1'){
  // ロゴ
?>
.header_logo .logo_text { font-size:<?php echo esc_html($options['header_logo_font_size']); ?>px; }
@media screen and (max-width:1024px) {
  .header_logo .logo_text { font-size:<?php echo esc_html($options['header_logo_font_size_sp']); ?>px; }
}
<?php
  }

  // サムネイルのホバーアニメーション設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
  if($options['hover_type']!="type5"){

    // ズームイン ------------------------------------------------------------------------------
    if($options['hover_type']=="type1"){
?>
.author_profile .avatar_area img, .animate_image img, .animate_background .image {
  width:100%; height:auto; will-change:transform;
  -webkit-transition: transform  0.5s ease;
  transition: transform  0.5s ease;
}
.author_profile a.avatar:hover img, .animate_image:hover img, .animate_background:hover .image {
  -webkit-transform: scale(<?php echo $options['hover1_zoom']; ?>);
  transform: scale(<?php echo $options['hover1_zoom']; ?>);
}
<?php
    // ズームアウト ------------------------------------------------------------------------------
    } if($options['hover_type']=="type2"){
?>
.author_profile .avatar_area img, .animate_image img, .animate_background .image {
  width:100%; height:auto; will-change:transform;
  -webkit-transition: transform  0.5s ease;
  transition: transform  0.5s ease;
  -webkit-transform: scale(<?php echo $options['hover2_zoom']; ?>);
  transform: scale(<?php echo $options['hover2_zoom']; ?>);
}
.author_profile a.avatar:hover img, .animate_image:hover img, .animate_background:hover .image {
  -webkit-transform: scale(1);
  transform: scale(1);
}
<?php
    // スライド ------------------------------------------------------------------------------
    } elseif($options['hover_type']=="type3"){
?>
.author_profile .avatar_area, .animate_image, .animate_background, .animate_background .image_wrap {
  background: <?php echo $options['hover3_bgcolor']; ?>;
}
.animate_image img, .animate_background .image {
  -webkit-width:calc(100% + 30px) !important; width:calc(100% + 30px) !important; height:auto; max-width:inherit !important;
  <?php if($options['hover3_direct']=='type1'): ?>
  -webkit-transform: translate(-15px, 0px); -webkit-transition-property: opacity, translateX; -webkit-transition: 0.5s;
  transform: translate(-15px, 0px); transition-property: opacity, translateX; transition: 0.5s;
  <?php else: ?>
  -webkit-transform: translate(-15px, 0px); -webkit-transition-property: opacity, translateX; -webkit-transition: 0.5s;
  transform: translate(-15px, 0px); transition-property: opacity, translateX; transition: 0.5s;
  <?php endif; ?>
}
.animate_image.avatar_area img {
  width:calc(100% + 10px) !important;
  <?php if($options['hover3_direct']=='type1'): ?>
  -webkit-transform: translate(-5px, 0px); transform: translate(-5px, 0px);
  <?php else: ?>
  -webkit-transform: translate(-5px, 0px); transform: translate(-5px, 0px);
  <?php endif; ?>
}
.animate_image:hover img, .animate_background:hover .image {
  opacity:<?php echo $options['hover3_opacity']; ?> !important;
  <?php if($options['hover3_direct']=='type1'): ?>
  -webkit-transform: translate(0px, 0px);
  transform: translate(0px, 0px);
  <?php else: ?>
  -webkit-transform: translate(-30px, 0px);
  transform: translate(-30px, 0px);
  <?php endif; ?>
}
<?php
    // フェードアウト ------------------------------------------------------------------------------
    } elseif($options['hover_type']=="type4"){
?>
.author_profile .avatar_area, .animate_image, .animate_background, .animate_background .image_wrap {
  background: <?php echo $options['hover4_bgcolor']; ?>;
}
.author_profile a.avatar img, .animate_image img, .animate_background .image {
  -webkit-transition-property: opacity; -webkit-transition: 0.5s;
  transition-property: opacity; transition: 0.5s;
}
.author_profile a.avatar:hover img, .animate_image:hover img, .animate_background:hover .image {
  opacity: <?php echo $options['hover4_opacity']; ?> !important;
}
<?php };

  }; // アニメーションここまで

  // 色関連のスタイル　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

?>
a { color:#000; }
a:hover { color:rgba(var(--tcd-accent-color, 191,157,135),1); }
<?php

  // 色の設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

  $main_color  = implode(",",hex2rgb($options['main_color']));
  $link_color  = implode(",",hex2rgb($options['content_link_color']));
  $link_hover_color = implode(",",hex2rgb($options['content_link_hover_color']));

?>
:root {
  --tcd-accent-color:<?php echo esc_html($main_color); ?>;
  --tcd-link-color:<?php echo esc_html($link_color); ?>;
  --tcd-link-hover-color:<?php echo esc_html($link_hover_color); ?>;
}
<?php

  // カスタムCSS --------------------------------------------
  if($options['css_code']) echo wp_kses_post($options['css_code']);

  // クイックタグ --------------------------------------------
  if ( $options['use_quicktags'] ) :

    for ( $i = 2; $i <= 5; $i++ ){

    // 見出し
    $heading_font_size = $options['qt_h'.$i.'_font_size'];
    $heading_font_size_sp = $options['qt_h'.$i.'_font_size_sp'];
    $heading_text_align = $options['qt_h'.$i.'_text_align'];
    $heading_font_weight = $options['qt_h'.$i.'_font_weight'];
    $heading_font_color = $options['qt_h'.$i.'_font_color'];
    $heading_bg_color = $options['qt_h'.$i.'_bg_color'];
    $heading_ignore_bg = $options['qt_h'.$i.'_ignore_bg'];
    $heading_border = 'qt_h'.$i.'_border_';
    $heading_border_color = $options['qt_h'.$i.'_border_color'];
    $heading_border_width = $options['qt_h'.$i.'_border_width'];
    $heading_border_style = $options['qt_h'.$i.'_border_style'];

?>
.styled_h<?php echo $i ?> {
  font-size:<?php echo esc_attr($heading_font_size); ?>px!important;
  text-align:<?php echo esc_attr($heading_text_align); ?>!important;
  font-weight:<?php echo esc_attr($heading_font_weight); ?>!important;
  color:<?php echo esc_attr($heading_font_color); ?>;
  border-color:<?php echo esc_attr($heading_border_color); ?>;
  border-width:<?php echo esc_attr($heading_border_width); ?>px;
  border-style:<?php echo esc_attr($heading_border_style); ?>;
<?php

  $border_potition = array('left', 'right', 'top', 'bottom');
  foreach( $border_potition as $position ):

    if($options[$heading_border.$position]){
      if($position == 'left' || $position == 'right'){
        echo 'padding-'.$position.':1em!important;'."\n".'padding-top:0.5em!important;'."\n".'padding-bottom:0.5em!important;'."\n";
      }else{
        echo 'padding-'.$position.':0.8em!important;'."\n";
      }
    }else{
      echo 'border-'.$position.':none;'."\n";
    }

  endforeach;

  if($heading_ignore_bg){
    echo 'background-color:transparent;'."\n";
  }else{
    echo 'background-color:'.esc_attr($heading_bg_color).';'."\n".'padding:0.8em 1em!important;'."\n";
  }

?>
}
@media screen and (max-width:767px) {
  .styled_h<?php echo $i ?> { font-size:<?php echo esc_attr($heading_font_size_sp); ?>px!important; }
}
<?php

    }


    // アンダーライン
    for ( $i = 1; $i <= 3; $i++ ) {

      $underline_color = $options['qt_underline'.$i.'_border_color'];
      $underline_font_weight = $options['qt_underline'.$i.'_font_weight'];
      $underline_use_animation = $options['qt_underline'.$i.'_use_animation'];

?>
.q_underline<?php echo $i; ?> {
	font-weight:<?php echo esc_attr($underline_font_weight); ?>;
  background-image: -webkit-linear-gradient(left, transparent 50%, <?php echo esc_attr($underline_color); ?> 50%);
  background-image: -moz-linear-gradient(left, transparent 50%, <?php echo esc_attr($underline_color); ?> 50%);
  background-image: linear-gradient(to right, transparent 50%, <?php echo esc_attr($underline_color); ?> 50%);
  <?php if($underline_use_animation == 'no') echo 'background-position:-100% 0.8em;'; ?>
}
<?php

    }

    // 吹き出し
    for ( $i = 1; $i <= 4; $i++ ) {

      $sb_font_color = $options['qt_speech_balloon'.$i.'_font_color'];
      $sb_bg_color = $options['qt_speech_balloon'.$i.'_bg_color'];
      $sb_border_color = $options['qt_speech_balloon'.$i.'_border_color'];
      $sb_direction = ($i >= 3) ? 'left' : 'right';

?>
.speech_balloon<?php echo $i; ?> .speech_balloon_text_inner {
  color:<?php echo esc_attr($sb_font_color); ?>;
  background-color:<?php echo esc_attr($sb_bg_color); ?>;
  border-color:<?php echo esc_attr($sb_border_color); ?>;
}
.speech_balloon<?php echo $i; ?> .before { border-left-color:<?php echo esc_attr($sb_border_color); ?>; }
.speech_balloon<?php echo $i; ?> .after { border-right-color:<?php echo esc_attr($sb_bg_color); ?>; }
<?php

    }

  endif; // use_quicktags

  // ボタン
  for ( $i = 1; $i <= 3; $i++ ) {
    echo tcd_output_button_style($options, 'qt_button'.$i, '.q_custom_button.q_custom_button'.$i);
  }

  // Google map
    $qt_gmap_marker_bg = $options['qt_gmap_marker_bg'];
?>
.qt_google_map .pb_googlemap_custom-overlay-inner { background:<?php echo esc_attr($qt_gmap_marker_bg); ?>; color:<?php echo esc_attr($options['qt_gmap_marker_color']); ?>; }
.qt_google_map .pb_googlemap_custom-overlay-inner::after { border-color:<?php echo esc_attr($qt_gmap_marker_bg); ?> transparent transparent transparent; }
<?php
	// tcd_head_css action
	do_action( 'tcd_head_css' );
?>
</style>
<?php /* URLやモバイル等でcssが変わるものはここで出力 ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ */ ?>
<style id="current-page-style" type="text/css">
<?php
    
    // トップページ -----------------------------------------------------------------------------
    if(is_front_page()) {

      //  ヘッダースライダー
      if($options['show_index_slider']){

        // ヘッダースライダーの高さ
        $height = 60;
        if($options['show_header_message']) $height += 40;
        if($options['show_news_ticker']) $height += 78;

?>
@media (max-width: 700px) {
  #header_slider_wrap { height:calc(100vh - <?php echo esc_attr($height); ?>px); }
}
<?php

        $index_slider = $options['index_slider'];
        $i = 1;
        foreach($index_slider as $slider) :

          if($slider['link_type'] == 'type2'){
            echo tcd_output_button_style($slider, 'button', '#header_slider .item'.$i.' .button');
          }

?>
#header_slider .item<?php echo $i; ?> .catch { font-size:<?php esc_attr_e($slider['catch_font_size']); ?>px; }
#header_slider .item<?php echo $i; ?> .desc { font-size:<?php esc_attr_e($slider['desc_font_size']); ?>px; }
@media (max-width: 767px) {
  #header_slider .item<?php echo $i; ?> .catch { font-size:<?php esc_attr_e($slider['catch_font_size_sp']); ?>px; }
  #header_slider .item<?php echo $i; ?> .desc { font-size:<?php esc_attr_e($slider['desc_font_size_sp']); ?>px; }
}
<?php 
        
        $i++; endforeach;

      }

      // ブログカルーセル
      if($options['show_blog_carousel']){

?>
.blog_carousel .title { font-size:<?php echo esc_attr($options['blog_carousel_title_font_size']); ?>px; }
@media screen and (max-width:767px) {
  .blog_carousel .title { font-size:<?php echo esc_attr($options['blog_carousel_title_font_size_sp']); ?>px; }
}
<?php

      }

    // お知らせアーカイブ -----------------------------------------------------------------------------
    } elseif(is_post_type_archive('news')) {

?>
#news_archive .title { font-size:<?php echo esc_attr($options['news_archive_title_font_size']); ?>px; }
@media screen and (max-width:767px) {
  #news_archive .title { font-size:<?php echo esc_attr($options['news_archive_title_font_size_sp']); ?>px; }
}
<?php

    // お知らせ詳細ページ -----------------------------------------------------------------------------
    } elseif(is_singular('news')) {

?>
.article_header .title.news { font-size:<?php esc_attr_e($options['news_single_title_font_size']); ?>px; }
@media screen and (max-width:767px) {
  .article_header .title.news { font-size:<?php esc_attr_e($options['news_single_title_font_size_sp']); ?>px; }
}
<?php

    // ブログアーカイブ -----------------------------------------------------------------------------
    } elseif(is_archive() || is_home() || is_search()) {

?>
#post_archive .title { font-size:<?php echo esc_attr($options['blog_archive_title_font_size']); ?>px; }
@media screen and (max-width:767px) {
  #post_archive .title { font-size:<?php echo esc_attr($options['blog_archive_title_font_size_sp']); ?>px; }
}
<?php

    // ブログ詳細ページ -----------------------------------------------------------------------------
    } elseif(is_single()){

?>
.article_header .title.post { font-size:<?php echo esc_attr($options['blog_single_title_font_size']); ?>px; }
#related_post .title { font-size:<?php echo esc_attr($options['related_post_title_font_size']); ?>px; }
@media screen and (max-width:767px) {
  .article_header .title.post { font-size:<?php echo esc_attr($options['blog_single_title_font_size_sp']); ?>px; }
  #related_post .title { font-size:<?php echo esc_attr($options['related_post_title_font_size_sp']); ?>px; }
}
<?php

    // 固定ページ --------------------------------------------------------------------
    } elseif(is_page_template('page-lp.php')) {

      global $post;

      $page_header_catch_font_size = get_post_meta($post->ID, 'page_header_catch_font_size', true) ?  get_post_meta($post->ID, 'page_header_catch_font_size', true) : '32';
      $page_header_catch_font_size_sp = get_post_meta($post->ID, 'page_header_catch_font_size_sp', true) ?  get_post_meta($post->ID, 'page_header_catch_font_size_sp', true) : '22';
?>
#page_header .catch { font-size:<?php echo esc_html($page_header_catch_font_size); ?>px;}
@media screen and (max-width:767px) {
  #page_header .catch { font-size:<?php echo esc_html($page_header_catch_font_size_sp); ?>px;}
}
<?php

    // 404ページ
    }elseif(is_404()){

?>
@media screen and (max-width:767px) {
.sns_button_list.color_type1 li a { color:<?php echo esc_attr($options['page_404_font_color']); ?>; }
}
<?php

     }; //END page setting

    // カスタムCSS --------------------------------------------
    if(is_single() || is_page()) {
      global $post;
      $custom_css = get_post_meta($post->ID, 'custom_css', true);
      if($custom_css) {
        echo $custom_css;
      };
    }

    //フッターバー --------------------------------------------
    if(is_mobile()) {
      if($options['footer_bar_type'] == 'type1' && $options['footer_bar_display'] != 'type3'){
        $footer_bar_border_color = hex2rgb($options['footer_bar_border_color']);
        $footer_bar_border_color = implode(",",$footer_bar_border_color);
?>
#dp-footer-bar { background:<?php echo esc_attr($options['footer_bar_bg_color']); ?>; color:<?php echo esc_html($options['footer_bar_font_color']); ?>; }
.dp-footer-bar-item a { border-color:rgba(<?php echo esc_attr($footer_bar_border_color); ?>,<?php echo esc_html($options['footer_bar_border_color_opacity']); ?>); color:<?php echo esc_html($options['footer_bar_font_color']); ?>; }
.dp-footer-bar-item a:hover { border-color:<?php echo esc_html($options['footer_bar_bg_color_hover']); ?>; background:<?php echo esc_html($options['footer_bar_bg_color_hover']); ?>; }
<?php
      } elseif($options['footer_bar_type'] == 'type2' && $options['footer_bar_display'] != 'type3'){
        for($i = 1; $i <= 2; $i++) {
          if($options['show_footer_button'.$i]) {
?>
#dp-footer-bar a.footer_button.num<?php echo $i; ?> { font-size:<?php echo esc_attr($options['footer_button_font_size']); ?>px; color:<?php echo esc_attr($options['footer_button_font_color'.$i]); ?>; background:<?php echo esc_attr($options['footer_button_bg_color'.$i]); ?>; }
#dp-footer-bar a.footer_button.num<?php echo $i; ?>:hover { background:<?php echo esc_attr($options['footer_button_bg_color_hover'.$i]); ?>; }
<?php
          }
        };
      };
    };

	// tcd_head_css_current_page action
	do_action( 'tcd_head_css_current_page' );
?>
</style>
<?php
  
  // JavaScriptの設定はここから　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

  // トップページ
  if(is_front_page() ) {

      get_template_part( 'template-parts/front_page_script' );

  }; // END front page

  // 固定ページ ----------------------------------------------------------
  if(is_page()) {
    global $post;

    // 全画面ヘッダー
    $page_header_type = get_post_meta($post->ID, 'page_header_type', true) ?  get_post_meta($post->ID, 'page_header_type', true) : 'type1';
    if($page_header_type == 'type3'){

?>
<script type="text/javascript">
jQuery(document).ready(function($){

  var winH = $(window).innerHeight();
  $('#page_header.header_type3').css('height', winH);
  $(window).on('resize', function(){
    var winH = $(window).innerHeight();
    $('#page_header.header_type3').css('height', winH);
  });
  $("#page_contents_link").off('click');
  $("#page_contents_link").on('click',function() {
    var myHref= $(this).attr("href");
    if( $("body").hasClass('hide_page_header_bar') ){
      var myPos = $(myHref).offset().top;
    } else if( $("html").hasClass('pc') ){
      var myPos = $(myHref).offset().top - 0;
    } else {
      var myPos = $(myHref).offset().top - 0;
    }
    $("html,body").animate({scrollTop : myPos}, 1000, 'easeOutExpo');
    return false;
  });

});
</script>
<?php 

    };  
    
  };

  // 404 --------------------------------------------
  if(is_404()) {
?>
<script type="text/javascript">
jQuery(document).ready(function($){
  var winH = $(window).innerHeight();
  var headerHeight = $('#header_top').outerHeight();
  var footerHeight = $('#footer').height();
  var pageHeight = winH - headerHeight - footerHeight;
  $('#page_404_header').css('height', pageHeight);
  $(window).on('resize', function(){
    var winH = $(window).innerHeight();
    var headerHeight = $('#header_top').outerHeight();
    var footerHeight = $('#footer').height();
    var pageHeight = winH - headerHeight - footerHeight;
    $('#page_404_header').css('height', pageHeight);
  });
});
</script>
<?php
  };

  // ウィジェット
  if ( is_active_widget(false, false, 'post_slider_widget', true) ) {

    wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper-bundle.min.js', array( 'jquery' ), '7.4.1', true );
    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/swiper-bundle.min.css', array(), '7.4.1' );

?>
<script id="post-slider-widget-slider">
document.addEventListener('DOMContentLoaded', function() {

  let post_slider_widget = document.querySelectorAll('.post_slider_widget');

  if(post_slider_widget.length > 0){

    for(let widget of post_slider_widget) {

      let widgetId = '#' + widget.id; // ex #post_slider_widget-5
      var selector = widget.querySelector('.swiper');
      var slideNum = selector.querySelector('.swiper-wrapper').getAttribute('data-post-num');

      if(selector != null && slideNum > 1){

        let options = {
          effect: 'slide',
          pagination: { // ページネーション
            el: widgetId + ' .swiper-pagination',
            type: 'bullets',
            clickable: true,
          },
          loop: true,
          speed: 900,
          autoplay: {
            delay: 5000,
          }
        }

        var swiper = new Swiper(selector, options);

      } // END if swiperSelectors

    } 

  } // END if tab_post_list_widgets

});
</script>
<?php

  }

  // カスタムスクリプト--------------------------------------------
  if($options['script_code']) {
    echo $options['script_code'];
  };
  if(is_single() || is_page()) {
    global $post;
    $custom_script = get_post_meta($post->ID, 'custom_script', true);
    if($custom_script) {
      echo $custom_script;
    };
  };

}; // END function tcd_head()
add_action('wp_head', 'tcd_head', 11);

?>