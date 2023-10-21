<?php

// カテゴリー編集用入力欄を出力 -------------------------------------------------------
function edit_seo_custom_fields( $term ) {
	$term_meta = get_option( 'taxonomy_' . $term->term_id, array() );
	$term_meta = array_merge( array(
		'meta_title' => '',
    'meta_description' => '',
	), $term_meta );
?>
<tr class="form-field">
	<th colspan="2">
    
    <div class="custom_category_meta">
      <h3 class="ccm_headline"><?php _e( 'SEO', 'tcd-ankle' ); ?></h3>
      <div class="ccm_content clearfix">
        <h4 class="headline"><?php _e( 'Title tag', 'tcd-ankle' ); ?></h4>
        <input type="text" name="term_meta[meta_title]" value="<?php if(!empty($term_meta['meta_title'])){ echo esc_attr($term_meta['meta_title']); }; ?>" id="meta_title" style="width:100%" />
      </div><!-- END ccm_content -->
      <div class="ccm_content clearfix">
        <h4 class="headline"><?php _e( 'Meta description tag', 'tcd-ankle' ); ?></h4>
        <textarea class="large-text word_count" cols="50" rows="3" name="term_meta[meta_description]" style="width:100%" id="meta_description"><?php if(!empty($term_meta['meta_description'])){ echo esc_textarea($term_meta['meta_description']); }; ?></textarea>
        <p class="word_count_result"><?php _e( 'Current character is : <span>0</span>', 'tcd-ankle' ); ?></p>
      </div><!-- END ccm_content -->
    </div><!-- END .tag_category_meta -->

 </th>
</tr><!-- END .form-field -->
<?php
}
add_action( 'category_edit_form_fields', 'edit_seo_custom_fields', 11 );
add_action( 'post_tag_edit_form_fields', 'edit_seo_custom_fields', 11 );
add_action( 'product_cat_edit_form_fields', 'edit_seo_custom_fields', 11 );
add_action( 'product_tag_edit_form_fields', 'edit_seo_custom_fields', 11 );


// データを保存 -------------------------------------------------------
function save_seo_custom_fields( $term_id ) {
  $new_meta = array();
  if ( isset( $_POST['term_meta'] ) ) {
		$current_term_id = $term_id;
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$new_meta[$key] = $_POST['term_meta'][$key];
			}
		}
	}
  update_option( "taxonomy_$current_term_id", $new_meta );
}

global $pagenow;
if($pagenow == 'edit-tags.php') {
  add_action( 'edited_terms', 'save_seo_custom_fields' );
}



?>