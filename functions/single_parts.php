<?php

// タイトルとURLをコピーするボタン
function copy_title_url_button() {

  ob_start();

?>


<?php
// カスタム投稿タイプ「WooCommerce Pages」のシングルページでは表示しない
if( ! is_singular('woocommerce_page')) :
?>
<div class="single_copy_title_url top">
  <button id="js-copy-title-url-button" class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED Title&amp;URL', 'tcd-ankle' ) ); ?>"><?php _e( 'COPY Title&amp;URL', 'tcd-ankle' ); ?></button>
</div>

<?php
endif;
?>

<?php

  return ob_get_clean();

} // END function copy_title_url_button()


// 次の記事・前の記事リンク
function next_prev_post_link() {

	$previous_post = get_previous_post();
	$next_post = get_next_post();

  ob_start();

	if ( $previous_post || $next_post ) {

?>
<ul class="next_prev_post">
<?php if ( $previous_post ) { ?>
	<li class="item prev_post"><a href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>" data-prev="<?php _e( 'Previous post', 'tcd-ankle' ); ?>"><span class="text line2 pc"><span><?php echo esc_html( mb_strimwidth( strip_tags( $previous_post->post_title ), 0, 150, '...' ) ); ?></span></span><span class="sp"><?php _e( 'Previous post', 'tcd-ankle' ); ?></span></a></li>
<?php }else{ ?>
	<li class="item prev_post" style="border:none; border-right: 1px solid #ddd;"></li>
<?php }; if ( $next_post ) { ?>
	<li class="item next_post"><a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" data-next="<?php _e( 'Next post', 'tcd-ankle' ); ?>"><span class="text line2 pc"><span><?php echo esc_html( mb_strimwidth( strip_tags( $next_post->post_title ), 0, 150, '...' ) ); ?></span></span><span class="sp"><?php _e( 'Next post', 'tcd-ankle' ); ?></span></a></li>
<?php }else{ ?>
	<li class="item next_post" style="border:none;"></li>
<?php }; ?>
</ul>
<?php
  };

  return ob_get_clean();

} // END function next_prev_post_link()


// メタボックス
function tcd_metabox($dp_options) {

  ob_start();

?>
  <ul id="post_meta_bottom" class="clearfix">
    <?php if ($dp_options['blog_single_show_meta_author'] == 'display') : ?><li class="post_author"><?php _e("Author","tcd-ankle"); ?>: <?php if (function_exists('coauthors_posts_links')) { coauthors_posts_links(', ',', ','','',true); } else { the_author_posts_link(); }; ?></li><?php endif; ?>
    <?php if ($dp_options['blog_single_show_meta_category'] == 'display'){ ?><li class="post_category"><?php the_category(', '); ?></li><?php }; ?>
    <?php if ($dp_options['blog_single_show_meta_tag'] == 'display'): ?><?php the_tags('<li class="post_tag">',', ','</li>'); ?><?php endif; ?>
    <?php if (comments_open()){ ?><li class="post_comment"><?php _e("Comment","tcd-ankle"); ?>: <a href="#comments"><?php comments_number( '0','1','%' ); ?></a></li><?php }; ?>
  </ul>
<?php

  return ob_get_clean();

} // function tcd_metabox($dp_options)



function tcd_author_profile($dp_options) {

  ob_start();

  $author_id = get_the_author_meta('ID');
  $user_data = get_userdata($author_id);
  if(!empty($user_data->show_author)) {

    $desc = $user_data->description;
    $facebook = $user_data->facebook_url;
    $twitter = $user_data->twitter_url;
    $insta = $user_data->instagram_url;
    $pinterest = $user_data->pinterest_url;
    $youtube = $user_data->youtube_url;
    $contact = $user_data->contact_url;
    $author_url = get_author_posts_url($author_id);
    $user_url = $user_data->user_url;

?>
<div class="author_profile clearfix">
  <a class="image_wrap" href="<?php echo esc_url($author_url); ?>"><?php echo wp_kses_post(get_avatar($author_id, 300)); ?></a>
  <div class="content">
      <h4 class="name rich_font"><a href="<?php echo esc_url($author_url); ?>"><span class="author"><?php echo esc_html($user_data->display_name); ?></span></a></h4>
      <?php if($desc) { ?>
      <p class="desc line2"><span><?php echo esc_html($desc); ?></span></p>
      <?php }; if($facebook || $twitter || $insta || $pinterest || $youtube || $contact || $user_url) { ?>
      <ul class="sns_button_list clearfix color_<?php echo esc_attr($dp_options['sns_button_color_type']); ?><?php if(is_ios()) echo ' device_ios' ?>">
      <?php if($user_url) { ?><li class="user_url"><a href="<?php echo esc_url($user_url); ?>" target="_blank"><span><?php echo esc_url($user_url); ?></span></a></li><?php }; ?>
      <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
      <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow" target="_blank" title="Twitter"><span>Twitter</span></a></li><?php }; ?>
      <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
      <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
      <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
      <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
      </ul>
      <?php }; ?>
  </div>
</div><!-- END .author_profile -->
<?php

  };

  return ob_get_clean();

} // END function tcd_author_profile()
