<?php
/**
 * Add custom columns (ID, thumbnails)
 */
function manage_columns( $columns ) {
  // Make new column array with ID column and featured image column
  $new_columns = array();

  foreach ( $columns as $column_name => $column_display_name ) {
    // Add post_id column before title column
    if ( isset( $columns['title'] ) && $column_name == 'title' ) {
      $new_columns['post_id'] = 'ID';
    }
    $new_columns[$column_name] = $column_display_name;
  }

  // Add featured image column
  $new_columns['new_post_thumb'] = __( 'Featured Image', 'tcd-ankle' );

  return $new_columns;
}
add_filter( 'manage_post_posts_columns', 'manage_columns', 5 ); // For post
add_filter( 'manage_news_posts_columns', 'manage_columns', 5 ); // For news


/**
 * おすすめ記事を追加
 */
function manage_post_posts_columns( $columns ) {

  $new_columns = array();
  foreach ( $columns as $column_name => $column_display_name ) {
    if ( isset( $columns['new_post_thumb'] ) && $column_name == 'new_post_thumb' ) {
      $new_columns['recommend_post'] = __( 'Article type', 'tcd-ankle' );
    }
    $new_columns[$column_name] = $column_display_name;
  }
  return $new_columns;

}
add_filter( 'manage_post_posts_columns', 'manage_post_posts_columns' ); // Only for post


/**
 * Output the content of custom columns (ID, featured image, recommend post and event date)
 */
function add_column( $column_name, $post_id ) {

  $options = get_design_plus_option();

  switch ( $column_name ) {

    case 'new_post_thumb' : // アイキャッチ画像
      $post_thumbnail_id = get_post_thumbnail_id( $post_id );
      if ( $post_thumbnail_id ) {
        $post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'thumbnail' );
        echo '<img width="70" src="' . esc_attr( $post_thumbnail_img[0] ) . '">';
      }
      break;

    case 'recommend_post' : // おすすめ記事
      if ( get_post_meta( $post_id, 'recommend_post1', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-ankle' ) . '1</p>'; }
      if ( get_post_meta( $post_id, 'recommend_post2', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-ankle' ) . '2</p>'; }
      if ( get_post_meta( $post_id, 'recommend_post3', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-ankle' ) . '3</p>'; }
      break;

  }

}
add_action( 'manage_posts_custom_column', 'add_column', 10, 2 ); // For post
add_action( 'manage_pages_custom_column', 'add_column', 10, 2 ); // For page


/**
 * Enable sorting of the ID column
 */
function custom_quick_edit_sortable_columns( $sortable_columns ) {
  $sortable_columns['post_id'] = 'ID';
  return $sortable_columns;
}
//add_filter( 'manage_edit-post_sortable_columns', 'custom_quick_edit_sortable_columns' ); // For post
//add_filter( 'manage_edit-news_sortable_columns', 'custom_quick_edit_sortable_columns' ); // For news
add_filter( 'manage_edit-page_sortable_columns', 'custom_quick_edit_sortable_columns' ); // For page





?>