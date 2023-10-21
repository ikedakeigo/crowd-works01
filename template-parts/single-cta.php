<?php
$options = get_design_plus_option();

// 使用するコンテンツの番号
$cta_index = $options['single_cta_display'];

// $cta_index が4（ランダム表示）の時、表示するCTAをランダムで決定する
if ( '4' === $cta_index ) {
	
	// ランダム表示に使用するCTA配列を取得する
	$cta_in_random_display = get_cta_in_random_display();	

	// CTA配列が空の場合、CTAを表示しない
	if ( ! $cta_in_random_display ) {
		
		return;

	// 配列の要素が1つのみの場合、乱数の生成を行わない
	} elseif ( 1 === count( $cta_in_random_display ) ) {

		$cta_index = $cta_in_random_display[0];
	
	// CTA配列から、今回表示するCTAを決定する
	} else {

		$cta_index = rand( 1, count( $cta_in_random_display ) );

	}
}

// 使用するコンテンツのタイプ
$cta_type = $options['single_cta'.$cta_index.'_type'];
$url = ($options['single_cta'.$cta_index.'_url']) ? $options['single_cta'.$cta_index.'_url'] : '#';
$catch = $options['single_cta'.$cta_index.'_catch'];
$font_size = 'font-size:'.esc_attr($options['single_cta'.$cta_index.'_catch_font_size']).'px;';
$font_color = 'color:'.esc_attr($options['single_cta'.$cta_index.'_catch_font_color']).';';

$overlay_color = implode(",",hex2rgb($options['single_cta'.$cta_index.'_overlay_color']));
$overlay_opacity = $options['single_cta'.$cta_index.'_overlay_opacity'];
$image = wp_get_attachment_image( $options['single_cta'.$cta_index.'_bg_image'], 'full');

?>
<?php 
// スマホ表示の時、スマホ専用画像が登録されていればそれを、されていなければPC用画像を表示する
?>
<div id="js-cta"  class="single_cta p-cta--<?php esc_attr_e( $cta_index ); ?> <?php esc_attr_e($cta_type); ?>">

  <a id="js-cta__btn" class="link" href="<?php echo $url; ?>">
    <div class="catch_wrap">
      <h3 class="catch" style="<?php echo $font_size.$font_color; ?>"><?php echo wp_kses_post(nl2br($catch)); ?></h3>
    </div>
    <div class="overlay" style="background-color:rgba(<?php esc_attr_e($overlay_color); ?>,<?php esc_attr_e($overlay_opacity); ?>);"></div>
    <div class="image_wrap">
      <?php if($image) echo $image; ?>
    </div>
  </a>

</div>