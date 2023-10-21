<?php
/*
 * マーケティングの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_marketing_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_marketing_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_marketing_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_marketing_theme_options_validate' );


// タブの名前
function add_marketing_tab_label( $tab_labels ) {
	$tab_labels['marketing'] = __( 'Marketing', 'tcd-ankle' );
	return $tab_labels;
}


// 初期値
function add_marketing_dp_default_options( $dp_default_options ) {

	// 記事下 CTA
	$dp_default_options['single_cta_display'] = 5;

	// CTA-A
	$dp_default_options['single_cta1_type'] = 'type1';
	$dp_default_options['single_cta1_url'] = '#';
	$dp_default_options['single_cta1_catch'] = __('Catchphrase', 'tcd-ankle');
	$dp_default_options['single_cta1_catch_font_size'] = '24';
	$dp_default_options['single_cta1_catch_font_color'] = '#ffffff';
	$dp_default_options['single_cta1_overlay_color'] = '#000000';
	$dp_default_options['single_cta1_overlay_opacity'] = '0.5';
	$dp_default_options['single_cta1_bg_image'] = '';
	$dp_default_options['single_cta_random1'] = 0;
	// CTA-B
	$dp_default_options['single_cta2_type'] = 'type2';
	$dp_default_options['single_cta2_url'] = '#';
	$dp_default_options['single_cta2_catch'] = __('Catchphrase', 'tcd-ankle');
	$dp_default_options['single_cta2_catch_font_size'] = '20';
	$dp_default_options['single_cta2_catch_font_color'] = '#ffffff';
	$dp_default_options['single_cta2_overlay_color'] = '#000000';
	$dp_default_options['single_cta2_overlay_opacity'] = '1';
	$dp_default_options['single_cta2_bg_image'] = '';
	$dp_default_options['single_cta_random2'] = 0;
	// CTA-C
	$dp_default_options['single_cta3_type'] = 'type3';
	$dp_default_options['single_cta3_url'] = '#';
	$dp_default_options['single_cta3_catch'] = __('Catchphrase', 'tcd-ankle');
	$dp_default_options['single_cta3_catch_font_size'] = '20';
	$dp_default_options['single_cta3_catch_font_color'] = '#ffffff';
	$dp_default_options['single_cta3_overlay_color'] = '#000000';
	$dp_default_options['single_cta3_overlay_opacity'] = '1';
	$dp_default_options['single_cta3_bg_image'] = '';
	$dp_default_options['single_cta_random3'] = 0;

	// ミニ CTA
	$dp_default_options['mini_cta_type'] = 'type3';
	$dp_default_options['mini_cta_catch'] = __('Catchphrase', 'tcd-ankle');
	$dp_default_options['mini_cta_catch_font_color'] = '#bf9d87';
	$dp_default_options['mini_cta_desc'] = __( 'Description will be displayed here.<br>Description will be displayed here.', 'tcd-ankle' );
	$dp_default_options['mini_cta_button_label'] = __('Button', 'tcd-ankle');
	$dp_default_options['mini_cta_button_url'] = '#';
	$dp_default_options['mini_cta_button_bg_color'] = '#000000';
	$dp_default_options['mini_cta_image'] = '';
	$dp_default_options['mini_cta_image_url'] = '#';

	// モーダルCTA
	$dp_default_options['modal_cta_type'] = 'type3';
  $dp_default_options['modal_cta_catch'] = __('Catchphrase', 'tcd-ankle');
  $dp_default_options['modal_cta_catch_font_size'] = 40;
  $dp_default_options['modal_cta_catch_font_size_sp'] = 20;
	$dp_default_options['modal_cta_url'] = '#';
  $dp_default_options['modal_cta_image'] = '';
  $dp_default_options['modal_cta_overlay_color'] = '#000000';
  $dp_default_options['modal_cta_overlay_opacity'] = 0.5;
  $dp_default_options['modal_cta_free_space'] = '';


	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_marketing_tab_panel( $options ) {

  global $dp_default_options, $cta_type_options, $cta_display_options;

	$cta_names = array(
		1 => 'CTA-A',
		2 => 'CTA-B',
		3 => 'CTA-C',
	);

?>

<div id="tab-content-marketing" class="tab-content">

  <?php // 記事下CTA ----------------------------------------------------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('CTA under the post content', 'tcd-ankle');  ?></h3>
    <div class="theme_option_field_ac_content">
      
      <h4 class="theme_option_headline2"><?php _e( 'CTA under the post content', 'tcd-ankle' ); ?></h4>
      <div class="theme_option_message2">
        <p><?php _e( 'You can set up CTA under the post content.', 'tcd-ankle' ); ?></br><?php _e( 'You can register up to three contents.', 'tcd-ankle' ); ?></p>
      </div>

      <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
      <div class="sub_box cf single-cta-preview-wrapper preview_image_wrapper"> 
        <h3 class="theme_option_subbox_headline">CTA-<?php echo 1 === $i ? 'A' : ( 2 === $i ? 'B' : 'C' ); ?></h3>
        <div class="sub_box_content">

          <div class="admin_preview_area single-cta-preview">
						<div class="single_cta">
              <div class="title_wrap"><span class="title"><?php echo wp_kses_post(nl2br($options['single_cta'.$i.'_catch'])); ?></span></div>
              <div class="overlay"></div>
              <?php
								$no_image = get_template_directory_uri().'/img/common/no_image2.gif';
								$image = wp_get_attachment_image_src($options['single_cta'.$i.'_bg_image'], 'full');
							?>
              <div class="image_wrap"><img class="image preview_image" src="<?php if($image){ echo $image[0]; }else{ echo $no_image; } ?>" alt="" data-src="<?php echo $no_image; ?>"></div>
						</div>
					</div>

          <h4 class="theme_option_headline2"><?php echo tcd_admin_label('basic'); ?></h4>
          <ul class="option_list">
            <li class="cf"><span class="label"><?php _e('URL', 'tcd-ankle'); ?></span><input class="full_width" type="text" name="dp_options[single_cta<?php echo $i; ?>_url]" value="<?php esc_attr_e( $options['single_cta'.$i.'_url'] ); ?>" /></li>
            <li class="cf"><span class="label"><?php _e('CTA Design', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($options, 'single_cta'.$i.'_type', $cta_type_options); ?></li>
          </ul>

          <h4 class="theme_option_headline2"><?php echo tcd_admin_label('text'); ?></h4>
          <ul class="option_list">
            <li class="cf"><span class="label"><?php echo tcd_admin_label('catch'); ?></span><textarea name="dp_options[single_cta<?php echo $i; ?>_catch]" class="full_width"><?php echo esc_textarea( $options['single_cta'.$i.'_catch'] ); ?></textarea></li>
            <li class="cf"><span class="label"><?php echo tcd_admin_label('font_size'); ?></span><label class="number_option"><input class="hankaku" type="number" name="dp_options[single_cta<?php echo $i; ?>_catch_font_size]" value="<?php esc_attr_e( $options['single_cta'.$i.'_catch_font_size'] ); ?>" min="9" max="100" /></label></li>
            <li class="cf"><span class="label"><?php echo tcd_admin_label('color'); ?></span><input type="text" name="dp_options[single_cta<?php echo $i; ?>_catch_font_color]" value="<?php echo esc_attr( $options['single_cta'.$i.'_catch_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
          </ul>

          <h4 class="theme_option_headline2"><?php echo tcd_admin_label('bg'); ?></h4>
          <ul class="option_list">
						<li class="cf"><span class="label"><?php echo tcd_admin_label('bg_image'); ?></span><?php echo tcd_media_image_uploader($options, 'single_cta'.$i.'_bg_image', 'full'); ?></li>
            <li class="cf"><span class="label"><?php echo tcd_admin_label('overlay_color'); ?></span><input type="text" name="dp_options[single_cta<?php echo $i; ?>_overlay_color]" value="<?php echo esc_attr( $options['single_cta'.$i.'_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
            <li class="cf"><span class="label"><?php echo tcd_admin_label('overlay_opacity'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[single_cta<?php echo $i; ?>_overlay_opacity]" value="<?php echo esc_attr( $options['single_cta'.$i.'_overlay_opacity'] ); ?>" /></li>
          </ul>
					<div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;"><p><?php echo tcd_admin_label('opacity_desc'); ?></p></div>

          <ul class="button_list cf">
            <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
            <li><a class="button-ml close_sub_box" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
          </ul>

        </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->
      <?php endfor; ?>

      <?php // 表示設定 --------------------------------------------- ?>
      <h4 class="theme_option_headline2"><?php echo tcd_admin_label('display_setting'); ?></h4>
      <div class="theme_option_message2">
        <p><?php _e( 'Please select the CTA to display under the post content.', 'tcd-ankle' ); ?></p>
      </div>
      <select id="js-cta-display" name="dp_options[single_cta_display]">
        <?php foreach ( $cta_display_options as $option ) : ?>
        <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $options['single_cta_display'] ); ?>><?php esc_html_e( $option['label'] ); ?></option>
        <?php endforeach; ?>
      </select>

      <div id="js-cta-random-display" class="<?php if ( '4' !== $options['single_cta_display'] ) { echo 'u-hidden'; } ?>">
        <h4 class="theme_option_headline2"><?php _e( 'Random display', 'tcd-ankle' ); ?></h4>
        <p><?php _e( 'Please select CTA to use in random display.', 'tcd-ankle' ); ?></p>
        <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
        <p><label><input type="checkbox" name="dp_options[single_cta_random<?php echo $i; ?>]" value="1" <?php checked( 1, $options['single_cta_random' . $i] ); ?>>CTA-<?php echo 1 === $i ? 'A' : ( 2 === $i ? 'B' : 'C' ); ?></label></p>
        <?php endfor; ?>
      </div>

      <?php // ABテスト --------------------------------------------- ?>
      <h4 class="theme_option_headline2"><?php _e( 'A/B Testing', 'tcd-ankle' ); ?></h4>
      <div class="theme_option_message">
        <p><?php _e( 'To measure conversions, copy and paste the following code in the editor of "thanks page".', 'tcd-ankle' ); ?></p>
      </div>
      <p><textarea class="large-text" readonly="readonly"><div id="js-cta-conversion"></div></textarea></p>
      <table class="c-ab-table">
        <tr class="c-ab-table__row">
          <th>CTA</th>
          <th><?php _e( 'Impressions', 'tcd-ankle' ); ?></th>
          <th><?php _e( 'Number of clicks', 'tcd-ankle' ); ?></th>
          <th><?php _e( 'Click-through rate', 'tcd-ankle' ); ?></th>
          <th><?php _e( 'Conversions', 'tcd-ankle' ); ?></th>
          <th><?php _e( 'Conversion rate', 'tcd-ankle' ); ?></th>
          <th><?php _e( 'Reset', 'tcd-ankle' ); ?></th>
        </tr>
        <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
        <tr class="c-ab-table__row">
          <td>CTA-<?php echo 1 === $i ? 'A' : ( 2 === $i ? 'B' : 'C' ); ?></td>
          <td class="c-ab-table__impression"><?php echo esc_html( get_option( 'tcd_cta_impression' . $i, 0 ) ); ?></td>
          <td class="c-ab-table__click"><?php echo esc_html( get_option( 'tcd_cta_click' . $i, 0 ) ); ?></td>
          <td class="c-ab-table__ctr"><?php echo esc_html( get_option( 'tcd_cta_ctr' . $i, 0 ) ); ?>%</td>
          <td class="c-ab-table__conversion"><?php echo esc_html( get_option( 'tcd_cta_conversion' . $i, 0 ) ); ?></td>
          <td class="c-ab-table__cvr"><?php echo esc_html( get_option( 'tcd_cta_cvr' . $i, 0 ) ); ?>%</td>
          <td><a class="js-cta-reset c-ab-table__reset" href="#" data-cta-index="<?php echo $i; ?>"><?php _e( 'Reset values', 'tcd-ankle' ); ?></a></td>
        </tr>
      <?php endfor; ?>
      </table>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->




	<?php // ミニCTA ?>
	<div class="theme_option_field cf theme_option_field_ac">
		<h3 class="theme_option_headline"><?php _e( 'Popup CTA', 'tcd-ankle' ); ?></h3>
		<div class="theme_option_field_ac_content">

			<div class="theme_option_message2">
				<p><?php _e( 'You can set up Popup CTA which is displayed at the bottom right of the screen on scroll.<br>If click the close button in Popup CTA, hide the Popup CTA until browser closes.', 'tcd-ankle' ); ?></p>
			</div>

			<h4 class="theme_option_headline2"><?php  _e( 'Popup CTA type', 'tcd-ankle' ); ?></h4>
			<span class="simple_radio_button spacer"></span>
      <input type="radio" id="mini_cta_type1" name="dp_options[mini_cta_type]" value="type1" <?php checked( $options['mini_cta_type'], 'type1' ); ?> />
      <label for="mini_cta_type1"><?php _e( 'Banner template', 'tcd-ankle' ); ?></label></br>
			<span class="simple_radio_button spacer"></span>
      <input type="radio" id="mini_cta_type2" name="dp_options[mini_cta_type]" value="type2" <?php checked( $options['mini_cta_type'], 'type2' ); ?> />
      <label for="mini_cta_type2"><?php _e( 'Use image', 'tcd-ankle' ); ?></label></br>
			<span class="simple_radio_button spacer"></span>
      <input type="radio" id="mini_cta_type3" name="dp_options[mini_cta_type]" value="type3" <?php checked( $options['mini_cta_type'], 'type3' ); ?> />
      <label for="mini_cta_type3"><?php _e( 'Hide Popup CTA', 'tcd-ankle' ); ?></label></br>

			<div id="mini_cta_type1_area" class="mini-cta-preview-wrapper">

				<h4 class="theme_option_headline2"><?php _e( 'Banner template', 'tcd-ankle' ); ?></h4>

				<div class="admin_preview_area mini-cta-preview">
					<div class="mini_cta">
						<div class="mini_cta_inner">
							<span class="mini_cta_close">&#xe91a;</span>
							<div class="mini_cta_contents">
								<div class="mini_cta_catch"><span class="catch"><?php echo esc_textarea( $options['mini_cta_catch'] ); ?></span></div>
								<div class="mini_cta_desc"><span class="desc"><?php echo esc_textarea( $options['mini_cta_desc'] ); ?></span></div>
								<span class="mini_cta_button"><?php echo esc_html( $options['mini_cta_button_label'] ); ?></span>
							</div>
						</div>
					</div>
				</div>

				<h4 class="theme_option_headline2"><?php echo tcd_admin_label('text'); ?></h4>
				<ul class="option_list">
					<li class="cf"><span class="label"><?php echo tcd_admin_label('catch'); ?></span><textarea class="full_width" rows="2" name="dp_options[mini_cta_catch]"><?php echo esc_textarea( $options['mini_cta_catch'] ); ?></textarea></li>
					<li class="cf"><span class="label"><?php echo tcd_admin_label('color'); ?></span><input type="text" name="dp_options[mini_cta_catch_font_color]" value="<?php echo esc_attr( $options['mini_cta_catch_font_color'] ); ?>" data-default-color="#bf9d87" class="c-color-picker"></span></li>
					<li class="cf"><span class="label"><?php echo tcd_admin_label('desc'); ?></span><textarea class="full_width" rows="3" name="dp_options[mini_cta_desc]"><?php echo esc_textarea( $options['mini_cta_desc'] ); ?></textarea></li>
				</ul>

				<h4 class="theme_option_headline2"><?php echo tcd_admin_label('button'); ?></h4>
				<ul class="option_list">
					<li class="cf"><span class="label"><?php _e( 'URL', 'tcd-ankle' ); ?></span><input type="text" class="full_width" name="dp_options[mini_cta_button_url]" value="<?php echo esc_attr( $options['mini_cta_button_url'] ); ?>"></li>
					<li class="cf"><span class="label"><?php echo tcd_admin_label('label'); ?></span><input type="text" class="full_width" name="dp_options[mini_cta_button_label]" value="<?php echo esc_attr( $options['mini_cta_button_label'] ); ?>"></li>
					<li class="cf"><span class="label"><?php echo tcd_admin_label('bg_color'); ?></span><input type="text" name="dp_options[mini_cta_button_bg_color]" value="<?php echo esc_attr( $options['mini_cta_button_bg_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></span></li>
				</ul>

			</div>

			<div id="mini_cta_type2_area" class="preview_image_wrapper">
				<h4 class="theme_option_headline2"><?php _e( 'Use image', 'tcd-ankle' ); ?></h4>

				<div class="admin_preview_area mini-cta-preview">
					<div class="mini_cta type2">
						<div class="mini_cta_inner">
							<span class="mini_cta_close">&#xe91a;</span>
							<div class="mini_cta_contents">
								<?php
									$no_image = get_template_directory_uri().'/img/common/no_image1.gif';
									$image = wp_get_attachment_image_src($options['mini_cta_image'], 'full');
								?>
								<div class="mini_cta_image">
									<img class="image preview_image" src="<?php if($image){ echo $image[0]; }else{ echo $no_image; } ?>" alt="" data-src="<?php echo $no_image; ?>">
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="theme_option_message2" style="margin-top:30px;">
					<p><?php _e( 'Images can be displayed in Popup CTA.', 'tcd-ankle' ); ?></p>
				</div>
				<ul class="option_list">
					<li class="cf"><span class="label"><?php _e( 'URL', 'tcd-ankle' ); ?></span><input class="full_width" type="text" name="dp_options[mini_cta_image_url]" value="<?php esc_attr_e( $options['mini_cta_image_url'] ); ?>" /></li>
					<li class="cf"><span class="label"><?php _e( 'Image', 'tcd-ankle' ); ?></span><?php echo tcd_media_image_uploader($options, 'mini_cta_image'); ?></li>
				</ul>

			</div>

			<ul class="button_list cf">
				<li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
				<li><a class="close_ac_content button-ml" href="javascript:void(0);"><?php echo tcd_admin_label('close'); ?></a></li>
			</ul>
		</div>
	</div>







  <?php // Modal CTA ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e( 'Modal CTA', 'tcd-ankle' ); ?></h3>
    <div class="theme_option_field_ac_content">

      <div class="theme_option_message2">
				<p><?php _e( 'Configure settings for Modal CTA that are displayed across the screen when the page loads.<br>If click the close button in Popup CTA, hide the Modal CTA until browser closes.', 'tcd-ankle' ); ?></p>
			</div>

			<h4 class="theme_option_headline2"><?php  _e( 'Modal CTA type', 'tcd-ankle' ); ?></h4>
			<span class="simple_radio_button spacer"></span>
      <input type="radio" id="modal_cta_type1" name="dp_options[modal_cta_type]" value="type1" <?php checked( $options['modal_cta_type'], 'type1' ); ?> />
      <label for="modal_cta_type1"><?php _e( 'Banner template', 'tcd-ankle' ); ?></label></br>
			<span class="simple_radio_button spacer"></span>
      <input type="radio" id="modal_cta_type2" name="dp_options[modal_cta_type]" value="type2" <?php checked( $options['modal_cta_type'], 'type2' ); ?> />
      <label for="modal_cta_type2"><?php _e( 'Wysiwyg editor', 'tcd-ankle' ); ?></label></br>
			<span class="simple_radio_button spacer"></span>
      <input type="radio" id="modal_cta_type3" name="dp_options[modal_cta_type]" value="type3" <?php checked( $options['modal_cta_type'], 'type3' ); ?> />
      <label for="modal_cta_type3"><?php _e( 'Hide Modal CTA', 'tcd-ankle' ); ?></label></br>


			<div id="modal_cta_type1_area" class="modal-cta-preview-wrapper preview_image_wrapper">

				<h4 class="theme_option_headline2"><?php _e( 'Banner template', 'tcd-ankle' ); ?></h4>

				<div class="admin_preview_area modal-cta-preview">

					<div class="full_screen_button"><?php _e( 'View larger', 'tcd-ankle' ); ?></div>

					<div class="modal_cta">
						<div class="modal_cta_inner">
							<div class="modal_cta_content">
								<?php
										$no_image = get_template_directory_uri().'/img/common/no_image1.gif';
										$image = wp_get_attachment_image_src($options['modal_cta_image'], 'full');
								?>
								<div class="modal_cta_image">
									<img class="preview_image" src="<?php if($image){ echo $image[0]; }else{ echo $no_image; } ?>" alt="" data-src="<?php echo $no_image; ?>">
								</div>
								<div class="modal_cta_info">
									<div class="modal_cta_catch"><?php echo wp_kses_post(nl2br($options['modal_cta_catch'])); ?></div>
								</div>
								<div class="modal_cta_overlay"></div>
							</div>
							<button class="modal_cta_close">&#xe91a;</button>
						</div>
						<div class="full_screen_overlay"></div>

					</div>
				</div>

				<h4 class="theme_option_headline2"><?php echo tcd_admin_label('text'); ?></h4>
				<ul class="option_list">
					<li class="cf"><span class="label"><?php echo tcd_admin_label('catch'); ?></span><textarea name="dp_options[modal_cta_catch]" class="full_width"><?php echo esc_textarea( $options['modal_cta_catch'] ); ?></textarea></li>
					<li class="cf"><span class="label"><?php echo tcd_admin_label('font_size'); ?></span><?php echo tcd_font_size_option($options, 'modal_cta_catch_font_size'); ?></li>
				</ul>

				<h4 class="theme_option_headline2"><?php echo tcd_admin_label('bg'); ?></h4>
				<ul class="option_list">
					<li class="cf"><span class="label"><?php _e('URL', 'tcd-ankle'); ?></span><input class="full_width" type="text" name="dp_options[modal_cta_url]" value="<?php esc_attr_e( $options['modal_cta_url'] ); ?>" /></li>
					<li class="cf"><span class="label"><?php echo tcd_admin_label('bg_image'); ?></span><?php echo tcd_media_image_uploader($options, 'modal_cta_image'); ?></li>
          <li class="cf"><span class="label"><?php echo tcd_admin_label('overlay_color'); ?></span><input type="text" name="dp_options[modal_cta_overlay_color]" value="<?php echo esc_attr( $options['modal_cta_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
          <li class="cf"><span class="label"><?php echo tcd_admin_label('overlay_opacity'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[modal_cta_overlay_opacity]" value="<?php echo esc_attr( $options['modal_cta_overlay_opacity'] ); ?>" /></li>
        </ul>
				<div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;"><p><?php echo tcd_admin_label('opacity_desc'); ?></p></div>
			
			</div>


			<div id="modal_cta_type2_area">
				<h4 class="theme_option_headline2"><?php _e( 'Wysiwyg editor', 'tcd-ankle' ); ?></h4>
				<div class="theme_option_message2">
					<p><?php _e( 'You can use the Wysiwyg editor to display any content you want.', 'tcd-ankle' ); ?></br><?php _e( 'Depending on the content you insert, the display may be corrupted.', 'tcd-ankle' ); ?></p>
				</div>
				<?php wp_editor( $options['modal_cta_free_space'], 'modal_cta_free_space', array ( 'textarea_name' => 'dp_options[modal_cta_free_space]', 'textarea_rows' => 3 ) ); ?>			
			</div>
      

      <ul class="button_list cf">
				<li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
				<li><a class="close_ac_content button-ml" href="javascript:void(0);"><?php echo tcd_admin_label('close'); ?></a></li>
			</ul>
		</div><!-- END .theme_option_field_ac_content -->
	</div><!-- theme_option_field_ac -->



</div><!-- END .tab-content -->

<?php
} // END add_marketing_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_marketing_theme_options_validate( $input ) {

  global $dp_default_options, $cta_type_options, $cta_display_options;

	// 記事下CTA
	if ( ! isset( $input['single_cta_display'] ) ) $input['single_cta_display'] = null;
	if ( ! array_key_exists( $input['single_cta_display'], $cta_display_options ) ) $input['single_cta_display'] = null;
	for ( $i = 1; $i <= 3; $i++ ) {
    if ( ! isset( $input['single_cta'.$i.'_type'] ) ) $input['single_cta'.$i.'_type'] = null;
    if ( ! array_key_exists( $input['single_cta'.$i.'_type'], $cta_type_options ) ) $input['single_cta'.$i.'_type'] = null;
    $input['single_cta'.$i.'_url'] = wp_filter_nohtml_kses( $input['single_cta'.$i.'_url'] );
    $input['single_cta'.$i.'_catch'] = $input['single_cta'.$i.'_catch']; // HTML対応
    $input['single_cta'.$i.'_catch_font_size'] = absint( $input['single_cta'.$i.'_catch_font_size'] );
    $input['single_cta'.$i.'_catch_font_color'] = sanitize_hex_color( $input['single_cta'.$i.'_catch_font_color'] );
    $input['single_cta'.$i.'_overlay_color'] = sanitize_hex_color( $input['single_cta'.$i.'_overlay_color'] );
    $input['single_cta'.$i.'_overlay_opacity'] = wp_filter_nohtml_kses( $input['single_cta'.$i.'_overlay_opacity'] );
    $input['single_cta'.$i.'_bg_image'] = absint( $input['single_cta'.$i.'_bg_image'] );
    if ( ! isset( $input['single_cta_random' . $i] ) ) $input['single_cta_random' . $i] = null;
    $input['single_cta_random' . $i] = ( $input['single_cta_random' . $i] == 1 ? 1 : 0 );
	}

	// ミニCTA
	$input['mini_cta_type'] = wp_filter_nohtml_kses( $input['mini_cta_type'] );
	$input['mini_cta_catch'] = sanitize_textarea_field( $input['mini_cta_catch'] );
	$input['mini_cta_catch_font_color'] = sanitize_hex_color( $input['mini_cta_catch_font_color'] );
	$input['mini_cta_desc'] = sanitize_textarea_field( $input['mini_cta_desc'] );
	$input['mini_cta_button_label'] = sanitize_text_field( $input['mini_cta_button_label'] );
	$input['mini_cta_button_url'] = sanitize_text_field( $input['mini_cta_button_url'] );
	$input['mini_cta_button_bg_color'] = sanitize_hex_color( $input['mini_cta_button_bg_color'] );
	$input['mini_cta_image'] = absint( $input['mini_cta_image'] );
	$input['mini_cta_image_url'] = wp_filter_nohtml_kses( $input['mini_cta_image_url'] );

  // モーダルCTA
	$input['modal_cta_type'] = wp_filter_nohtml_kses( $input['modal_cta_type'] );
	$input['modal_cta_catch'] = wp_filter_nohtml_kses( $input['modal_cta_catch'] );
	$input['modal_cta_catch_font_size'] = absint( $input['modal_cta_catch_font_size'] );
	$input['modal_cta_catch_font_size_sp'] = absint( $input['modal_cta_catch_font_size_sp'] );
	$input['modal_cta_url'] = wp_filter_nohtml_kses( $input['modal_cta_url'] );
	$input['modal_cta_image'] = absint( $input['modal_cta_image'] );
	$input['modal_cta_overlay_color'] = sanitize_hex_color( $input['modal_cta_overlay_color'] );
	$input['modal_cta_overlay_opacity'] = wp_filter_nohtml_kses( $input['modal_cta_overlay_opacity'] );
	$input['modal_cta_free_space'] = wp_kses_post( $input['modal_cta_free_space'] );

	return $input;

}