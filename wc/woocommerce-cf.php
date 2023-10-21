<?php


/* ----------------------------------------------------------------------
 不要なフィールドの削除
---------------------------------------------------------------------- */

// WooCommerceの固定ページでは特定のメタボックスを非表示に
function remove_meta_box_woocommerce_page( $post ) {
	if ( $post && is_woocommerce_active() ) {
		$woocommerce_page_ids = array(
			get_option( 'woocommerce_shop_page_id' ),
			get_option( 'woocommerce_cart_page_id' ),
			get_option( 'woocommerce_checkout_page_id' ),
			get_option( 'woocommerce_myaccount_page_id' )
		);

		if ( in_array( $post->ID, $woocommerce_page_ids ) ) {
			// 固定ページヘッダー
			remove_meta_box( 'page_header_meta_box', 'page', 'normal' );
		}
	}
}
add_action( 'add_meta_boxes_page', 'remove_meta_box_woocommerce_page', 99 );


// WooCommerceの固定ページではページテンプレートをデフォルトのみに
function tcd_woocommerce_page_template_only_default( $post_templates, $theme, $post, $post_type = null ) {
	if ( $post && is_woocommerce_active() ) {
		$woocommerce_page_ids = array(
			get_option( 'woocommerce_shop_page_id' ),
			get_option( 'woocommerce_cart_page_id' ),
			get_option( 'woocommerce_checkout_page_id' ),
			get_option( 'woocommerce_myaccount_page_id' )
		);

		if ( in_array( $post->ID, $woocommerce_page_ids ) ) {
			return array();
		}
	}

	return $post_templates;
}
add_filter( 'theme_page_templates', 'tcd_woocommerce_page_template_only_default', 10, 4 );



/* ----------------------------------------------------------------------
 タブ
---------------------------------------------------------------------- */

