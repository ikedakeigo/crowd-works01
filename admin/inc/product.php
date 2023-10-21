<?php
/*
 * 商品の設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_product_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_product_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_product_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_product_theme_options_validate' );


// タブの名前
function add_product_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  $tab_label = $options['product_label'] ? esc_html( $options['product_label'] ) : __( 'Product', 'tcd-ankle' );
  $tab_labels['product'] = $tab_label;
  return $tab_labels;
}

// 初期値
function add_product_dp_default_options( $dp_default_options ) {

	// 共通商品一覧
	$dp_default_options['product_label'] = __( 'Product', 'tcd-ankle' );
  $dp_default_options['product_archive_title_font_size'] = 20;
	$dp_default_options['product_archive_title_font_size_sp'] = 16;
  $dp_default_options['product_list_currency_symbol'] = 'type1';
  //// 新着バッジ
  $dp_default_options['show_product_list_badge_new'] = 1;
  $dp_default_options['product_list_badge_new'] = __('NEW', 'tcd-ankle');
  $dp_default_options['product_list_badge_new_bg_color'] = '#6c975e';
  //// セールバッジ
  $dp_default_options['show_product_list_badge_sale'] = 1;
  $dp_default_options['product_list_badge_sale'] = __('SALE', 'tcd-ankle');
  $dp_default_options['product_list_badge_sale_bg_color'] = '#c4837a';
  //// おすすめバッジ
  $dp_default_options['show_product_list_badge_featured'] = 1;
  $dp_default_options['product_list_badge_featured'] = __('HOT', 'tcd-ankle');
  $dp_default_options['product_list_badge_featured_bg_color'] = '#d2b460';
  //// 在庫ラベル
  $dp_default_options['product_list_outofstock_label'] = __('SOLD OUT', 'tcd-ankle');
  $dp_default_options['product_list_outofstock_bg_color'] = '#b72713';

  // アーカイブページ
	$dp_default_options['product_archive_headline'] = __( 'ALL ITEM', 'tcd-ankle' );
	$dp_default_options['product_archive_sub_headline'] = __( 'ALL ITEM', 'tcd-ankle' );
	$dp_default_options['product_archive_desc'] = '';
  $dp_default_options['product_archive_display_type'] = 'async';
  $dp_default_options['product_archive_ajax_button_label'] = __( 'MORE ITEM', 'tcd-ankle' );
	$dp_default_options['product_archive_num'] = 9;
	$dp_default_options['product_archive_num_sp'] = 6;

  // アーカイブフィルター
  $dp_default_options['show_product_archive_filter'] = 1;
  // カテゴリーリスト
  $dp_default_options['product_archive_filter_category_label'] = __( 'ALL ITEM', 'tcd-ankle' );
  $dp_default_options['product_archive_filter_categories'] = array();
  // ソートフィルター
  $dp_default_options['product_archive_filter_default'] = 'menu_order';
  $dp_default_options['product_archive_filter_date'] = 1;
  $dp_default_options['product_archive_filter_popularity'] = 1;
  $dp_default_options['product_archive_filter_rating'] = 1;
  $dp_default_options['product_archive_filter_price'] = 1;
  $dp_default_options['product_archive_filter_price-desc'] = 1;

	// 詳細ページ
	$dp_default_options['product_single_title_font_size'] = '24';
	$dp_default_options['product_single_title_font_size_sp'] = '20';
  $dp_default_options['product_single_tabs_priority'] = 'additional_information';
  $dp_default_options['product_single_tabs1_label'] = __( 'Remarks', 'tcd-ankle' );
  $dp_default_options['product_single_tabs2_label'] = __( 'Product details', 'tcd-ankle' );
  $dp_default_options['product_single_tabs3_label'] = __( 'Reviews', 'tcd-ankle' );
  
  // レビュー
  $dp_default_options['product_single_reviews_star_color'] = '#ffa500';
  $dp_default_options['product_list_display_review'] = 'display';
  $dp_default_options['product_single_display_rating'] = 'display';

  $dp_default_options['product_single_reviews_form_title'] =  __( 'Add a review', 'tcd-ankle' );
  $dp_default_options['product_single_reviews_form_desc'] =  __( 'Your rating', 'tcd-ankle' );
  $dp_default_options['product_single_reviews_form_button_label'] =  __( 'Submit review', 'tcd-ankle' );
  $dp_default_options['product_single_reviews_form_title_logout'] =  __( 'Want to write a review?', 'tcd-ankle' );
  $dp_default_options['product_single_reviews_form_desc_logout'] =  __( 'You must be a registered member to post a review.', 'tcd-ankle' );
  $dp_default_options['product_single_reviews_form_button_label_logout'] =  __( 'Write a review', 'tcd-ankle' );

  // 関連商品
  $dp_default_options['show_product_single_related_products'] = 1;
  $dp_default_options['product_single_related_products_headline'] = __( 'Related products', 'tcd-ankle' );
  $dp_default_options['product_single_related_products_sub_headline'] = '';
  $dp_default_options['product_single_related_products_num'] = '6';
  $dp_default_options['product_single_related_products_num_sp'] = '2';
  // アップセル
  $dp_default_options['product_single_upsells_products_headline'] = '';
  $dp_default_options['product_single_upsells_products_sub_headline'] = '';
  // クロスセル
  $dp_default_options['product_single_closs_sells_products_headline'] = __( 'How about this product?', 'tcd-ankle' );
  
  // 最近チェックした商品一覧
  $dp_default_options['show_product_single_recentry_viewed_products'] = 1;
  $dp_default_options['product_single_recentry_viewed_products_headline'] = __('Recentry viewed products', 'tcd-ankle');
  $dp_default_options['product_single_recentry_viewed_products_num'] = 10;
  $dp_default_options['product_single_recentry_viewed_products_num_sp'] = 8;

  // ウィッシュリスト
  $dp_default_options['product_wishlist_label'] = __( 'Wishlist', 'tcd-ankle' ); // ドロワーメニューも
  $dp_default_options['product_wishlist_message'] = __( 'There are no items on your wishlist yet.', 'tcd-ankle' );
  $dp_default_options['product_wishlist_num'] = 6;
	$dp_default_options['product_wishlist_num_sp'] = 6;
  // お気に入りボタン
  $dp_default_options['product_single_wishlist_label'] = __( 'Add to Favorites', 'tcd-ankle' );
  $dp_default_options['product_single_wishlist_label_add'] = __( 'Already added', 'tcd-ankle' );
  $dp_default_options['product_single_wishlist_icon_color'] = '#bf9d87';
  // お気に入り告知
  $dp_default_options['product_wishlist_message_add'] = __( 'Added to', 'tcd-ankle' );
  $dp_default_options['product_wishlist_message_remove'] = __( 'Removed from', 'tcd-ankle' );
  $dp_default_options['product_wishlist_message_bg_color'] = '#333333';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_product_tab_panel( $options ) {

  global $dp_default_options, $basic_display_options, $product_archive_display_type_options, $currency_symbol_options, $wc_tabs_priority_options;
  $product_label = $options['product_label'] ? esc_html( $options['product_label'] ) : __( 'Product', 'tcd-ankle' );

?>

<div id="tab-content-product" class="tab-content">

  <?php

    // WooCommerce が有効時
    if(is_woocommerce_active()){
  
  ?>
  <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php echo tcd_admin_label('common'); ?></h3>
    <div class="theme_option_field_ac_content">

      <h4 class="theme_option_headline2"><?php echo tcd_admin_label('content_name'); ?></h4>
      <div class="theme_option_message2"><p><?php echo tcd_admin_label('use_breadcrumb'); ?></p></div>
      <input id="dp_options[product_label]" class="regular-text" type="text" name="dp_options[product_label]" value="<?php echo esc_attr( $options['product_label'] ); ?>" />

      <h4 class="theme_option_headline2"><?php _e('Product list', 'tcd-ankle'); ?></h4>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php echo tcd_admin_label('font_size_title'); ?></span><?php echo tcd_font_size_option($options, 'product_archive_title_font_size') ?></li>
        <li class="cf"><span class="label"><?php _e('Japanese Yen symbol type', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'product_list_currency_symbol', $currency_symbol_options); ?></li>
      </ul>

      <h4 class="theme_option_headline2"><?php _e('Various badges and out-of-stock labels', 'tcd-ankle'); ?></h4>
      <ul class="tcd_standard_tab_area" style="margin-top:20px; margin-bottom:20px;">
        <li class="tcd_standard_tab_label is_active"><?php _e('New badge', 'tcd-ankle'); ?></li>
        <li class="tcd_standard_tab_label"><?php _e('Sale badge', 'tcd-ankle'); ?></li>
        <li class="tcd_standard_tab_label"><?php _e('Featuerd badge', 'tcd-ankle'); ?></li>
        <li class="tcd_standard_tab_label"><?php _e('Out of stock label', 'tcd-ankle'); ?></li>
      </ul>
      <div class="tcd_standard_tab_contents">

        <div class="tcd_standard_tab_content is_active">
          <input id="show_product_list_badge_new" class="show_checkbox" name="dp_options[show_product_list_badge_new]" type="checkbox" value="1" <?php checked( $options['show_product_list_badge_new'], 1 ); ?>>
          <label for="show_product_list_badge_new"><?php _e( 'Display new badge', 'tcd-ankle' ); ?></label>
          <div class="show_checkbox_area">
            <ul class="option_list" style="padding-top:10px;border-top:1px dotted #ccc;">
              <li class="cf"><span class="label"><?php echo tcd_admin_label('label'); ?></span><input class="regular-text" type="text" name="dp_options[product_list_badge_new]" value="<?php esc_attr_e( $options['product_list_badge_new'] ); ?>" /></li>
              <li class="cf"><span class="label"><?php echo tcd_admin_label('bg_color'); ?></span><input type="text" name="dp_options[product_list_badge_new_bg_color]" value="<?php echo esc_attr( $options['product_list_badge_new_bg_color'] ); ?>" data-default-color="#6c975e" class="c-color-picker"></li>
            </ul>
          </div>
          <div class="theme_option_message2" style="margin-top:10px;">
            <p>
              <?php _e('The badge will be displayed in the upper left corner of each product image in the product list.', 'tcd-ankle');  ?></br>
              <b><?php _e('The new badge will automatically appear on products that are within three days of the publication date.', 'tcd-ankle');  ?></b>
            </p>
          </div>
        </div>

        <div class="tcd_standard_tab_content">
          <input id="show_product_list_badge_sale" class="show_checkbox" name="dp_options[show_product_list_badge_sale]" type="checkbox" value="1" <?php checked( $options['show_product_list_badge_sale'], 1 ); ?>>
          <label for="show_product_list_badge_sale"><?php _e( 'Display sale badge', 'tcd-ankle' ); ?></label>
          <div class="show_checkbox_area">
            <ul class="option_list" style="padding-top:10px;border-top:1px dotted #ccc;">
              <li class="cf"><span class="label"><?php echo tcd_admin_label('label'); ?></span><input class="regular-text" type="text" name="dp_options[product_list_badge_sale]" value="<?php esc_attr_e( $options['product_list_badge_sale'] ); ?>" /></li>
              <li class="cf"><span class="label"><?php echo tcd_admin_label('bg_color'); ?></span><input type="text" name="dp_options[product_list_badge_sale_bg_color]" value="<?php echo esc_attr( $options['product_list_badge_sale_bg_color'] ); ?>" data-default-color="#c4837a" class="c-color-picker"></li>
            </ul>
          </div>
          <div class="theme_option_message2" style="margin-top:10px;">
            <p>
              <?php _e('The badge will be displayed in the upper left corner of each product image in the product list.', 'tcd-ankle');  ?></br>
              <b><?php _e('The sale badge will automatically appear on items that are on sale.', 'tcd-ankle');  ?></b>
            </p>
          </div>
        </div>

        <div class="tcd_standard_tab_content">
          <input id="show_product_list_badge_featured" class="show_checkbox" name="dp_options[show_product_list_badge_featured]" type="checkbox" value="1" <?php checked( $options['show_product_list_badge_featured'], 1 ); ?>>
          <label for="show_product_list_badge_featured"><?php _e( 'Display featuerd badge', 'tcd-ankle' ); ?></label>
          <div class="show_checkbox_area">
            <ul class="option_list" style="padding-top:10px;border-top:1px dotted #ccc;">
              <li class="cf"><span class="label"><?php echo tcd_admin_label('label'); ?></span><input class="regular-text" type="text" name="dp_options[product_list_badge_featured]" value="<?php esc_attr_e( $options['product_list_badge_featured'] ); ?>" /></li>
              <li class="cf"><span class="label"><?php echo tcd_admin_label('bg_color'); ?></span><input type="text" name="dp_options[product_list_badge_featured_bg_color]" value="<?php echo esc_attr( $options['product_list_badge_featured_bg_color'] ); ?>" data-default-color="#d2b460" class="c-color-picker"></li>
            </ul>
          </div>
          <div class="theme_option_message2" style="margin-top:10px;">
            <p>
              <?php _e('The badge will be displayed in the upper left corner of each product image in the product list.', 'tcd-ankle');  ?></br>
              <b><?php _e('The featuerd badges will automatically appear on Featured Products.', 'tcd-ankle');  ?></b>
            </p>
          </div>
        </div>
        
        <div class="tcd_standard_tab_content">
          <ul class="option_list" style="padding-top:10px;border-top:1px dotted #ccc;">
            <li class="cf"><span class="label"><?php echo tcd_admin_label('label'); ?></span><input class="regular-text" type="text" name="dp_options[product_list_outofstock_label]" value="<?php esc_attr_e( $options['product_list_outofstock_label'] ); ?>" /></li>
            <li class="cf"><span class="label"><?php echo tcd_admin_label('bg_color'); ?></span><input type="text" name="dp_options[product_list_outofstock_bg_color]" value="<?php echo esc_attr( $options['product_list_outofstock_bg_color'] ); ?>" data-default-color="#b72713" class="c-color-picker"></li>
          </ul>
          <div class="theme_option_message2" style="margin-bottom:10px;">
            <p>
              <b><?php _e('The out-of-stock label will be automatically displayed at the bottom of the thumbnail image of the out-of-stock item.', 'tcd-ankle');  ?></br>
              <?php _e('When out of stock, the cart button and wish list button will not be displayed.', 'tcd-ankle');  ?></b>
            </p>
          </div>
        </div>

      </div>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // アーカイブページ ----------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php echo tcd_admin_label('archive_page'); ?></h3>
    <div class="theme_option_field_ac_content">

      <h4 class="theme_option_headline2"><?php echo tcd_admin_label('header'); ?></h4>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php echo tcd_admin_label('headline'); ?></span><textarea class="full_width" cols="50" rows="1" name="dp_options[product_archive_headline]"><?php echo esc_textarea( $options['product_archive_headline'] ); ?></textarea></li>
        <li class="cf"><span class="label"><?php echo tcd_admin_label('sub_headline'); ?></span><textarea class="full_width" cols="50" rows="1" name="dp_options[product_archive_sub_headline]"><?php echo esc_textarea( $options['product_archive_sub_headline'] ); ?></textarea></li>
        <li class="cf"><span class="label"><?php echo tcd_admin_label('desc'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[product_archive_desc]"><?php echo esc_textarea( $options['product_archive_desc'] ); ?></textarea></li>
      </ul>

      <h4 class="theme_option_headline2"><?php _e('Product list', 'tcd-ankle'); ?></h4>
      <?php echo tcd_admin_image_radio_button($options, 'product_archive_display_type', $product_archive_display_type_options); ?>
      <ul class="option_list" style="padding-top:10px;border-top:1px dotted #ccc;">
        <li class="cf product_archive_display_type1"><span class="label"><?php echo tcd_admin_label('button_label'); ?></span><input class="regular-text" type="text" name="dp_options[product_archive_ajax_button_label]" value="<?php esc_attr_e( $options['product_archive_ajax_button_label'] ); ?>" /></li>
        <li class="cf"><span class="label"><?php _e('Number of products displayed on one page', 'tcd-ankle'); ?></span><?php echo tcd_display_post_num_option('product_archive_num', array(6,15,3), array(6,14,2)); ?></li>
      </ul>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>

    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->



  <?php // フィルター ----------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Sort / Filter dropdown', 'tcd-ankle'); ?></h3>
    <div class="theme_option_field_ac_content">

      <input id="show_product_archive_filter" class="show_checkbox" name="dp_options[show_product_archive_filter]" type="checkbox" value="1" <?php checked( $options['show_product_archive_filter'], 1 ); ?>>
      <label for="show_product_archive_filter"><?php _e( 'Display Sort / Filter dropdown', 'tcd-ankle' ); ?></label>
      <div class="show_checkbox_area">

        <h4 class="theme_option_headline2"><?php _e('Product category dropdown', 'tcd-ankle'); ?></h4>
        <div class="theme_option_message2" style="margin-bottom:20px;">
          <p><?php _e('Please enter the name of the option to be displayed at the top of the category drop-down below.', 'tcd-ankle');  ?></p>
        </div>
        <ul class="option_list">
          <li class="cf"><span class="label"><?php _e('Default label', 'tcd-ankle');  ?></span><input class="regular-text" type="text" name="dp_options[product_archive_filter_category_label]" value="<?php esc_attr_e( $options['product_archive_filter_category_label'] ); ?>" /></li>
        </ul>
        <div class="theme_option_message2" style="margin-bottom:20px;">
          <p><?php _e('Check the items you want to appear in the category drop-down.</br>You can display up to two levels of categories.', 'tcd-ankle');  ?></p>
        </div>
        <?php

          $taxonomy = is_woocommerce_active() ? 'product_cat' : 'category';
          $selected_cats = $options['product_archive_filter_categories'];

          $tax = get_taxonomy( $taxonomy );
          $args = array(
            'taxonomy' => $taxonomy,
            'disabled' => ! current_user_can( $tax->cap->assign_terms ),
            'list_only' => false,
            'selected_cats' => array_map( 'intval', $selected_cats )
          );
          $categories = (array) get_terms( array( 'taxonomy' => $taxonomy ) );

          $walker = new Walker_Category_Checklist;
          $term_checklist = $walker->walk( $categories, 2, $args);

          echo '<div class="categorydiv" style="border: 1px solid #ddd; max-height: 200px; overflow: auto;padding: 0 20px;">' . "\n";
          echo '<ul class="categorychecklist">' . "\n";
          echo str_replace( is_woocommerce_active() ? ' name="tax_input[product_cat][]"' : ' name="post_category[]"', ' name="dp_options[product_archive_filter_categories][]"', $term_checklist ) . "\n";
          echo '</ul>' . "\n";
          echo '</div>' . "\n";

        ?>
        <h4 class="theme_option_headline2"><?php _e('Sort dropdown', 'tcd-ankle'); ?></h4>
        <div class="theme_option_message2" style="margin-bottom:20px;">
          <p>
            <?php _e('Please select the option to be displayed at the top of the drop-down from the following list.</br>If you select something other than "Sort order", "Sort order" will not be displayed.', 'tcd-ankle');  ?></br>
            <?php printf( __('The default order is the same as the <a href="%s">product list (sorted)</a> in the admin panel.', 'tcd-ankle'), './edit.php?post_type=product&orderby=menu_order+title&order=ASC'); ?>
          </p>
        </div>
        <ul class="option_list">
          <li class="cf"><span class="label"><?php _e('Default sort order', 'tcd-ankle');  ?></span>
            <select name="dp_options[product_archive_filter_default]">
              <option style="padding-right: 10px;" value="menu_order" <?php selected( $options['product_archive_filter_default'], 'menu_order' ); ?>><?php _e('Default', 'tcd-ankle'); ?></option>
              <option style="padding-right: 10px;" value="date" <?php selected( $options['product_archive_filter_default'], 'date' ); ?>><?php _e('Latest', 'tcd-ankle'); ?></option>
              <option style="padding-right: 10px;" value="popularity" <?php selected( $options['product_archive_filter_default'], 'popularity' ); ?>><?php _e('Popularity', 'tcd-ankle'); ?></option>
            </select>
          </li>
        </ul>
        <div class="theme_option_message2" style="margin-bottom:20px;">
          <p><?php _e('Check the items you want to appear in the Sort by drop-down.', 'tcd-ankle');  ?></p>
        </div>
        <div style="border: 1px solid #ddd; max-height: 200px; overflow: auto;padding: 0 20px;">
          <ul>
            <li><label><input name="dp_options[product_archive_filter_date]" type="checkbox" value="1" <?php checked( $options['product_archive_filter_date'], 1 ); ?>><?php _e('Latest', 'tcd-ankle'); ?></label></li>
            <li><label><input name="dp_options[product_archive_filter_popularity]" type="checkbox" value="1" <?php checked( $options['product_archive_filter_popularity'], 1 ); ?>><?php _e('Popularity', 'tcd-ankle'); ?></label></li>
            <li><label><input name="dp_options[product_archive_filter_rating]" type="checkbox" value="1" <?php checked( $options['product_archive_filter_rating'], 1 ); ?>><?php _e('Rating', 'tcd-ankle'); ?></label></li>
            <li><label><input name="dp_options[product_archive_filter_price]" type="checkbox" value="1" <?php checked( $options['product_archive_filter_price'], 1 ); ?>><?php _e('Price: Low to High', 'tcd-ankle'); ?></label></li>
            <li><label><input name="dp_options[product_archive_filter_price-desc]" type="checkbox" value="1" <?php checked( $options['product_archive_filter_price-desc'], 1 ); ?>><?php _e('Price: High to Low', 'tcd-ankle'); ?></label></li>
          </ul>
        </div>

      </div>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>

    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->



  <?php // 詳細ページの設定 ----------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Product page', 'tcd-ankle'); ?></h3>
    <div class="theme_option_field_ac_content">

      <h4 class="theme_option_headline2"><?php echo tcd_admin_label('header'); ?></h4>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php echo tcd_admin_label('font_size_title'); ?></span><?php echo tcd_font_size_option($options, 'product_single_title_font_size') ?></li>
      </ul>

      <h4 class="theme_option_headline2"><?php  _e('Tabs', 'tcd-ankle'); ?></h4>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Tabs to display at the top', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'product_single_tabs_priority', $wc_tabs_priority_options); ?></li>
        <li class="cf"><span class="label"><?php _e('Description tab label', 'tcd-ankle'); ?></span><input class="regular-text" type="text" name="dp_options[product_single_tabs1_label]" value="<?php esc_attr_e( $options['product_single_tabs1_label'] ); ?>" /></li>
        <li class="cf"><span class="label"><?php _e('Additional information tab label', 'tcd-ankle'); ?></span><input class="regular-text" type="text" name="dp_options[product_single_tabs2_label]" value="<?php esc_attr_e( $options['product_single_tabs2_label'] ); ?>" /></li>
        <li class="cf"><span class="label"><?php _e('Reviews tab label', 'tcd-ankle'); ?></span><input class="regular-text" type="text" name="dp_options[product_single_tabs3_label]" value="<?php esc_attr_e( $options['product_single_tabs3_label'] ); ?>" /></li>
      </ul>
      <div class="theme_option_message2" style="margin-bottom:10px;">
        <p><?php _e('The tab labels you enter here will be applied to all products.</br>You can also set them for each product from the product edit page.', 'tcd-ankle');  ?></p>
      </div>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // レビュー ----------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Reviews', 'tcd-ankle'); ?></h3>
    <div class="theme_option_field_ac_content">

      <h4 class="theme_option_headline2"><?php  _e('Basic setting', 'tcd-ankle'); ?></h4>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Star review color', 'tcd-ankle');  ?></span><input type="text" name="dp_options[product_single_reviews_star_color]" value="<?php echo esc_attr( $options['product_single_reviews_star_color'] ); ?>" data-default-color="#ffa500" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Product list star reviews', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'product_list_display_review', $basic_display_options); ?></li>
        <li class="cf"><span class="label"><?php _e('Product single page star reviews', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($options, 'product_single_display_rating', $basic_display_options); ?></li>
      </ul>

      <h4 class="theme_option_headline2"><?php  _e('Review Form', 'tcd-ankle'); ?></h4>
      <ul class="tcd_standard_tab_area" style="margin-top:20px; margin-bottom:20px;">
        <li class="tcd_standard_tab_label is_active"><?php _e('For Members', 'tcd-ankle'); ?></li>
        <li class="tcd_standard_tab_label"><?php _e('For non-members', 'tcd-ankle'); ?></li>
      </ul>
      <div class="tcd_standard_tab_contents">
        <div class="tcd_standard_tab_content is_active">
          <ul class="option_list" style="padding-top:10px;border-top:1px dotted #ccc;">
            <li class="cf"><span class="label"><?php echo tcd_admin_label('headline'); ?></span><textarea class="full_width" cols="50" rows="1" name="dp_options[product_single_reviews_form_title]"><?php echo esc_textarea( $options['product_single_reviews_form_title'] ); ?></textarea></li>
            <li class="cf"><span class="label"><?php echo tcd_admin_label('desc'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[product_single_reviews_form_desc]"><?php echo esc_textarea( $options['product_single_reviews_form_desc'] ); ?></textarea></li>
            <li class="cf"><span class="label"><?php echo tcd_admin_label('button_label'); ?></span><input class="regular-text" type="text" name="dp_options[product_single_reviews_form_button_label]" value="<?php esc_attr_e( $options['product_single_reviews_form_button_label'] ); ?>" /></li>
          </ul>
        </div>
        <div class="tcd_standard_tab_content">
          <ul class="option_list" style="padding-top:10px;border-top:1px dotted #ccc;">
            <li class="cf"><span class="label"><?php echo tcd_admin_label('headline'); ?></span><textarea class="full_width" cols="50" rows="1" name="dp_options[product_single_reviews_form_title_logout]"><?php echo esc_textarea( $options['product_single_reviews_form_title_logout'] ); ?></textarea></li>
            <li class="cf"><span class="label"><?php echo tcd_admin_label('desc'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[product_single_reviews_form_desc_logout]"><?php echo esc_textarea( $options['product_single_reviews_form_desc_logout'] ); ?></textarea></li>
            <li class="cf"><span class="label"><?php echo tcd_admin_label('button_label'); ?></span><input class="regular-text" type="text" name="dp_options[product_single_reviews_form_button_label_logout]" value="<?php esc_attr_e( $options['product_single_reviews_form_button_label_logout'] ); ?>" /></li>
          </ul>
        </div>
      </div>
      <div class="theme_option_message2" style="margin-bottom:10px;">
        <p>
          <b><?php _e('You can change the wording of the review form to display differently for members and non-members.', 'tcd-ankle');  ?></br>
          <?php _e('The review form will not be displayed to non-members (logged out).', 'tcd-ankle');  ?></b>
        </p>
      </div>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->



  <?php // 関連商品 ----------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Related products', 'tcd-ankle'); ?></h3>
    <div class="theme_option_field_ac_content">

      <h4 class="theme_option_headline2"><?php _e('Related products', 'tcd-ankle'); ?></h4>
      <div class="theme_option_message2" style="margin-bottom:10px;">
        <p><?php _e('Related products will be randomly displayed at the bottom of the product detail page.', 'tcd-ankle');  ?></p>
      </div>
      <input id="show_product_single_related_products" class="show_checkbox" name="dp_options[show_product_single_related_products]" type="checkbox" value="1" <?php checked( $options['show_product_single_related_products'], 1 ); ?>>
      <label for="show_product_single_related_products"><?php _e( 'Display related products', 'tcd-ankle' ); ?></label>
      <div class="show_checkbox_area">
        <ul class="option_list" style="padding-top:10px;border-top:1px dotted #ccc;">
          <li class="cf"><span class="label"><?php echo tcd_admin_label('headline'); ?></span><input class="full_width" type="text" name="dp_options[product_single_related_products_headline]" value="<?php esc_attr_e( $options['product_single_related_products_headline'] ); ?>" /></li>
          <li class="cf"><span class="label"><?php echo tcd_admin_label('sub_headline'); ?></span><input class="full_width" type="text" name="dp_options[product_single_related_products_sub_headline]" value="<?php esc_attr_e( $options['product_single_related_products_sub_headline'] ); ?>" /></li>
          <li class="cf"><span class="label"><?php _e('Number of products displayed', 'tcd-ankle'); ?></span><?php echo tcd_display_post_num_option('product_single_related_products_num', array(3,9,1), array(2,8,2)); ?></li>
        </ul>
      </div>

      <h4 class="theme_option_headline2"><?php _e('Upsells', 'tcd-ankle'); ?></h4>
      <div class="theme_option_message2" style="margin-bottom:10px;">
        <p>
          <?php _e('The upsell will be displayed at the bottom of the related product on the detail page.', 'tcd-ankle');  ?></br>
          <?php _e('To display an upsell, set the product you want to display in the "Related Products (Upsell)" section of the product management screen.', 'tcd-ankle');  ?>
        </p>
      </div>
      <ul class="option_list" style="padding-top:10px;border-top:1px dotted #ccc;">
        <li class="cf"><span class="label"><?php echo tcd_admin_label('headline'); ?></span><input class="full_width" type="text" name="dp_options[product_single_upsells_products_headline]" value="<?php esc_attr_e( $options['product_single_upsells_products_headline'] ); ?>" /></li>
        <li class="cf"><span class="label"><?php echo tcd_admin_label('sub_headline'); ?></span><input class="full_width" type="text" name="dp_options[product_single_upsells_products_sub_headline]" value="<?php esc_attr_e( $options['product_single_upsells_products_sub_headline'] ); ?>" /></li>
      </ul>

      <h4 class="theme_option_headline2"><?php _e('Closs sells', 'tcd-ankle'); ?></h4>
      <div class="theme_option_message2" style="margin-bottom:10px;">
        <p>
          <?php _e('Cross-selling is displayed at the bottom of the cart page.', 'tcd-ankle');  ?></br>
          <?php _e('To display Cross Sell, set the products you want to display in the "Related Products (Cross Sell)" section of the product management screen.', 'tcd-ankle');  ?>
        </p>
      </div>
      <ul class="option_list" style="padding-top:10px;border-top:1px dotted #ccc;">
        <li class="cf"><span class="label"><?php echo tcd_admin_label('headline'); ?></span><input class="full_width" type="text" name="dp_options[product_single_closs_sells_products_headline]" value="<?php esc_attr_e( $options['product_single_closs_sells_products_headline'] ); ?>" /></li>
      </ul>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->



  <?php // 最近チェックした商品 ----------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Recentry viewed products', 'tcd-ankle'); ?></h3>
    <div class="theme_option_field_ac_content">

      <input id="show_product_single_recentry_viewed_products" class="show_checkbox" name="dp_options[show_product_single_recentry_viewed_products]" type="checkbox" value="1" <?php checked( $options['show_product_single_recentry_viewed_products'], 1 ); ?>>
      <label for="show_product_single_recentry_viewed_products"><?php _e( 'Display recentry viewed products', 'tcd-ankle' ); ?></label>
      <div class="show_checkbox_area">
        <ul class="option_list" style="padding-top:10px;border-top:1px dotted #ccc;">
          <li class="cf"><span class="label"><?php echo tcd_admin_label('headline'); ?></span><input class="full_width" type="text" name="dp_options[product_single_recentry_viewed_products_headline]" value="<?php esc_attr_e( $options['product_single_recentry_viewed_products_headline'] ); ?>" /></li>
          <li class="cf"><span class="label"><?php _e('Number of products displayed', 'tcd-ankle'); ?></span><?php echo tcd_display_post_num_option('product_single_recentry_viewed_products_num', array(5,15,5), array(2,8,2)); ?></li>
        </ul>
      </div>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // ウィッシュリスト ----------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Wishlist', 'tcd-ankle'); ?></h3>
    <div class="theme_option_field_ac_content">

      <h4 class="theme_option_headline2"><?php  _e('Wishlist page', 'tcd-ankle'); ?></h4>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php echo tcd_admin_label('headline'); ?></span><input class="full_width" type="text" name="dp_options[product_wishlist_label]" value="<?php esc_attr_e( $options['product_wishlist_label'] ); ?>" /></li>
        <li class="cf"><span class="label"><?php _e('Message when the item does not exist', 'tcd-ankle'); ?></span><textarea class="full_width" cols="50" rows="1" name="dp_options[product_wishlist_message]"><?php echo esc_textarea( $options['product_wishlist_message'] ); ?></textarea></li>
        <li class="cf"><span class="label"><?php _e('Number of products displayed on one page', 'tcd-ankle'); ?></span><?php echo tcd_display_post_num_option('product_wishlist_num', array(6,15,3), array(6,14,2)); ?></li>
      </ul>

      <h4 class="theme_option_headline2"><?php  _e('Favorite button on product single page', 'tcd-ankle'); ?></h4>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Label before favorite', 'tcd-ankle'); ?></span><input class="regular-text" type="text" name="dp_options[product_single_wishlist_label]" value="<?php esc_attr_e( $options['product_single_wishlist_label'] ); ?>" /></li>
        <li class="cf"><span class="label"><?php _e('Label after favorite', 'tcd-ankle'); ?></span><input class="regular-text" type="text" name="dp_options[product_single_wishlist_label_add]" value="<?php esc_attr_e( $options['product_single_wishlist_label_add'] ); ?>" /></li>
        <li class="cf"><span class="label"><?php _e('Icon color', 'tcd-ankle');  ?></span><input type="text" name="dp_options[product_single_wishlist_icon_color]" value="<?php echo esc_attr( $options['product_single_wishlist_icon_color'] ); ?>" data-default-color="#ff959e" class="c-color-picker"></li>
      </ul>

      <h4 class="theme_option_headline2"><?php  _e('Message when adding a wishlist', 'tcd-ankle'); ?></h4>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Message when adding', 'tcd-ankle'); ?></span><input class="regular-text" type="text" name="dp_options[product_wishlist_message_add]" value="<?php esc_attr_e( $options['product_wishlist_message_add'] ); ?>" /></li>
        <li class="cf"><span class="label"><?php _e('Message when deleting', 'tcd-ankle'); ?></span><input class="regular-text" type="text" name="dp_options[product_wishlist_message_remove]" value="<?php esc_attr_e( $options['product_wishlist_message_remove'] ); ?>" /></li>
        <li class="cf color_picker_bottom"><span class="label"><?php echo tcd_admin_label('bg_color');  ?></span><input type="text" name="dp_options[product_wishlist_message_bg_color]" value="<?php echo esc_attr( $options['product_wishlist_message_bg_color'] ); ?>" data-default-color="#333333" class="c-color-picker"></li>
      </ul>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->

  <?php
  
  // WooCommerce無効時
  }else{
  
  ?>
  <div style="border: 1px solid #313a45;padding: 20px;box-shadow: 0 0 4px 0px rgb(0 0 0 / 50%);background: #fff;font-weight:600;"><?php _e('This feature is available after installing and activating WooCoomerce.', 'tcd-ankle'); ?></div>
  <?php
  
  }

  ?>
</div><!-- END .tab-content -->

<?php
} // END add_product_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_product_theme_options_validate( $input ) {

  global $dp_default_options, $basic_display_options, $product_archive_display_type_options, $currency_symbol_options, $wc_tabs_priority_options;

  //基本設定
  $input['product_label'] = wp_filter_nohtml_kses( $input['product_label'] );
  $input['product_archive_title_font_size'] = absint( $input['product_archive_title_font_size'] );
	$input['product_archive_title_font_size_sp'] = absint( $input['product_archive_title_font_size_sp'] );
  if ( ! isset( $input['product_list_display_review'] ) || ! array_key_exists( $input['product_list_display_review'], $basic_display_options ) )
    $input['product_list_display_review'] = $dp_default_options['product_list_display_review'];
  if ( ! isset( $input['product_list_currency_symbol'] ) || ! array_key_exists( $input['product_list_currency_symbol'], $currency_symbol_options ) )
    $input['product_list_currency_symbol'] = $dp_default_options['product_list_currency_symbol'];

  // 新着バッジ
  $input['show_product_list_badge_new'] = ! empty( $input['show_product_list_badge_new'] ) ? 1 : 0;
  $input['product_list_badge_new'] = wp_filter_nohtml_kses( $input['product_list_badge_new'] );
  $input['product_list_badge_new_bg_color'] = sanitize_hex_color( $input['product_list_badge_new_bg_color'] );
  // セールバッジ
  $input['show_product_list_badge_sale'] = ! empty( $input['show_product_list_badge_sale'] ) ? 1 : 0;
  $input['product_list_badge_sale'] = wp_filter_nohtml_kses( $input['product_list_badge_sale'] );
  $input['product_list_badge_sale_bg_color'] = sanitize_hex_color( $input['product_list_badge_sale_bg_color'] );
  // おすすめバッジ
  $input['show_product_list_badge_featured'] = ! empty( $input['show_product_list_badge_featured'] ) ? 1 : 0;
  $input['product_list_badge_featured'] = wp_filter_nohtml_kses( $input['product_list_badge_featured'] );
  $input['product_list_badge_featured_bg_color'] = sanitize_hex_color( $input['product_list_badge_featured_bg_color'] );
  // 在庫切れラベル
  $input['product_list_outofstock_label'] = wp_filter_nohtml_kses( $input['product_list_outofstock_label'] );
  $input['product_list_outofstock_bg_color'] = sanitize_hex_color( $input['product_list_outofstock_bg_color'] );

  // アーカイブ
	$input['product_archive_headline'] = wp_filter_nohtml_kses( $input['product_archive_headline'] );
	$input['product_archive_sub_headline'] = wp_filter_nohtml_kses( $input['product_archive_sub_headline'] );
	$input['product_archive_desc'] = wp_filter_nohtml_kses( $input['product_archive_desc'] );

  // フィルター
  $input['show_product_archive_filter'] = ! empty( $input['show_product_archive_filter'] ) ? 1 : 0;

  // カテゴリー
  $input['product_archive_filter_category_label'] = wp_filter_nohtml_kses( $input['product_archive_filter_category_label'] );
  $input['product_archive_filter_categories'] = ! empty( $input['product_archive_filter_categories'] ) ? $input['product_archive_filter_categories'] : array();

  // ソートフィルター
  $input['product_archive_filter_default'] = wp_filter_nohtml_kses( $input['product_archive_filter_default'] );
  $input['product_archive_filter_date'] = ! empty( $input['product_archive_filter_date'] ) ? 1 : 0;
  $input['product_archive_filter_popularity'] = ! empty( $input['product_archive_filter_popularity'] ) ? 1 : 0;
  $input['product_archive_filter_rating'] = ! empty( $input['product_archive_filter_rating'] ) ? 1 : 0;
  $input['product_archive_filter_price'] = ! empty( $input['product_archive_filter_price'] ) ? 1 : 0;
  $input['product_archive_filter_price-desc'] = ! empty( $input['product_archive_filter_price-desc'] ) ? 1 : 0;

	// アーカイブその他の設定
  if ( ! isset( $input['product_archive_display_type'] ) )
    $input['product_archive_display_type'] = null;
  if ( ! array_key_exists( $input['product_archive_display_type'], $product_archive_display_type_options ) )
    $input['product_archive_display_type'] = null;
  $input['product_archive_ajax_button_label'] = wp_filter_nohtml_kses( $input['product_archive_ajax_button_label'] );
	$input['product_archive_num'] = absint( $input['product_archive_num'] );
	$input['product_archive_num_sp'] = absint( $input['product_archive_num_sp'] );

  //詳細ページ
  $input['product_single_title_font_size'] = absint( $input['product_single_title_font_size'] );
  $input['product_single_title_font_size_sp'] = absint( $input['product_single_title_font_size_sp'] );
  if ( ! isset( $input['product_single_display_rating'] ) || ! array_key_exists( $input['product_single_display_rating'], $basic_display_options ) )
    $input['product_single_display_rating'] = $dp_default_options['product_single_display_rating'];

  // タブ
  if ( ! isset( $input['product_single_tabs_priority'] ) )
    $input['product_single_tabs_priority'] = null;
  if ( ! array_key_exists( $input['product_single_tabs_priority'], $wc_tabs_priority_options ) )
    $input['product_single_tabs_priority'] = null;
  $input['product_single_tabs1_label'] = wp_filter_nohtml_kses( $input['product_single_tabs1_label'] );
  $input['product_single_tabs2_label'] = wp_filter_nohtml_kses( $input['product_single_tabs2_label'] );
  $input['product_single_tabs3_label'] = wp_filter_nohtml_kses( $input['product_single_tabs3_label'] );
  // レビュー
  $input['product_single_reviews_star_color'] = sanitize_hex_color( $input['product_single_reviews_star_color'] );
  $input['product_single_reviews_form_title'] = wp_filter_nohtml_kses( $input['product_single_reviews_form_title'] );
  $input['product_single_reviews_form_desc'] = wp_filter_nohtml_kses( $input['product_single_reviews_form_desc'] );
  $input['product_single_reviews_form_button_label'] = wp_filter_nohtml_kses( $input['product_single_reviews_form_button_label'] );
  
  $input['product_single_reviews_form_title_logout'] = wp_filter_nohtml_kses( $input['product_single_reviews_form_title_logout'] );
  $input['product_single_reviews_form_desc_logout'] = wp_filter_nohtml_kses( $input['product_single_reviews_form_desc_logout'] );
  $input['product_single_reviews_form_button_label_logout'] = wp_filter_nohtml_kses( $input['product_single_reviews_form_button_label_logout'] );

  // 関連商品
  $input['show_product_single_related_products'] = ! empty( $input['show_product_single_related_products'] ) ? 1 : 0;
  $input['product_single_related_products_headline'] = wp_filter_nohtml_kses( $input['product_single_related_products_headline'] );
  $input['product_single_related_products_sub_headline'] = wp_filter_nohtml_kses( $input['product_single_related_products_sub_headline'] );
  $input['product_single_related_products_num'] = absint( $input['product_single_related_products_num'] );
  $input['product_single_related_products_num_sp'] = absint( $input['product_single_related_products_num_sp'] );
  // アップセル
  $input['product_single_upsells_products_headline'] = wp_filter_nohtml_kses( $input['product_single_upsells_products_headline'] );
  $input['product_single_upsells_products_sub_headline'] = wp_filter_nohtml_kses( $input['product_single_upsells_products_sub_headline'] );
  // クロスセル
  $input['product_single_closs_sells_products_headline'] = wp_filter_nohtml_kses( $input['product_single_closs_sells_products_headline'] );

  // 最近チェックした商品
  $input['show_product_single_recentry_viewed_products'] = ! empty( $input['show_product_single_recentry_viewed_products'] ) ? 1 : 0;
  $input['product_single_recentry_viewed_products_headline'] = wp_filter_nohtml_kses( $input['product_single_recentry_viewed_products_headline'] );
	$input['product_single_recentry_viewed_products_num'] = absint( $input['product_single_recentry_viewed_products_num'] );
	$input['product_single_recentry_viewed_products_num_sp'] = absint( $input['product_single_recentry_viewed_products_num_sp'] );

  // ウィッシュリスト
  $input['product_wishlist_label'] = wp_filter_nohtml_kses( $input['product_wishlist_label'] );
  $input['product_wishlist_message'] = wp_filter_nohtml_kses( $input['product_wishlist_message'] );
  $input['product_wishlist_num'] = absint( $input['product_wishlist_num'] );
  $input['product_wishlist_num_sp'] = absint( $input['product_wishlist_num_sp'] );
  // お気に入りボタン
  $input['product_single_wishlist_label'] = wp_filter_nohtml_kses( $input['product_single_wishlist_label'] );
  $input['product_single_wishlist_label_add'] = wp_filter_nohtml_kses( $input['product_single_wishlist_label_add'] );
  $input['product_single_wishlist_icon_color'] = sanitize_hex_color( $input['product_single_wishlist_icon_color'] );
  // メッセージ
  $input['product_wishlist_message_add'] = wp_filter_nohtml_kses( $input['product_wishlist_message_add'] );
  $input['product_wishlist_message_remove'] = wp_filter_nohtml_kses( $input['product_wishlist_message_remove'] );
  $input['product_wishlist_message_bg_color'] = sanitize_hex_color( $input['product_wishlist_message_bg_color'] );

	return $input;

};


?>