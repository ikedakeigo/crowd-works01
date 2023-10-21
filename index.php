<?php

$options = get_design_plus_option();
get_header();

?>
<main id="post_archive">
  <div class="l-inner inner">
<?php

get_template_part( 'template-parts/archive-header' );
if ( have_posts() ) {

  echo '<div class="post_list">'. "\n";
  while ( have_posts() ) : the_post();
    echo get_template_part('template-parts/main_loop');
	endwhile;
  echo '</div>';

	get_template_part( 'template-parts/pager' );

}else{
  echo '<p id="no_post">' . __('There is no registered post.', 'tcd-ankle') . '</p>';
}

?>
	</div>
</main>
<?php get_footer(); ?>