// タブデータ
function woocommerce_default_product_tabs( $tabs = array() ) {
	global $product, $post, $dp_options;

	// Description tab - shows product content.
	$wc_tab1_editor = get_post_meta($post->ID, 'wc_tab1_editor', true);
	$default_description_label = ($dp_options['product_single_tabs1_label']) ? esc_html($dp_options['product_single_tabs1_label']) : __( 'Description', 'woocommerce' );
	$description_label = (get_post_meta($post->ID, 'wc_tab1_label', true)) ? esc_html( get_post_meta($post->ID, 'wc_tab1_label', true) ) : $default_description_label;
	if ( $wc_tab1_editor ) {
		$tabs['description'] = array(
			'title'    => $description_label,
			'priority' => 20,
			'callback' => 'woocommerce_product_description_tab',
		);
	}

	// Additional information tab - shows attributes.
	if ( $product && ( $product->has_attributes() || apply_filters( 'wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions() ) ) ) {
		$default_information_label = ($dp_options['product_single_tabs2_label']) ? esc_html($dp_options['product_single_tabs2_label']) : __( 'Additional information', 'woocommerce' );
		$information_label = (get_post_meta($post->ID, 'wc_tab2_label', true)) ? esc_html( get_post_meta($post->ID, 'wc_tab2_label', true) ) : $default_information_label;
		$tabs['additional_information'] = array(
			'title'    => $information_label,
			'priority' => 30,
			'callback' => 'woocommerce_product_additional_information_tab',
		);
	}

	// Reviews tab - shows comments.
	if ( comments_open() ) {
		$default_review_label = ($dp_options['product_single_tabs3_label']) ? esc_html($dp_options['product_single_tabs3_label']) : __( 'Reviews', 'tcd-ankle' );
		$review_label = (get_post_meta($post->ID, 'wc_tab3_label', true)) ? esc_html( get_post_meta($post->ID, 'wc_tab3_label', true) ) : $default_review_label; 

		$review_count = ( $product->get_review_count() ) ? '<span class="reviews_tab_count">'.$product->get_review_count().'</span>' : '' ;
		$tabs['reviews'] = array(
			/* translators: %s: reviews count */
			'title'    => $review_label.$review_count,
			'priority' => 40,
			'callback' => 'comments_template',
		);
	}

	$priority = ( !empty( $dp_options['product_single_tabs_priority'] ) ) ? $dp_options['product_single_tabs_priority'] : 'description';
	if(array_key_exists($priority, $tabs)){
		$tabs[$priority]['priority'] = 10;
	}

	return $tabs;
}


// タブ CF
function tcd_wc_tab_meta_box() {
  add_meta_box(
    'tcd_wc_tab',//ID of meta box
    __('Tabs', 'tcd-ankle'),//label
    'show_tcd_wc_tab_meta_box',//callback function
    'product',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'tcd_wc_tab_meta_box', 999);

function show_tcd_wc_tab_meta_box() {
  global $post, $dp_options;

  $wc_tab1_label = get_post_meta($post->ID, 'wc_tab1_label', true);
  $wc_tab1_editor = get_post_meta($post->ID, 'wc_tab1_editor', true);

  $wc_tab2_label = get_post_meta($post->ID, 'wc_tab2_label', true);
  $wc_tab3_label = get_post_meta($post->ID, 'wc_tab3_label', true);

  echo '<input type="hidden" name="tcd_wc_tab_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  // ***************************************************************************************************************************************************************************************
?>

<div class="tcd_custom_fields">

  <div class="sub_box cf" style="margin-top:20px;">
    <h3 class="theme_option_subbox_headline"><?php _e( 'Description tab', 'tcd-ankle' ); ?></h3>
    <div class="sub_box_content">
      <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('The Description tab can be used to display any content using the Classic Editor.</br>If the editor is empty, it will not be displayed.', 'tcd-ankle');  ?></p>
      </div>
      <h3 class="theme_option_headline2"><?php _e( 'Tab label', 'tcd-ankle' ); ?></h3>
      <input class="regular-text" type="text" name="wc_tab1_label" value="<?php esc_attr_e( $wc_tab1_label ); ?>" placeholder="<?php _e( 'Description', 'woocommerce' ); ?>" />
      <h3 class="theme_option_headline2"><?php _e( 'Free space', 'tcd-ankle' ); ?></h3>
      <?php wp_editor( $wc_tab1_editor, 'wc_tab1_editor', array( 'textarea_name' => 'wc_tab1_editor', 'textarea_rows' => 10 )); ?>
    </div>
  </div>

  <div class="sub_box cf">
    <h3 class="theme_option_subbox_headline"><?php _e( 'Additional information tab', 'tcd-ankle' ); ?></h3>
    <div class="sub_box_content">
      <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('The Additional Information tab displays the data set in Product Data > Attributes in a tabular format.</br>It will not be displayed if the custom product attribute does not exist.', 'tcd-ankle');  ?></p>
      </div>
      <h3 class="theme_option_headline2"><?php _e( 'Tab label', 'tcd-ankle' ); ?></h3>
      <input class="regular-text" type="text" name="wc_tab2_label" value="<?php esc_attr_e( $wc_tab2_label ); ?>" placeholder="<?php _e( 'Additional information', 'woocommerce' ); ?>" />
    </div>
  </div>

  <div class="sub_box cf">
    <h3 class="theme_option_subbox_headline"><?php _e( 'Reviews tab', 'tcd-ankle' ); ?></h3>
    <div class="sub_box_content">
      <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('The Reviews tab displays a list of reviews posted by users.</br>It appears when you go to Product Data > Advanced Settings > Enable Reviews.', 'tcd-ankle');  ?></p>
      </div>
      <h3 class="theme_option_headline2"><?php _e( 'Tab label', 'tcd-ankle' ); ?></h3>
      <input class="regular-text" type="text" name="wc_tab3_label" value="<?php esc_attr_e( $wc_tab3_label ); ?>" placeholder="<?php _e( 'Reviews', 'tcd-ankle' ); ?>" />
    </div>
  </div>

</div><!-- END #tcd_custom_fields -->

<?php
}

// SAVE
function save_tcd_wc_tab_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['tcd_wc_tab_meta_box_nonce']) || !wp_verify_nonce($_POST['tcd_wc_tab_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // save or delete
  $cf_keys = array('wc_tab1_label', 'wc_tab1_editor', 'wc_tab2_label', 'wc_tab3_label');
  foreach ($cf_keys as $cf_key) {
    $old = get_post_meta($post_id, $cf_key, true);

    if (isset($_POST[$cf_key])) {
      $new = $_POST[$cf_key];
    } else {
      $new = '';
    }

    if ($new && $new != $old) {
      update_post_meta($post_id, $cf_key, $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $cf_key, $old);
    }
  }

}
add_action('save_post', 'save_tcd_wc_tab_meta_box');


/* ----------------------------------------------------------------------
 カテゴリー編集画面に項目追加
---------------------------------------------------------------------- */


// 入力欄追加
function tcd_product_cat_add_form_fields( $taxonomy ) {
  ?>
  <div class="form-field form-required term-image-wrap">
    <label for="product_cat_sub_headline"><?php echo tcd_admin_label('sub_headline'); ?></label>
    <input name="product_cat_sub_headline" id="product_cat_sub_headline" type="text" value="" size="40" aria-required="true"/>
    <p><?php _e('It will be displayed under the title of the product category page.', 'tcd-ankle'); ?></p>
  </div>
  <?php
}

add_action( 'product_cat_add_form_fields', 'tcd_product_cat_add_form_fields' );


// 編集
function tcd_product_cat_edit_form_fields( $tag, $taxonomy ) {
  ?>
  <tr class="form-field term-image-wrap">
    <th scope="row"><label for="product_cat_sub_headline"><?php echo tcd_admin_label('sub_headline'); ?></label></th>
    <td><input name="product_cat_sub_headline" id="product_cat_sub_headline" type="text" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'product_cat_sub_headline', true ) ); ?>" size="40" aria-required="true"/>
      <p><?php _e('It will be displayed under the title of the product category page.', 'tcd-ankle'); ?></p>
    </td>
  </tr>
  <?php
}
add_action( 'product_cat_edit_form_fields', 'tcd_product_cat_edit_form_fields', 10, 2 );

// 保存・削除
function tcd_product_cat_save_form_fields( $term_id ) {
  $key = 'product_cat_sub_headline';
  /**
   * 入力された値の検証をして、更新 or 削除
   */
  if ( isset( $_POST[ $key ] ) && esc_url_raw( $_POST[ $key ] ) ) {
    update_term_meta( $term_id, $key, $_POST[ $key ] );
  } else {
    delete_term_meta( $term_id, $key );
  }
}

add_action( 'create_product_cat', 'tcd_product_cat_save_form_fields' );
add_action( 'edit_product_cat', 'tcd_product_cat_save_form_fields' );