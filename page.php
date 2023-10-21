<?php
	
	get_header();
	$options = get_design_plus_option();

  // 本文エリアを自由に使う場合
  $is_output_free_content = apply_filters( 'ankle_page_show_free_content', $show = false );
  if($is_output_free_content){

    do_action('ankle_page_output_free_content');

  // WooCommerceの固定ページの場合
  }elseif ( is_woocommerce_active() && ( is_cart() || is_checkout() || is_account_page() ) ) {

    get_template_part('template-parts/breadcrumb');

?>
<main id="main_contents">
  <div class="p-entry p-wc">
    <div class="p-wc__body p-body">
    <?php
      the_post();
      the_content();
    ?>
    </div>
  </div>
</main>
<?php

  // 通常の固定ページ
  }else{

    get_template_part('template-parts/breadcrumb');

?>
<main id="main_contents" class="two_columns">
	<article id="main_col">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<div id="article">

		<?php if($page == '1') { // ***** only show on first page ***** ?>

      <div class="article_header page_default">
        <?php

          if ( has_post_thumbnail() ) :
            echo "\t\t\t\t";
            echo '<div class="featured_image">' . "\n";
            echo "\t\t\t\t\t";
            the_post_thumbnail( 'post-thumbnail' );
            echo "\n";
            echo "\t\t\t\t";
            echo "</div>\n";
          endif;

        ?>
        <h1 class="title rich_font post"><?php the_title(); ?></h1>
      </div>
    <?php

      }; // ***** END only show on first page *****
		
			// post content ------------------------------------------------------------------------------------------------------------------------
			echo '<div class="post_content clearfix">';
			
			the_content();
			
			if ( ! post_password_required() ) custom_wp_link_pages();

			echo '</div>';
			
			endwhile; endif;
			
		?>
		</div>
	</article><!-- END #main_col -->
<?php
    // widget ------------------------
    get_sidebar();
?>
</main><!-- END #main_contents -->
<?php

  }
  get_footer();

?>