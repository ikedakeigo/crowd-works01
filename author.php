<?php

get_header();
$options = get_design_plus_option();

?>
<main id="post_archive">
  <div class="l-inner inner">

    <?php

    get_template_part( 'template-parts/archive-header' );

        $author_info = $wp_query->get_queried_object();
        $author_id = $author_info->ID;
        if($author_id){
          $user_data = get_userdata($author_id);
          $user_name = $user_data->display_name;
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
      <div class="image_wrap"><?php echo wp_kses_post(get_avatar($author_id, 300)); ?></div>
      <div class="content">
        <h1 class="name rich_font"><span class="author"><?php echo esc_html($user_data->display_name); ?></span></h1>
        <?php if($desc) { ?>
        <p class="desc line2"><span><?php echo esc_html($desc); ?></span></p>
        <?php }; if($facebook || $twitter || $insta || $pinterest || $youtube || $contact || $user_url) { ?>
        <ul class="sns_button_list clearfix color_<?php echo esc_attr($options['sns_button_color_type']); ?>">
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
    </div>
    <?php };
    
    if ( have_posts() ) {

      echo '<div class="post_list">'."\n";
      
      while ( have_posts() ) : the_post();
        echo get_template_part('template-parts/main_loop');
      endwhile;

      echo '</div>'."\n";
      
      get_template_part( 'template-parts/pager' );
      
    }else{

      echo '<p id="no_post">'.__('There is no registered post.', 'tcd-ankle').'</p>';

    }

    ?>
  </div>
</main><!-- END #main_contents -->
<?php get_footer(); ?>